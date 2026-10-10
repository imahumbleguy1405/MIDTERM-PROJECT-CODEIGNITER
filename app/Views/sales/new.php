<?= view('layout/header', ['title' => 'Record Sale']) ?>

<h1>Record Sale</h1>

<?php if (! empty($error)): ?>
    <p style="color: red;"><?= esc($error) ?></p>
<?php endif; ?>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form action="<?= site_url('sales/create') ?>" method="post">
    <?= csrf_field() ?>

    <p>
        Product<br>
        <select name="product_id" required>
            <option value="">Select a product</option>
            <?php foreach ($products as $product): ?>
                <option value="<?= esc($product['id']) ?>">
                    <?= esc($product['name']) ?> — Stock: <?= esc($product['stock_quantity']) ?> — Price: <?= esc(number_format((float) $product['price'], 2)) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        Customer (optional)<br>
        <select name="customer_id">
            <option value="">Walk-in customer</option>
            <?php foreach ($customers as $customer): ?>
                <option value="<?= esc($customer['id']) ?>">
                    <?= esc($customer['full_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        Quantity<br>
        <input type="number" name="quantity" min="1" required>
    </p>

    <button type="submit">Record Sale</button>
</form>

<?= view('layout/footer') ?>
