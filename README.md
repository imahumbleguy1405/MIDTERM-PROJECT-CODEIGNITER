# POS System

This is a separate CodeIgniter 4 application layer for the POS project.

1. Create a fresh CodeIgniter 4 project named `pos_system`.
2. Copy this package's `app/` folder into that project.
3. Copy the contents of `public/uploads/` into the fresh project's `public/uploads/` folder.
4. Import `database/pos_db.sql` through phpMyAdmin.
5. Copy `.env.example` to `.env` and update the database name and base URL.
6. Generate a password with `public/hash.php`, update the demo user's password in phpMyAdmin, then delete `hash.php`.

The default XAMPP URL is:

`http://localhost/pos_system/public/`

The database uses soft archiving for products. Sales use a transaction and row locking so stock cannot be reduced below zero during a sale.
