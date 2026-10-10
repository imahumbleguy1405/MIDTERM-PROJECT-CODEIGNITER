<?= view('layout/header', ['title' => 'Edit Product']) ?>

<h1>Edit Product</h1>

<?php if (isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>

<form action="<?= site_url('products/update/' . $product['id']) ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <p>Name<br><input type="text" name="name" value="<?= esc($product['name']) ?>" required></p>
    <p>Price<br><input type="number" name="price" step="0.01" min="0" value="<?= esc($product['price']) ?>" required></p>
    <p>Stock Quantity<br><input type="number" name="stock_quantity" min="0" value="<?= esc($product['stock_quantity']) ?>" required></p>
    <p>Replace Image<br><input type="file" name="image" accept="image/jpeg,image/png,image/webp"></p>

    <button type="submit">Update Product</button>
</form>

<?= view('layout/footer') ?>
