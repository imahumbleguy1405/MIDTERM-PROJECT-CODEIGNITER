<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    public function index()
    {
        $data['products'] = (new ProductModel())
            ->where('is_archived', 0)
            ->orderBy('name', 'ASC')
            ->findAll();

        return view('products/index', $data);
    }

    public function new()
    {
        return view('products/new');
    }

    public function create()
    {
        $rules = [
            'name'           => 'required|max_length[100]',
            'price'          => 'required|decimal',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return view('products/new', [
                'validation' => $this->validator,
            ]);
        }

        $model = new ProductModel();
        $model->insert([
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $this->uploadImage(),
            'is_archived'    => 0,
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('products'));
    }

    public function edit($id)
    {
        $product = (new ProductModel())
            ->where('is_archived', 0)
            ->find($id);

        if (! $product) {
            return redirect()->to(site_url('products'));
        }

        return view('products/edit', ['product' => $product]);
    }

    public function update($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        $rules = [
            'name'           => 'required|max_length[100]',
            'price'          => 'required|decimal',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
        ];

        if (! $this->validate($rules)) {
            return view('products/edit', [
                'product'    => $product,
                'validation' => $this->validator,
            ]);
        }

        $image = $product['image'];
        $newImage = $this->uploadImage();

        if ($newImage !== null) {
            $image = $newImage;
        }

        $model->update($id, [
            'name'           => $this->request->getPost('name'),
            'price'          => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image'          => $image,
        ]);

        return redirect()->to(site_url('products'));
    }

    public function delete($id)
    {
        (new ProductModel())->update($id, [
            'is_archived' => 1,
        ]);

        return redirect()->to(site_url('products'));
    }

    private function uploadImage()
    {
        $file = $this->request->getFile('image');

        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        if (! in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'], true)) {
            return null;
        }

        if ($file->getSize() > 5 * 1024 * 1024) {
            return null;
        }

        $path = FCPATH . 'uploads/products';

        if (! is_dir($path)) {
            mkdir($path, 0775, true);
        }

        $name = $file->getRandomName();
        $file->move($path, $name);

        return $name;
    }
}
