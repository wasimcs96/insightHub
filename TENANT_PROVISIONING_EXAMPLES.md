# Tenant Provisioning API - Usage Examples

## Prerequisites
- Admin authentication credentials
- Valid subscription plan ID
- Unique email addresses and domain names

## Example 1: Provision a Parent Company

### Request
```bash
curl -X POST http://your-domain.com/admin/tenant-provisioning \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_AUTH_TOKEN" \
  -d '{
    "tenant": {
      "name": "Acme Corporation",
      "email": "info@acmecorp.com",
      "domain": "acmecorp",
      "subdomain": "acme",
      "country": "United States",
      "address": "123 Business Street, New York, NY 10001",
      "industry": "Technology",
      "status": "active",
      "contact_person_name": "John Smith",
      "mobile_number": "+1-555-0123",
      "is_parent_company": true,
      "is_subsidiary_company": false
    },
    "subscription_plan_id": 1,
    "admin_user": {
      "name": "John Smith",
      "email": "john.smith@acmecorp.com",
      "mobile_number": "+1-555-0123"
    }
  }'
```

### Response
```json
{
  "success": true,
  "message": "Tenant provisioned successfully. Credentials have been sent to the admin email.",
  "data": {
    "tenant": {
      "id": 1,
      "name": "Acme Corporation",
      "email": "info@acmecorp.com",
      "domain": "acmecorp",
      "status": "active",
      "slug": "acme-corporation",
      "is_subsidiary": false,
      "parent_tenant_id": null,
      "created_at": "2025-11-19T10:00:00.000000Z"
    },
    "admin_user": {
      "id": 1,
      "name": "John Smith",
      "email": "john.smith@acmecorp.com",
      "tenant_id": 1
    }
  }
}
```

## Example 2: Provision a Subsidiary Company

### Request
```bash
curl -X POST http://your-domain.com/admin/tenant-provisioning \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_AUTH_TOKEN" \
  -d '{
    "tenant": {
      "name": "Acme Europe",
      "email": "info@acmeeurope.com",
      "domain": "acmeeurope",
      "subdomain": "acme-europe",
      "country": "United Kingdom",
      "address": "456 London Road, London, UK",
      "industry": "Technology",
      "status": "active",
      "contact_person_name": "Jane Doe",
      "mobile_number": "+44-20-7946-0958",
      "is_parent_company": false,
      "is_subsidiary_company": true,
      "parent_tenant_id": 1
    },
    "subscription_plan_id": 1,
    "admin_user": {
      "name": "Jane Doe",
      "email": "jane.doe@acmeeurope.com",
      "mobile_number": "+44-20-7946-0958"
    }
  }'
```

### Response
```json
{
  "success": true,
  "message": "Tenant provisioned successfully. Credentials have been sent to the admin email.",
  "data": {
    "tenant": {
      "id": 2,
      "name": "Acme Europe",
      "email": "info@acmeeurope.com",
      "domain": "acmeeurope",
      "status": "active",
      "slug": "acme-europe",
      "is_subsidiary": true,
      "parent_tenant_id": 1,
      "created_at": "2025-11-19T10:05:00.000000Z"
    },
    "admin_user": {
      "id": 2,
      "name": "Jane Doe",
      "email": "jane.doe@acmeeurope.com",
      "tenant_id": 2
    }
  }
}
```

## Example 3: Get Available Subscription Plans

### Request
```bash
curl -X GET http://your-domain.com/admin/tenant-provisioning/plans \
  -H "Authorization: Bearer YOUR_AUTH_TOKEN"
```

### Response
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Basic Plan",
      "slug": "basic-plan",
      "modules": [
        {
          "id": 1,
          "name": "User Management",
          "slug": "user-management"
        },
        {
          "id": 2,
          "name": "Reports",
          "slug": "reports"
        }
      ]
    },
    {
      "id": 2,
      "title": "Premium Plan",
      "slug": "premium-plan",
      "modules": [
        {
          "id": 1,
          "name": "User Management",
          "slug": "user-management"
        },
        {
          "id": 2,
          "name": "Reports",
          "slug": "reports"
        },
        {
          "id": 3,
          "name": "Analytics",
          "slug": "analytics"
        }
      ]
    }
  ]
}
```

## Example 4: Get Active Parent Tenants

### Request
```bash
curl -X GET http://your-domain.com/admin/tenant-provisioning/parent-tenants \
  -H "Authorization: Bearer YOUR_AUTH_TOKEN"
