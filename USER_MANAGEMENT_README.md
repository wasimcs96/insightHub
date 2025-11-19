# User Management Feature Documentation

## Overview
This is a comprehensive user management system with full CRUD operations, Ajax-powered data loading, advanced filtering, pagination, and bulk operations.

## Features Implemented

### 1. **CRUD Operations**
- ✅ Create new users
- ✅ Read/View user details
- ✅ Update existing users
- ✅ Delete users (single and bulk)

### 2. **Ajax Data Loading**
- Real-time data fetching without page refresh
- Smooth user experience
- Loading indicators
- Error handling

### 3. **Search & Filter**
- Real-time search across name, email, employee code, job position, and department
- Filter by department
- Filter by job position
- Filter by onboarding email status
- Active filters display with remove option

### 4. **Pagination**
- Configurable results per page (10, 25, 50, 100)
- Page navigation
- Display current page info (showing X-Y of Z)
- Maintains state across operations

### 5. **Sorting**
- Sort by employee name
- Sort by department
- Sort by onboarding status
- Sort by job position
- Toggle ascending/descending order

### 6. **Bulk Operations**
- Bulk user selection
- Bulk delete users
- Bulk send onboarding emails
- Bulk upload via CSV/Excel

### 7. **User Interface**
- Modern, clean design
- Responsive layout
- Empty states
- Loading states
- Success/Error notifications
- Modal dialogs for operations

## File Structure

```
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── InsightHub/
│   │   │       └── UserManagementController.php    # Main controller
│   │   └── Requests/
│   │       └── InsightHub/
│   │           ├── StoreUserRequest.php           # Validation for creating users
│   │           └── UpdateUserRequest.php          # Validation for updating users
│   ├── Services/
│   │   └── InsightHub/
│   │       └── UserService.php                    # Business logic layer
│   └── Models/
│       └── User.php                               # User model (existing)
├── database/
│   └── migrations/
│       └── 2025_11_07_000001_add_user_management_fields_to_users_table.php
├── public/
│   └── js/
│       └── user-management.js                     # Ajax and frontend logic
├── resources/
│   └── views/
│       └── InsightHub/
│           └── settings/
│               └── user-management/
│                   └── index.blade.php            # Main view
└── routes/
    └── insightHub.php                             # Routes definition
```

## Architecture

### **MVC + Service Layer Pattern**

```
View (Blade) 
    ↓ (Ajax Requests)
Controller 
    ↓ (Business Logic)
Service Layer 
    ↓ (Data Operations)
Model/Database
```

### **Separation of Concerns**

