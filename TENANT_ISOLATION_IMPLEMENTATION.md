# Tenant Isolation Implementation for Business Units

## Overview
Implemented proper tenant isolation so that:
1. Each tenant can only see their own business units
2. Business unit names are unique per tenant (not globally)
3. "Testing" can exist in tenant_id 1 AND tenant_id 2 simultaneously
4. Users cannot see or interact with other tenants' data

## Changes Made

### 1. **BusinessUnitController.php** - getData() Method

#### Added Tenant Filter:
```php
// Filter by tenant_id - only show business units for logged-in user's tenant
if (auth()->check() && auth()->user()->tenant_id) {
    $builder->where('tenant_id', auth()->user()->tenant_id);
}
```

**Location**: Before the active status filter  
**Purpose**: Ensures API only returns business units for the logged-in user's tenant

### 2. **BusinessUnitService.php** - getAll() Method

#### Added Tenant Filter:
```php
$query = BusinessUnit::where('status', 1);

// Filter by tenant_id
if (auth()->check() && auth()->user()->tenant_id) {
    $query->where('tenant_id', auth()->user()->tenant_id);
}
```

**Purpose**: Service layer also respects tenant isolation

### 3. **StoreBusinessUnitRequest.php** - Validation Rules

#### Updated Unique Rule:
```php
Rule::unique('business_units', 'name')
    ->where('tenant_id', auth()->user()->tenant_id)
    ->whereNull('deleted_at')
```

**Purpose**: 
- Checks uniqueness only within the same tenant
- Ignores soft-deleted records

### 4. **UpdateBusinessUnitRequest.php** - Validation Rules

#### Updated Unique Rule:
```php
Rule::unique('business_units', 'name')
    ->where('tenant_id', auth()->user()->tenant_id)
    ->ignore($businessUnitId)
    ->whereNull('deleted_at')
```

**Purpose**: 
- Checks uniqueness only within the same tenant
- Excludes current record being updated
- Ignores soft-deleted records

## How It Works

### Multi-Tenancy Behavior:

#### **Scenario 1: Creating Business Unit**
- **Tenant 1 User** creates "Testing"
  - ✅ Allowed (no "Testing" exists in tenant 1)
  - Saved with `tenant_id = 1`

- **Tenant 2 User** creates "Testing"
  - ✅ Allowed (no "Testing" exists in tenant 2)
  - Saved with `tenant_id = 2`

- **Tenant 1 User** tries to create "Testing" again
  - ❌ Blocked ("Testing" already exists in tenant 1)

#### **Scenario 2: Viewing Business Units**
- **Tenant 1 User** logs in
  - Sees only business units where `tenant_id = 1`
  - Cannot see Tenant 2's "Testing"

- **Tenant 2 User** logs in
  - Sees only business units where `tenant_id = 2`
  - Cannot see Tenant 1's "Testing"

#### **Scenario 3: Updating Business Unit**
- **Tenant 1 User** edits "Testing" to "Development"
  - ✅ Allowed (no "Development" in tenant 1)
  
- **Tenant 1 User** edits "Development" to "Testing"
  - ❌ Blocked if another "Testing" exists in tenant 1
  - ✅ Allowed if changing back to original name

#### **Scenario 4: Client-Side Validation**
- JavaScript fetches business units via API
- API automatically filters by tenant_id
- Client-side validation checks against tenant-specific list
- No cross-tenant conflicts

## Data Flow

### 1. **Page Load**
```
User Login → Auth with tenant_id
↓
Load Business Units Page
↓
JavaScript calls getData API
↓
Controller filters by tenant_id
↓
Returns only current tenant's data
↓
Table displays tenant-specific units
```

### 2. **Add Business Unit**
```
User enters "Testing"
↓
Client-side validation (against tenant-specific list)
↓
Form submission
↓
StoreBusinessUnitRequest validates
  - Checks: name unique where tenant_id = current_user.tenant_id
↓
BusinessUnitService.store()
  - Saves with tenant_id = current_user.tenant_id
↓
Success / Error message
```

