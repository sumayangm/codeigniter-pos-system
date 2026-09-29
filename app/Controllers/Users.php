<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        return view('users', [
            'users' => $userModel->findAll()
        ]);
    }

    public function newUser()
    {
        return view('user_form', ['user' => null]);
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|min_length[3]|max_length[100]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();

        $userModel->insert([
            'username'   => $this->request->getPost('username'),
            'full_name'  => $this->request->getPost('full_name'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/users')
            ->with('message', 'User added successfully.');
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('user_form', ['user' => $user]);
    }

    public function update($id)
    {
        $rules = [
            'username'  => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|min_length[3]|max_length[100]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('avatar');

        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE) {
            $fileRules = [
                'avatar' => 'uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]'
            ];

            if (! $this->validateData([], $fileRules)) {
                return redirect()->back()
                    ->withInput()
                    ->with('errors', $this->validator->getErrors());
            }
        }

        $data = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name')
        ];

        if ($file && $file->getError() !== UPLOAD_ERR_NO_FILE && $file->isValid()) {
            $newName = $file->getRandomName();

            service('image')
                ->withFile($file)
                ->fit(200, 200, 'center')
                ->save(FCPATH . 'uploads/' . $newName);

            $data['avatar'] = $newName;
        }

        $userModel = new UserModel();
        $userModel->update($id, $data);

        return redirect()->to('/users')
            ->with('message', 'User updated successfully.');
    }
}