1. **Controller**: Handles HTTP requests/responses
2. **Service**: Contains business logic and data operations
3. **Request Classes**: Validate incoming data
4. **Model**: Represents database entities
5. **View**: Displays UI
6. **JavaScript**: Handles frontend interactions

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/insighthub/settings/user-management` | Display user management page |
| GET | `/insighthub/settings/user-management/getData` | Fetch paginated users with filters |
| GET | `/insighthub/settings/user-management/filter-options` | Get available filter options |
| GET | `/insighthub/settings/user-management/statistics` | Get user statistics |
| GET | `/insighthub/settings/user-management/{id}` | Get single user details |
| POST | `/insighthub/settings/user-management` | Create new user |
| PUT | `/insighthub/settings/user-management/{id}` | Update existing user |
| DELETE | `/insighthub/settings/user-management/{id}` | Delete single user |
| POST | `/insighthub/settings/user-management/bulk-delete` | Delete multiple users |
| POST | `/insighthub/settings/user-management/bulk-upload` | Bulk upload users via CSV/Excel |
| POST | `/insighthub/settings/user-management/{id}/send-onboarding-email` | Send onboarding email to user |
| POST | `/insighthub/settings/user-management/bulk-send-onboarding-email` | Send onboarding emails to multiple users |

## Database Schema

### New Fields Added to `users` Table

```sql
- employee_code (string, nullable) - Unique employee identifier
- job_position (string, nullable) - User's job position
- department (string, nullable) - User's department
- onboarding_email_status (enum: 'Sent', 'Pending') - Email status
- profile_picture (string, nullable) - Path to profile image
- is_active (boolean, default: true) - Account status
```

## Usage Instructions

### 1. **Run Migration**
```bash
php artisan migrate
```

### 2. **Access the Feature**
Navigate to: `/insighthub/settings/user-management`

### 3. **Add a User**
- Click "Add User" button
- Fill in required fields:
  - Full Name *
  - Email Address *
  - Job Position *
  - Department *
  - Password *
  - Confirm Password *
- Optional fields:
  - Employee Code
  - Profile Picture
- Click "Save"

### 4. **Search Users**
- Type in the search box
- Results update automatically (500ms debounce)
- Searches across name, email, employee code, job position, department

### 5. **Filter Users**
- Click "Filter" button
- Select filter criteria:
  - Department
  - Job Position
  - Onboarding Status
- Click "Apply"
- Active filters display with remove option

### 6. **Edit User**
- Click three-dot menu (⋮) next to user
- Select "Edit"
- Update fields
- Click "Save"

### 7. **Delete User**
- Single delete: Click three-dot menu → "Delete"
- Bulk delete: Select checkboxes → Click delete (in modal)
- Confirm deletion

### 8. **Send Onboarding Emails**
- Select users via checkboxes
- Click "Send Onboarding Email"
- Confirm action

### 9. **Bulk Upload**
- Click "Bulk Upload"
- Select CSV/Excel file
- File should contain: Name, Email, Employee Code, Job Position, Department
- Click "Upload"

### 10. **Pagination**
- Change results per page (10, 25, 50, 100)
- Navigate using page numbers
- Use < and > for previous/next

## Validation Rules

### Create User
- **name**: required, string, max 255 characters
- **email**: required, email, unique
- **employee_code**: optional, string, max 50, unique
- **job_position**: required, string, max 255
- **department**: required, string, max 255
- **password**: required, min 8 characters, confirmed
- **profile_picture**: optional, image (jpeg, png, jpg, gif), max 2MB

### Update User
- Same as create, but:
- **password**: optional (only when changing)
- **email**: unique except for current user
- **employee_code**: unique except for current user

## Security Features

1. **CSRF Protection**: All POST/PUT/DELETE requests require CSRF token
2. **Authorization**: Only Admin and Company users can access
3. **Validation**: Server-side validation for all inputs
4. **File Upload**: Restricted to image types, size limited to 2MB
5. **Password Hashing**: Passwords automatically hashed with bcrypt

## Customization

### Change Pagination Defaults
In `public/js/user-management.js`:
```javascript
let perPage = 10; // Change default results per page
```

### Add Custom Filters
1. Add filter field in `index.blade.php`
2. Update `activeFilters` object in JavaScript
3. Handle filter in `UserService::getPaginatedUsers()`

### Customize Table Columns
Edit the table in `index.blade.php` and update `renderUsers()` function in JavaScript

## Troubleshooting

### Data Not Loading
- Check browser console for errors
- Verify routes are registered: `php artisan route:list | grep user-management`
- Check database connection
- Verify CSRF token is present in page

### Validation Errors Not Displaying
- Ensure `.invalid-feedback` elements exist in form
- Check field name mapping in `displayValidationErrors()`

### Images Not Uploading
- Verify storage is linked: `php artisan storage:link`
- Check file permissions on `storage` directory
- Verify max upload size in `php.ini`

### Ajax Requests Failing
- Check network tab in browser dev tools
- Verify API endpoints are accessible
- Check Laravel logs: `storage/logs/laravel.log`

## Testing

### Manual Testing Checklist
- [ ] Create new user
- [ ] Edit existing user
- [ ] Delete user
- [ ] Search functionality
- [ ] Filter by department
- [ ] Filter by job position
- [ ] Filter by onboarding status
- [ ] Pagination navigation
- [ ] Results per page change
- [ ] Sort by columns
- [ ] Bulk select/deselect
- [ ] Bulk delete
- [ ] Send onboarding email
- [ ] Bulk upload
- [ ] Form validation errors
- [ ] Empty states
- [ ] Loading states

## Future Enhancements

- [ ] Export users to CSV/Excel
- [ ] Advanced search with multiple criteria
- [ ] User roles and permissions
- [ ] Activity logs
- [ ] Email templates customization
- [ ] User import validation preview
- [ ] Bulk edit functionality
- [ ] User groups/teams
- [ ] Two-factor authentication
- [ ] Password reset functionality

## Support

For issues or questions, please contact the development team or create an issue in the project repository.

## License

This feature is part of the InsightHub project and follows the same license terms.
