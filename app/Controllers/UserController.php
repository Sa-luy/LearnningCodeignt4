<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\HTTP\Response;

class UserController extends BaseController
{
    public function index()
    {
        $data['title'] = 'List User';
        $keywords = $this->request->getPost('keywords');
        $userModel = new User();
        if (isset($keywords)) {
            $data['users']  = $userModel->findByKeywords($keywords);
        } else {

            $data['users'] = $userModel->orderBy('id', 'DESC')->findAll();
        }


        return view('users/index', $data);
    }
    public function create()
    {
        $data['title'] = 'Create User';
        return view('users/create',$data);
    }
    public function store()
    {
        $data['title'] = 'Create User';
        $user_rule = [
            'name'             => 'required',
            'email'            => 'required|valid_email',
            'phone'            => 'required',
            'address'          => 'required',
            'day_of_birth'     => 'required',
            'gender'           => 'required',
            'righst_group_id'  => 'required',
        ];
        
        if (strtolower($this->request->getMethod()) === 'post') {
            if ($this->validate($user_rule)) {

                $userModel = model(User::class);
                $userData = [
                    // 'name'                 => $this->request->getPost('name'),
                    'name'                 => $this->request->getVar('name'),
                    'email'                => $this->request->getPost('email'),
                    'phone'                => $this->request->getPost('phone'),
                    'address'              => $this->request->getPost('address'),
                    'gender'               => $this->request->getPost('gender'),
                    'day_of_birth'         => $this->request->getPost('day_of_birth'),
                    'rights_group_id '     => $this->request->getPost('righst_group_id'),
                ];


                // esc => escape character, help prevent XSS attacks 
                if ($userModel->save(esc($userData))) {

                    //redirect same page, and show flash success message
                    return redirect()->to(base_url('users'))->with('message_noti', 'Success create new user!');
                } else {
                    //redirect same page, and show flash error message
                    echo 34567;
                    die();
                    return redirect()->back()->with('message_error', 'Failed create new user!');
                }
            } else {
                // validation info
                $data['validation'] = $this->validator;
                return redirect()->back()->withInput()->with('message_error', 'Failed create new user, required!');
            }
        }

        return view('users/create', $data);
    }
    public function edit($id)
    { {
            $data['title'] = "Edit";
            $userModel = new User();
            $user = $userModel->find($id);
            if (empty($user)) {
                return redirect()->to(base_url('users'))->with('message_error', 'User not exist');
            }
            $data['user'] = $user;

            return view('users/edit', $data);
        }
    }
    public function update($id)
    {
        $data['title'] = "Edit";
        $userModel = new User();
        $user = $userModel->find($id);
        $data['user'] = $user;
        $user_rule = [
            'name'             => 'required',
            'email'            => 'required|valid_email',
            'phone'            => 'required|',
            'address'          => 'required',
            'day_of_birth'     => 'required',
            'gender'           => 'required',
            'righst_group_id'  => 'required',
        ];
        if ($this->validate($user_rule)) {

            if (empty($user)) {
                $data['validation'] = 'User not exist';
                return view('users/edit', $data);
            }
            $userData = [
                'name'                 => $this->request->getPost('name'),
                'email'                => $this->request->getPost('email'),
                'phone'                => $this->request->getPost('phone'),
                'address'              => $this->request->getPost('address'),
                'gender'               => $this->request->getPost('gender'),
                'day_of_birth'         => $this->request->getPost('day_of_birth'),
                'rights_group_id '     => $this->request->getPost('righst_group_id'),
            ];

            // esc => escape character, help prevent XSS attacks 

            if ($userModel->update($id, $userData)) {
                return redirect()->to(base_url('users'))->with('message_noti', 'Success update change!');
            } else {
                return redirect()->back()->with('message_error', 'Failed update change!');
            }
        } else {
            $data['validation'] = $this->validator;
        }
        return view('users/edit', $data);
    }
    public function destroy($id)
    {
        $userModel = new User();
        $data['user'] = $userModel->where('id', $id)->delete($id);

        if ($data['user']) {
            //     $data['statusCode'] = 200;
            //   $this->response->setStatusCode(200);
            return redirect()->to(base_url('users'))->with('message_noti', 'Success update change!');
        } else {
            return redirect()->back()->with('message_error', 'Failed update change!');
        }
    }
}
