# TODO: Add New Accounts (Admin Feature)

**Plan:**
1. [ ] AdminController: create, store, index users
2. [ ] Routes: /admin/users (role:admin) 
3. [ ] Views: resources/views/admin/users/index.blade.php + create.blade.php
4. [ ] Update User model: role, is_active fields
5. [ ] Migration: add role/is_active to users (if missing)
6. [ ] Log creation in SystemLog
7. [ ] Bulk actions (suspend/enable/delete)
8. [ ] Search/pagination
9. [ ] Profile sidebar → Admin Panel link

**Files:**
- app/Http/Controllers/Admin/UserController.php
- resources/views/admin/users/
- routes/web.php (admin group)

