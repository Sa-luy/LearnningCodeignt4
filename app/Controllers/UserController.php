<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends BaseController
{
    public function index()
    {
        $user = new User();

        $data['users'] = $user->orderBy('id', 'DESC')->findAll();

        return view('users/index', $data);
    }
    public function create()
    {
        return view('users/create');
    }
    public function store()
    {

        $user_rule = [
            'name'         => 'required',
            'email'     => 'required|valid_email',
            'address'     => 'required',
            'day_of_birth'     => 'required',
            'gender'     => 'required',
            'righst_group_id'     => 'required',
        ];

        if (strtolower($this->request->getMethod()) === 'post') {
            if ($this->validate($user_rule)) {
                $userModel = model(User::class);
                $userData = [
                    'name'                 => $this->request->getPost('name'),
                    'email'              => $this->request->getPost('email'),
                    'address'           => $this->request->getPost('address'),
                    'gender'             => $this->request->getPost('gender'),
                    'day_of_birth'         => $this->request->getPost('day_of_birth'),
                    'rights_group_id '     => $this->request->getPost('righst_group_id'),
                ];


                // esc => escape character, help prevent XSS attacks 
                if ($userModel->save(esc($userData))) {

                    //redirect same page, and show flash success message
                    return redirect()->to(base_url('users'))->with('message_noti', 'Success create new user!');
                } else {
                    //redirect same page, and show flash error message
                    return redirect()->back()->with('message_error', 'Failed create new user!');
                }
            } else {
                // validation info
                $data['validation'] = $this->validator;
            }
        }

        return view('users/create', $data);
    }
}