### 3. **Update Business Unit**
```
User edits "Testing" to "HR"
↓
Client-side validation (excludes current unit)
↓
Form submission
↓
UpdateBusinessUnitRequest validates
  - Checks: name unique where tenant_id = current_user.tenant_id
  - Ignores: current business unit ID
↓
BusinessUnitService.update()
  - Verifies tenant_id matches
  - Updates record
↓
Success / Error message
```

## Database Queries

### Before (No Tenant Isolation):
```sql
-- Shows ALL business units from ALL tenants
SELECT * FROM business_units WHERE status = 1;

-- Checks uniqueness globally
SELECT COUNT(*) FROM business_units 
WHERE name = 'Testing';
```

### After (With Tenant Isolation):
```sql
-- Shows only current tenant's business units
SELECT * FROM business_units 
WHERE status = 1 AND tenant_id = 1;

-- Checks uniqueness per tenant
SELECT COUNT(*) FROM business_units 
WHERE name = 'Testing' 
  AND tenant_id = 1
  AND deleted_at IS NULL;
```

## Security Benefits

1. **Data Privacy**: Users cannot see other tenants' data
2. **Data Integrity**: Cannot accidentally modify other tenants' records
3. **Namespace Isolation**: Each tenant has independent naming space
4. **Audit Trail**: All operations logged with correct tenant_id

## Testing Scenarios

### Test 1: Cross-Tenant Duplicate Names
```
Tenant 1 User:
  - Create "HR" → ✅ Success
  
Tenant 2 User:
  - Create "HR" → ✅ Success (different tenant)
  - Create "HR" → ❌ Error (duplicate in tenant 2)
```

### Test 2: View Isolation
```
Database has:
  - id: 1, name: "HR", tenant_id: 1
  - id: 2, name: "IT", tenant_id: 1
  - id: 3, name: "HR", tenant_id: 2
  - id: 4, name: "Finance", tenant_id: 2

Tenant 1 User sees:
  - id: 1, name: "HR"
  - id: 2, name: "IT"

Tenant 2 User sees:
  - id: 3, name: "HR"
  - id: 4, name: "Finance"
```

### Test 3: Update Validation
```
Tenant 1 has: "HR", "IT", "Finance"

Edit "HR" to "IT":
  - ❌ Error (IT already exists in tenant 1)

Edit "HR" to "Sales":
  - ✅ Success (Sales doesn't exist in tenant 1)
```

### Test 4: Client-Side Validation
```
Tenant 1 User opens Add modal:
  - Types "HR" → Shows error (exists in tenant 1)
  - Types "Sales" → No error (doesn't exist)

Tenant 2 User opens Add modal:
  - Types "HR" → Shows error (exists in tenant 2)
  - Types "IT" → No error (doesn't exist in tenant 2, exists in tenant 1)
```

## Important Notes

1. **Automatic Tenant Assignment**: When creating a business unit, tenant_id is automatically set from the logged-in user
2. **Authorization Check**: Service layer verifies tenant ownership before updates/deletes
3. **Client & Server Validation**: Both layers check uniqueness per tenant
4. **Soft Deletes**: Deleted records are excluded from uniqueness checks
5. **Case Insensitive**: "HR", "hr", "Hr" are considered duplicates

## Migration Notes

If you have existing data without tenant isolation:
1. Ensure all business_units have tenant_id set
2. Check for cross-tenant name conflicts
3. Update any direct database queries to include tenant_id filter

## API Endpoints Affected

All these endpoints now respect tenant isolation:

- `GET /insighthub/settings/general-settings/organization-structure/business-units/getData`
  - Returns only current tenant's data
  
- `POST /insighthub/settings/general-settings/organization-structure/business-units`
  - Validates uniqueness per tenant
  - Sets tenant_id automatically
  
- `PUT /insighthub/settings/general-settings/organization-structure/business-units/{id}`
  - Validates uniqueness per tenant
  - Verifies ownership
  
- `DELETE /insighthub/settings/general-settings/organization-structure/business-units/{id}`
  - Verifies ownership before deletion
