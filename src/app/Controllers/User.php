<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\AdministratorsModel;

class User extends Controller
{
    public function login()
    {

        helper(['form']);    // Kiểm tra session
        $session = session();
        if ($session->get('logged_in')) {
            return redirect()->to('/');
        }
        if ($session->get('admin_logged_in')) {
            return redirect()->to('/admin/dashboard');
        }

        $rules = [
            'identity' => 'required',
            'password' => 'required|min_length[6]'
        ];

        if ($this->validate($rules)) {
            $userModel = new UserModel();

            $identity = $this->request->getVar('identity');
            $password = $this->request->getVar('password');

            // Kiểm tra xem đăng nhập bằng email hay phone
            $user = $this->isEmail($identity) ?
                $userModel->where('email', $identity)->first() :
                $userModel->where('phone', $identity)->first();

            if ($user && password_verify($password, $user['password'])) {
                $ses_data = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'logged_in' => true,
                    'lastActivity' => time()
                ];
                $session->set($ses_data);

                return redirect()->to('');
            }

            // Kiểm tra xem đăng nhập voi admin khong
            $adminModel = new AdministratorsModel();
            $user = $adminModel->where('user_name', $identity)->first();

            if ($user && password_verify($password, $user['password'])) {
                $ses_data = [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'admin_logged_in' => true,
                    'lastActivity' => time()
                ];
                $session->set($ses_data);

                return redirect()->to('/admin/dashboard');
            }

            return redirect()->to('/login')->with('error', 'Đăng nhập thất bại. Vui lòng kiểm tra lại thông tin đăng nhập.');

        } else {
            $data['validation'] = $this->validator;
            $data['title'] = 'Đăng nhập';
            return view('login', $data);
        }
    }

    public function register()
    {
        helper(['form']);
        $session = session();
        $session->destroy();

        $rules = [
            'name' => 'required|min_length[3]|max_length[30]',
            'email' => 'valid_email|is_unique[users.email]',
            'phone' => 'regex_match[/^[0-9]{8,15}$/]|is_unique[users.phone]',
            'password' => 'required|min_length[6]'
        ];

        if ($this->validate($rules)) {
            $userModel = new UserModel();

            $name = $this->request->getVar('name');
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];

            try {
                $userModel->save($data);
                return redirect()->to('/login')->with('success', 'Đăng ký thành công. Vui lòng đăng nhập!');
            } catch (\Exception $e) {
                // Xử lý lỗi khi lưu dữ liệu vào cơ sở dữ liệu
                return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
            }
        } else {
            $data['validation'] = $this->validator;
            $data['title'] = 'Đăng ký';
            return view('register', $data);
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    // Kiểm tra xem chuỗi có dạng email không
    private function isEmail($str)
    {
        return filter_var($str, FILTER_VALIDATE_EMAIL) !== false;
    }
}
