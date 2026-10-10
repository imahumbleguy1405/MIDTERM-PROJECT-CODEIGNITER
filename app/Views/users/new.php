<?= view('layout/header', ['title' => 'Add Staff']) ?>

<h1>Add Staff Member</h1>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form action="<?= site_url('users/create') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <p>Username<br><input type="text" name="username" required></p>
    <p>Full Name<br><input type="text" name="full_name" required></p>
    <p>Password<br><input type="password" name="password" required></p>
    <p>Avatar<br><input type="file" name="avatar" accept="image/jpeg,image/png,image/webp"></p>
    <button type="submit">Save Staff Member</button>
</form>

<?= view('layout/footer') ?>
