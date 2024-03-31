<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class RouteController extends BaseController
{
    public function index(): string
    {
        $routesModel = new \App\Models\RoutesModel();

        $data = [
            'title' => 'Quản lý tuyến đường',
            'current_user' => $this->getAdministrator(),
            'routes' => $routesModel->findAll() ?? [],
        ];
        return view('admin/routes/index.php', $data);
    }

    public function create()
    {
        helper(['form']);
        $routesModel = new \App\Models\RoutesModel();

        $rules = [
            'origin' => 'required|min_length[3]|max_length[255]',
            'destination' => 'required|min_length[3]|max_length[255]',
            'listed_price' => 'required|numeric|greater_than[0]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'origin' => $this->request->getVar('origin'),
                'destination' => $this->request->getVar('destination'),
                'listed_price' => $this->request->getVar('listed_price')
            ];
            try {
                $routesModel->save($data);
                return redirect()->to('/admin/routes')->with('success', 'Thêm mới thành công');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
            }
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }


}