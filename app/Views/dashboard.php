<?= view('layout/header', ['title' => 'Dashboard']) ?>

<h1>Point-of-Sale Dashboard</h1>

<p>Welcome, <?= esc(session()->get('full_name')) ?>.</p>

<ul>
    <li>Active products: <?= esc($productCount) ?></li>
    <li>Customers: <?= esc($customerCount) ?></li>
    <li>Staff: <?= esc($userCount) ?></li>
    <li>Sales recorded: <?= esc($saleCount) ?></li>
</ul>

<?= view('layout/footer') ?>
