<?= view('layout/header', ['title' => 'Sales History']) ?>

<h1>Sales History</h1>

<p><a href="<?= site_url('sales/new') ?>">Record Sale</a></p>

<table border="1" cellpadding="5">
    <tr>
        <th>Product</th>
        <th>Customer</th>
        <th>Staff</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Date</th>
    </tr>

    <?php foreach ($sales as $sale): ?>
        <tr>
            <td><?= esc($sale['product_name']) ?></td>
            <td><?= esc($sale['customer_name'] ?? 'Walk-in customer') ?></td>
            <td><?= esc($sale['staff_name']) ?></td>
            <td><?= esc($sale['quantity']) ?></td>
            <td><?= esc(number_format((float) $sale['total_price'], 2)) ?></td>
            <td><?= esc($sale['created_at']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?= view('layout/footer') ?>