```

### Response
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Acme Corporation",
      "email": "info@acmecorp.com",
      "domain": "acmecorp",
      "country": "United States",
      "industry": "Technology"
    },
    {
      "id": 3,
      "name": "Global Tech Inc",
      "email": "info@globaltech.com",
      "domain": "globaltech",
      "country": "Canada",
      "industry": "Technology"
    }
  ]
}
```

## Example 5: Error Response - Validation Failed

### Request (with invalid data)
```bash
curl -X POST http://your-domain.com/admin/tenant-provisioning \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_AUTH_TOKEN" \
  -d '{
    "tenant": {
      "name": "",
      "email": "invalid-email",
      "domain": ""
    },
    "subscription_plan_id": 999,
    "admin_user": {
      "name": "",
      "email": ""
    }
  }'
```

### Response
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "tenant.name": ["Company name is required."],
    "tenant.email": ["The tenant.email must be a valid email address."],
    "tenant.domain": ["Domain name is required."],
    "tenant.country": ["Country is required."],
    "tenant.address": ["Address is required."],
    "tenant.industry": ["Industry is required."],
    "tenant.contact_person_name": ["Contact person name is required."],
    "subscription_plan_id": ["The selected subscription plan does not exist."],
    "admin_user.name": ["Admin name is required."],
    "admin_user.email": ["Admin email is required."]
  }
}
```

## Example 6: Error Response - Parent Tenant Must Be Active

### Request
```bash
curl -X POST http://your-domain.com/admin/tenant-provisioning \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer YOUR_AUTH_TOKEN" \
  -d '{
    "tenant": {
      "name": "Subsidiary Company",
      "email": "info@subsidiary.com",
      "domain": "subsidiary",
      "country": "United States",
      "address": "789 Main St",
      "industry": "Technology",
      "status": "active",
      "contact_person_name": "Bob Johnson",
      "mobile_number": "+1-555-9999",
      "is_subsidiary_company": true,
      "parent_tenant_id": 99
    },
    "subscription_plan_id": 1,
    "admin_user": {
      "name": "Bob Johnson",
      "email": "bob@subsidiary.com",
      "mobile_number": "+1-555-9999"
    }
  }'
```

### Response
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "tenant.parent_tenant_id": ["The parent tenant must be active."]
  }
}
```

## Notes

1. **Authentication Required**: All endpoints require admin authentication
2. **Rate Limiting**: Maximum 10 requests per minute
3. **Email Notification**: Admin credentials are automatically sent via email
4. **Password Security**: Generated passwords contain uppercase, lowercase, numbers, and special characters
5. **Unique Constraints**: Email and domain must be unique across all tenants
6. **Parent Validation**: Parent tenant must exist and be active for subsidiary creation
7. **Transaction Safety**: All operations are wrapped in database transactions

## What Happens After Provisioning?

1. **Tenant Created**: A new tenant record is created in the database
2. **Subscription Assigned**: The selected plan is associated with the tenant
3. **Roles Created**: System roles are copied and assigned to the tenant
4. **Permissions Assigned**: Permissions based on plan modules are assigned to roles
5. **Admin User Created**: An admin user is created with a secure random password
6. **Email Sent**: Login credentials are sent to the admin email address
7. **Response Returned**: Success response with tenant and user details

## Troubleshooting

### Issue: "Validation failed" error
**Solution**: Check that all required fields are provided and have valid values

### Issue: "Parent tenant must be active" error
**Solution**: Ensure the parent_tenant_id points to an active tenant

### Issue: "Email already registered" error
**Solution**: Use a unique email address that hasn't been used before

### Issue: "Domain already taken" error
**Solution**: Use a unique domain name that hasn't been used before

### Issue: Rate limit exceeded
**Solution**: Wait for 1 minute before making another request

### Issue: Authentication failed
**Solution**: Ensure you have valid admin credentials and the auth token is correct
