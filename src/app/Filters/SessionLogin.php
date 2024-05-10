<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionLogin implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        if (($session->get('logged_in') == NULL || $session->get('admin_logged_in') == NULL) && (time() - $session->get('lastActivity') > 7200)) {
            $session->remove('logged_in');
            $session->remove('admin_logged_in');
            // Lưu URL hiện tại vào session trước khi chuyển hướng đến trang đăng nhập
            $session->set('redirect_url', '/' . uri_string());
            return redirect()->to('/login');
        }

        if ($session->get('admin_logged_in')) {
            $session->set('lastActivity', time());
        }
        if ($session->get('logged_in')) {
            $session->set('lastActivity', time());

            // Kiểm tra xem có URL trước đó trong session không
            $redirect_url = $session->get('redirect_url');
            if ($redirect_url) {
                // Xóa URL đã lưu trong session
                $session->remove('redirect_url');
                // Chuyển hướng người dùng đến URL trước đó
                return redirect()->to($redirect_url);
            }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
