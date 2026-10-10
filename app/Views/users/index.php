<?= view('layout/header', ['title' => 'Staff']) ?>

<h1>Staff</h1>

<p><a href="<?= site_url('users/new') ?>">Add Staff Member</a></p>

<table border="1" cellpadding="5">
    <tr>
        <th>Avatar</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($users as $user): ?>
        <tr>
            <td>
                <?php if (! empty($user['avatar'])): ?>
                    <img src="<?= esc(base_url('uploads/avatars/' . $user['avatar'])) ?>" width="80" height="80" alt="Avatar">
                <?php else: ?>
                    No avatar
                <?php endif; ?>
            </td>
            <td><?= esc($user['username']) ?></td>
            <td><?= esc($user['full_name']) ?></td>
            <td>
                <a href="<?= site_url('users/edit/' . $user['id']) ?>">Edit</a>
                <form action="<?= site_url('users/delete/' . $user['id']) ?>" method="post" style="display:inline">
                    <?= csrf_field() ?>
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?= view('layout/footer') ?>
