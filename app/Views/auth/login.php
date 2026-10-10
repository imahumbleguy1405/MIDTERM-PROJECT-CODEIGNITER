<?= view('layout/header', ['title' => 'Login']) ?>

<h1>POS Login</h1>

<?php if (session()->getFlashdata('error')): ?>
    <p style="color: red;"><?= esc(session()->getFlashdata('error')) ?></p>
<?php endif; ?>

<form action="<?= site_url('login/authenticate') ?>" method="post">
    <?= csrf_field() ?>

    <p>
        <label>Username</label><br>
        <input type="text" name="username" value="<?= old('username') ?>" required>
    </p>

    <p>
        <label>Password</label><br>
        <input type="password" name="password" required>
    </p>

    <button type="submit">Login</button>
</form>

<?= view('layout/footer') ?>
