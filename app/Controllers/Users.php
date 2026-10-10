<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        return view('users/index', [
            'users' => (new UserModel())->orderBy('username', 'ASC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('users/new');
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|max_length[50]',
            'full_name' => 'required|max_length[100]',
            'password'  => 'required|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return view('users/new', ['validation' => $this->validator]);
        }

        (new UserModel())->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'avatar'     => $this->uploadAvatar(),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('users'));
    }

    public function edit($id)
    {
        $user = (new UserModel())->find($id);

        if (! $user) {
            return redirect()->to(site_url('users'));
        }

        return view('users/edit', ['user' => $user]);
    }

    public function update($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        $rules = [
            'username'  => 'required|max_length[50]',
            'full_name' => 'required|max_length[100]',
            'password'  => 'permit_empty|min_length[8]',
        ];

        if (! $this->validate($rules)) {
            return view('users/edit', [
                'user'       => $user,
                'validation' => $this->validator,
            ]);
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'avatar'    => $this->uploadAvatar() ?? $user['avatar'],
        ];

        $newPassword = $this->request->getPost('password');

        if ($newPassword !== '') {
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $model->update($id, $data);

        return redirect()->to(site_url('users'));
    }

    public function delete($id)
    {
        (new UserModel())->delete($id);

        return redirect()->to(site_url('users'));
    }

    private function uploadAvatar()
    {
        $file = $this->request->getFile('avatar');

        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        if (! in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'], true)) {
            return null;
        }

        if ($file->getSize() > 5 * 1024 * 1024) {
            return null;
        }

        $path = FCPATH . 'uploads/avatars';

        if (! is_dir($path)) {
            mkdir($path, 0775, true);
        }

        $name = $file->getRandomName();
        $file->move($path, $name);

        return $name;
    }
}
