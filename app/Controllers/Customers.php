<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index()
    {
        return view('customers/index', [
            'customers' => (new CustomerModel())->orderBy('full_name', 'ASC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('customers/new');
    }

    public function create()
    {
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return view('customers/new', ['validation' => $this->validator]);
        }

        (new CustomerModel())->insert([
            'full_name'  => $this->request->getPost('full_name'),
            'email'      => $this->request->getPost('email'),
            'phone'      => $this->request->getPost('phone'),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('customers'));
    }

    public function edit($id)
    {
        $customer = (new CustomerModel())->find($id);

        if (! $customer) {
            return redirect()->to(site_url('customers'));
        }

        return view('customers/edit', ['customer' => $customer]);
    }

    public function update($id)
    {
        $rules = [
            'full_name' => 'required|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]',
            'phone'     => 'permit_empty|max_length[20]',
        ];

        $model = new CustomerModel();

        if (! $this->validate($rules)) {
            return view('customers/edit', [
                'customer'   => $model->find($id),
                'validation' => $this->validator,
            ]);
        }

        $model->update($id, [
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'phone'     => $this->request->getPost('phone'),
        ]);

        return redirect()->to(site_url('customers'));
    }

    public function delete($id)
    {
        (new CustomerModel())->delete($id);

        return redirect()->to(site_url('customers'));
    }
}
