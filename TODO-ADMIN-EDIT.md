# Admin User Edit/Update - TODO

## Status: 🚀 In Progress

### Steps:
- [ ] 1. Implement Admin\UserController.php: index() list all users, edit(), update()
- [ ] 2. Create resources/views/admin/users/index.blade.php
- [ ] 3. Create resources/views/admin/users/edit.blade.php  
- [ ] 4. Add update role/is_active form validation
- [ ] 5. Update routes/web.php if needed
- [ ] 6. Test admin edit functionality
- [ ] 7. Add mass update or search if time allows

**Next:** Controller implementation.

**AI Prompt Template:**
```
Create admin user edit/update for Laravel app with User model (role, is_active fields). 
- Controller: Admin\\UserController (index, edit, update)
- Views: admin/users/index.blade.php, admin/users/edit.blade.php 
- Use profile/edit.blade.php as style reference
- Routes: admin.users (protected by role:admin)
- Validation: role enum, is_active boolean
```

