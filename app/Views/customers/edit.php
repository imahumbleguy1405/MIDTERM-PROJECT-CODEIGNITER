<?= view('layout/header', ['title' => 'Edit Customer']) ?>

<h1>Edit Customer</h1>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form action="<?= site_url('customers/update/' . $customer['id']) ?>" method="post">
    <?= csrf_field() ?>
    <p>Full Name<br><input type="text" name="full_name" value="<?= esc($customer['full_name']) ?>" required></p>
    <p>Email<br><input type="email" name="email" value="<?= esc($customer['email']) ?>" required></p>
    <p>Phone<br><input type="text" name="phone" value="<?= esc($customer['phone']) ?>"></p>
    <button type="submit">Update Customer</button>
</form>

<?= view('layout/footer') ?>
