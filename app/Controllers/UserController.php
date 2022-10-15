<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\HTTP\Response;
use Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class UserController extends BaseController
{
    public function index()
    {
        $data['title'] = 'List User';
        $keywords = $this->request->getPost('keywords');
        $userModel = new User();
        $data['rights_groups'] = $userModel->rights_groups();
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
        return view('users/create', $data);
        
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
                // $this->db->trans_start();
                $userModel = model(User::class);
                $userData = [
                    // 'name'                 => $this->request->getPost('name'),
                    'name'                 => $this->request->getVar('name'),
                    'email'                => $this->request->getPost('email'),
                    'phone'                => $this->request->getPost('phone'),
                    'address'              => $this->request->getPost('address'),
                    'gender'               => $this->request->getPost('gender'),
                    'day_of_birth'         => $this->request->getPost('day_of_birth'),
                    'rights_group_id'     => $this->request->getPost('righst_group_id'),
                ];





                try {
                    $userModel->save(esc($userData));
                    // $this->db->trans_complete();
                    return redirect()->to(base_url('users'))->with('message_noti', 'Success create new user!');
                } catch (Exception $e) {
                    log_message('error', '[ERROR] {exception}', ['exception' => $e->getMessage()]);
                    // $this->db->trans_rollback();
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

    public function show($id)
    {
        $data['title'] = "Edit";
        $userModel = new User();
        $user = $userModel->find($id);
        if (empty($user)) {
            return redirect()->to(base_url('users'))->with('message_error', 'User not exist');
        }

        $data['user'] = $user;
        $data['user']['rights_group'] = ($userModel->rights_groups($user['id'])[0]->name);
        return view('users/show', $data);
    }

    public function edit($id)
    {
        $data['title'] = "Edit";
        $userModel = new User();
        $user = $userModel->find($id);
        if (empty($user)) {
            return redirect()->to(base_url('users'))->with('message_error', 'User not exist');
        }
        $data['user'] = $user;

        // echo "<pre>";
        // print_r ($user->with('rights_groups'));
        // echo "</pre>";
        // die();


        return view('users/edit', $data);
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
            // $this->db->trans_start();
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


            try {
                // $this->db->trans_complete();
                $userModel->update($id, $userData);
                return redirect()->to(base_url('users'))->with('message_noti', 'Success update change!');
            } catch (\Exception $e) {

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
            return redirect()->to(base_url('users'))->with('message_noti', 'Success delete user!');
        } else {
            return redirect()->back()->with('message_error', 'Failed delete user!');
        }
    }
    function exportUser()
    {
        $user = new User();

        $data = $user->findAll();

        $file_name = 'userExcel.xlsx';

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet()->fromArray($data, null, 'A3');

        $sheet->setCellValue('A1', 'ID');

        $sheet->setCellValue('B1', 'User Name');

        $sheet->setCellValue('C1', 'Email Address');

        $sheet->setCellValue('D1', 'User Phone');

        $sheet->setCellValue('E1', 'Address');

        $sheet->setCellValue('F1', 'Day of Birth');

        $sheet->setCellValue('G1', 'Gender');

        $sheet->setCellValue('H1', 'Role');

        $sheet->setCellValue('I1', 'Create day');






        $count = 2;

        foreach ($data as $row) {
            $sheet->setCellValue('A' . $count, $row['id']);

            $sheet->setCellValue('B' . $count, $row['name']);

            $sheet->setCellValue('C' . $count, $row['email']);

            $sheet->setCellValue('D' . $count, $row['phone']);

            $sheet->setCellValue('E' . $count, $row['address']);

            $sheet->setCellValue('F' . $count, $row['day_of_birth']);

            $sheet->setCellValue('G' . $count, $row['gender']);

            $sheet->setCellValue('H' . $count, $row['rights_group_id']);

            $sheet->setCellValue('I' . $count, $row['create_at']);


            $count++;
        }

        $writer = new Xlsx($spreadsheet);

        $writer->save($file_name);

        header("Content-Type: application/vnd.ms-excel");

        header('Content-Disposition: attachment; filename="' . basename($file_name) . '"');

        header('Expires: 0');

        header('Cache-Control: must-revalidate');

        header('Pragma: public');

        header('Content-Length:' . filesize($file_name));

        flush();

        readfile($file_name);

        exit;
    }
}
