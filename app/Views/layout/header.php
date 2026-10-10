<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'POS System') ?></title>
</head>
<body>

<?php if (session()->get('isLoggedIn')): ?>
    <nav>
        <a href="<?= site_url('dashboard') ?>">Dashboard</a> |
        <a href="<?= site_url('products') ?>">Products</a> |
        <a href="<?= site_url('customers') ?>">Customers</a> |
        <a href="<?= site_url('users') ?>">Staff</a> |
        <a href="<?= site_url('sales') ?>">Sales</a> |
        <a href="<?= site_url('logout') ?>">Logout</a>
    </nav>
    <hr>
<?php endif; ?>

