<?= view('layout/header', ['title' => 'Add Customer']) ?>

<h1>Add Customer</h1>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form action="<?= site_url('customers/create') ?>" method="post">
    <?= csrf_field() ?>
    <p>Full Name<br><input type="text" name="full_name" value="<?= old('full_name') ?>" required></p>
    <p>Email<br><input type="email" name="email" value="<?= old('email') ?>" required></p>
    <p>Phone<br><input type="text" name="phone" value="<?= old('phone') ?>"></p>
    <button type="submit">Save Customer</button>
</form>

<?= view('layout/footer') ?>
