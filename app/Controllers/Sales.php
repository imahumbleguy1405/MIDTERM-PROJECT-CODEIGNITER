<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;

class Sales extends BaseController
{
    public function index()
    {
        $sales = db_connect()
            ->table('sales s')
            ->select('s.*, p.name AS product_name, c.full_name AS customer_name, u.full_name AS staff_name')
            ->join('products p', 'p.id = s.product_id')
            ->join('customers c', 'c.id = s.customer_id', 'left')
            ->join('users u', 'u.id = s.sold_by')
            ->orderBy('s.created_at', 'DESC')
            ->get()
            ->getResultArray();

        return view('sales/index', ['sales' => $sales]);
    }

    public function new()
    {
        return view('sales/new', [
            'products'  => (new ProductModel())->where('is_archived', 0)->where('stock_quantity >', 0)->orderBy('name', 'ASC')->findAll(),
            'customers' => (new CustomerModel())->orderBy('full_name', 'ASC')->findAll(),
        ]);
    }

    public function create()
    {
        $rules = [
            'product_id' => 'required|integer',
            'customer_id' => 'permit_empty|integer',
            'quantity'   => 'required|integer|greater_than[0]',
        ];

        if (! $this->validate($rules)) {
            return $this->newWithError($this->validator->listErrors());
        }

        $db = db_connect();
        $productId = (int) $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id') ?: null;
        $quantity = (int) $this->request->getPost('quantity');

        $db->transBegin();

        $product = $db->query(
            'SELECT * FROM products WHERE id = ? AND is_archived = 0 FOR UPDATE',
            [$productId]
        )->getRowArray();

        if (! $product) {
            $db->transRollback();
            return $this->newWithError('The selected product does not exist.');
        }

        if ($quantity > (int) $product['stock_quantity']) {
            $db->transRollback();
            return $this->newWithError(
                'Not enough stock. Available quantity: ' . $product['stock_quantity']
            );
        }

        $total = number_format((float) $product['price'] * $quantity, 2, '.', '');

        (new SaleModel())->insert([
            'product_id'  => $productId,
            'customer_id' => $customerId,
            'sold_by'     => session()->get('user_id'),
            'quantity'    => $quantity,
            'total_price' => $total,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        (new ProductModel())->update($productId, [
            'stock_quantity' => (int) $product['stock_quantity'] - $quantity,
        ]);

        if (! $db->transStatus()) {
            $db->transRollback();
            return $this->newWithError('The sale could not be recorded.');
        }

        $db->transCommit();

        return redirect()->to(site_url('sales'));
    }

    private function newWithError($error)
    {
        return view('sales/new', [
            'products'  => (new ProductModel())->where('is_archived', 0)->where('stock_quantity >', 0)->orderBy('name', 'ASC')->findAll(),
            'customers' => (new CustomerModel())->orderBy('full_name', 'ASC')->findAll(),
            'error'     => $error,
        ]);
    }
}
