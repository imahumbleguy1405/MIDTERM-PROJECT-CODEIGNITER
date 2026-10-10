<?= view('layout/header', ['title' => 'Add Product']) ?>

<h1>Add Product</h1>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form action="<?= site_url('products/create') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <p>Name<br><input type="text" name="name" value="<?= old('name') ?>" required></p>
    <p>Price<br><input type="number" name="price" step="0.01" min="0" value="<?= old('price') ?>" required></p>
    <p>Stock Quantity<br><input type="number" name="stock_quantity" min="0" value="<?= old('stock_quantity', 0) ?>" required></p>
    <p>Product Image<br><input type="file" name="image" accept="image/jpeg,image/png,image/webp"></p>

    <button type="submit">Save Product</button>
</form>

<?= view('layout/footer') ?>
