<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AdministratorsModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        ini_set('memory_limit', '-1');
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    public function getAdministrator()
    {
        if (session()->get('current_admin_id') == null) {
            return redirect()->to('logout');
        }
        $adminModel = new AdministratorsModel();
        return $adminModel->find(session()->get('current_admin_id'));
    }

    public function sendEmail($to, $subject, $data, $template = 'emails/ex_notification', $file_attach = null, $fromName = null)
    {
        $email = \Config\Services::email();
        $config['mailType'] = 'html';

        $email->initialize($config);

        if (!$fromName) {
            $fromName = env('email.fromName');
        }

        $email->setFrom(env('email.fromEmail'), $fromName);
        $email->setTo($to);
        $email->setSubject($subject);

        if ($file_attach) {
            $cid = $email->attach(ROOTPATH . 'public/' . $file_attach,'inline');
        }
        $data['file_attach'] = $file_attach;

        // Render nội dung email từ template
        $message = view($template, $data);

        $email->setMessage($message);

        if ($email->send()) {
            return true;
        } else {
            log_message('error', 'Email không thể gửi. Chi tiết: ' . print_r($email->printDebugger(['headers']), true));
            return false;
        }
    }

}
