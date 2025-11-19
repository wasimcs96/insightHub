# Tenant Provisioning API Documentation

## Overview
This API provides comprehensive tenant provisioning functionality with support for parent-subsidiary hierarchies.

## API Endpoints

### 1. Provision New Tenant
**POST** `/admin/tenant-provisioning`

Creates a new tenant with complete setup including:
- Tenant creation
- Subscription plan assignment
- Role and permission setup
- Admin user creation
- Email notification with credentials

### 2. Get Available Plans
**GET** `/admin/tenant-provisioning/plans`

Returns all available subscription plans with their associated modules.

### 3. Get Parent Tenants
**GET** `/admin/tenant-provisioning/parent-tenants`

Returns list of active tenants that can be selected as parent tenants for subsidiaries.

## Request Format

```json
{
  "tenant": {
    "name": "Company Name",
    "email": "contact@company.com",
    "domain": "company-domain",
    "country": "Country",
    "address": "Full address",
    "industry": "Industry",
    "status": "active",
    "contact_person_name": "Contact Name",
    "is_parent_company": false,
    "is_subsidiary_company": true,
    "parent_tenant_id": 1
  },
  "subscription_plan_id": 1,
  "admin_user": {
    "name": "Admin Name",
    "email": "admin@company.com",
    "mobile_number": "1234567890"
  }
}
```

## Features
- Parent-subsidiary tenant hierarchy
- Automatic role cloning from system roles
- Permission assignment based on subscription plan modules
- Secure password generation
- Email notifications with credentials
- Database transactions for data integrity
- Comprehensive logging
- Bulk insert operations for performance
