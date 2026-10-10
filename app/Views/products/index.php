<?= view('layout/header', ['title' => 'Products']) ?>

<h1>Products</h1>

<p><a href="<?= site_url('products/new') ?>">Add Product</a></p>

<table border="1" cellpadding="5">
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($products as $product): ?>
        <tr>
            <td>
                <?php if (! empty($product['image'])): ?>
                    <img src="<?= esc(base_url('uploads/products/' . $product['image'])) ?>" width="80" height="80" alt="Product image">
                <?php else: ?>
                    No image
                <?php endif; ?>
            </td>
            <td><?= esc($product['name']) ?></td>
            <td><?= esc(number_format((float) $product['price'], 2)) ?></td>
            <td><?= esc($product['stock_quantity']) ?></td>
            <td>
                <a href="<?= site_url('products/edit/' . $product['id']) ?>">Edit</a>
                <form action="<?= site_url('products/delete/' . $product['id']) ?>" method="post" style="display:inline">
                    <?= csrf_field() ?>
                    <button type="submit">Archive</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?= view('layout/footer') ?>
