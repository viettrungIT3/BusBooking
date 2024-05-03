<?php

namespace App\Controllers;

require_once COMPOSER_PATH;

use App\Models\AdministratorsModel;
use App\Models\UserModel;
use Google_Service_Oauth2;

class AuthController extends BaseController
{
    private $userModel = NULL;
    private $googleClient = NULL;
    function __construct()
    {
        ini_set('memory_limit', '-1');
        $this->userModel = new UserModel();
        $this->googleClient = new \Google_Client();
        $this->googleClient->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->googleClient->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->googleClient->setRedirectUri(base_url('/login-with-google'));
        $this->googleClient->addScope("email");
        $this->googleClient->addScope("profile");
    }


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
            'identity' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tên đăng nhập là bắt buộc'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Mật khẩu là bắt buộc',
                    'min_length' => 'Mật khẩu phải có ít nhất {param} ký tự.'
                ]
            ],
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
                    'current_user' => $user,
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
                    'current_admin_id' => $user['id'],
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
            $data['googleButton'] = '<a href="' . $this->googleClient->createAuthUrl() . '" class="btn btn-block btn-danger"><i class="fab fa-google-plus mr-2"></i> Hoặc đăng nhập bằng Google+</a>';
            return view('login', $data);
        }
    }

    public function loginWithGoogle()
    {

        $token = $this->googleClient->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        if (!isset($token['error'])) {
            $this->googleClient->setAccessToken($token['access_token']);
            session()->set("AccessToken", $token['access_token']);

            $googleService = new Google_Service_Oauth2($this->googleClient);
            $data = $googleService->userinfo->get();
            $currentDateTime = date("Y-m-d H:i:s");

            $userdata = array();
            if ($this->userModel->isAlreadyRegister($data['id'])) {
                //User ALready Login and want to Login Again
                $userdata = [
                    'name' => $data['givenName'] . " " . $data['familyName'],
                    'email' => $data['email'],
                    'profile_img' => $data['picture'],
                    'updated_at' => $currentDateTime
                ];
                $this->userModel->updateUserData($userdata, $data['id']);
            } else {
                //new User want to Login
                $userdata = [
                    'oauth_id' => $data['id'],
                    'name' => $data['givenName'] . " " . $data['familyName'],
                    'email' => $data['email'],
                    'profile_img' => $data['picture'],
                    'created_at' => $currentDateTime
                ];
                $this->userModel->insertUserData($userdata);
            }
            $current_user = $this->userModel->getByEmail($data['email']);

            $ses_data = [
                'current_user' => $current_user,
                'logged_in' => true,
                'lastActivity' => time()
            ];
            session()->set($ses_data);

        } else {
            session()->setFlashData("Error", "Something went Wrong");
            return redirect()->to(base_url());
        }
        //Successfull Login
        return redirect()->to(base_url());

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
            $data['googleButton'] = '<a href="' . $this->googleClient->createAuthUrl() . '" class="btn btn-block btn-danger"><i class="fab fa-google-plus mr-2"></i> Hoặc đăng nhập bằng Google+</a>';
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
