<?= view('layout/header', ['title' => 'Edit Staff']) ?>

<h1>Edit Staff Member</h1>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form action="<?= site_url('users/update/' . $user['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <p>Username<br><input type="text" name="username" value="<?= esc($user['username']) ?>" required></p>
    <p>Full Name<br><input type="text" name="full_name" value="<?= esc($user['full_name']) ?>" required></p>
    <p>New Password<br><input type="password" name="password" placeholder="Leave blank to keep current password"></p>
    <p>Replace Avatar<br><input type="file" name="avatar" accept="image/jpeg,image/png,image/webp"></p>
    <button type="submit">Update Staff Member</button>
</form>

<?= view('layout/footer') ?>
