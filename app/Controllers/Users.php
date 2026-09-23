<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
        $data['users'] = [
            [
                'username' => 'admin',
                'full_name' => 'Christian',
                'role' => 'Administrator'
            ],
            [
                'username' => 'cashier01',
                'full_name' => 'Christopher',
                'role' => 'Cashier'
            ],
            [
                'username' => 'manager01',
                'full_name' => 'Christine',
                'role' => 'Manager'
            ],
            [
                'username' => 'staff01',
                'full_name' => 'Jonila',
                'role' => 'Store Staff'
            ],
            [
                'username' => 'staff02',
                'full_name' => 'Edgardo',
                'role' => 'Store Staff'
            ]
        ];

        return view('users', $data);
    }
}