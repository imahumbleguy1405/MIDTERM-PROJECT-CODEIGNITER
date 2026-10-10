<?php

namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $data = [
            'productCount'  => (new ProductModel())->where('is_archived', 0)->countAllResults(),
            'customerCount' => (new CustomerModel())->countAllResults(),
            'userCount'     => (new UserModel())->countAllResults(),
            'saleCount'     => (new SaleModel())->countAllResults(),
        ];

        return view('dashboard', $data);
    }
}
