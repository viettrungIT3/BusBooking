<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BusModel;
use App\Models\BusSlideModel;
use App\Models\BusUtilityModel;
use App\Models\BusOfficeModel;
use App\Models\BusPhoneModel;
use App\Models\UtilityModel;

class BusController extends BaseController
{

    public function __construct()
    {
        ini_set('memory_limit', '-1');
    }

    public function index()
    {
        $busModel = new BusModel();

        $data = [
            'title' => 'Quản lý xe buýt',
            'current_user' => $this->getAdministrator(),
            'bus' => $busModel->findAll() ?? [],
        ];
        return view('admin/bus/index.php', $data);
    }

    public function create()
    {
        helper(['form']);
        $busModel = new BusModel();
        $utilityModel = new UtilityModel();
        $busSlideModel = new BusSlideModel();
        $db = \Config\Database::connect();

        $rules = [
            'name' => 'required|min_length[10]|max_length[50]',
            'license_plate' => 'required|min_length[5]|max_length[20]',
            'seat_number' => 'required',
            'description' => 'required',
        ];

        if ($this->validate($rules)) {
            $dataBus = [
                'name' => $this->request->getVar('name'),
                'license_plate' => $this->request->getVar('license_plate'),
                'seat_number' => (int) $this->request->getVar('seat_number'),
                'description' => $this->request->getVar('description') ?? NULL,
                'notes' => $this->request->getVar('notes') ?? NULL,
                'status' => 1
            ];


            $db->transStart(); // Bắt đầu transaction

            try {
                $busModel->insert($dataBus, false);
                $busId = $busModel->getInsertID();

                if ($this->request->getVar('utilities')) {
                    $busUtilityModel = new BusUtilityModel();
                    foreach ($this->request->getVar('utilities') as $utilityId) {
                        $busUtilityModel->where('bus_id', $busId)->where('utility_id', $utilityId)->delete();
                        $busUtilityData = [
                            'bus_id' => $busId,
                            'utility_id' => $utilityId
                        ];
                        $builder = $db->table('bus_utilities');
                        $builder->insert($busUtilityData);
                    }
                }

                if ($this->request->getVar('office_address')) {
                    $busOfficeModel = new BusOfficeModel();
                    foreach ($this->request->getVar('office_address') as $officeAddress) {
                        $busOfficeData = [
                            'bus_id' => $busId,
                            'office_address' => $officeAddress
                        ];

                        $busOfficeModel->save($busOfficeData);
                    }
                }

                if ($this->request->getVar('phone_number')) {
                    $BusPhoneModel = new BusPhoneModel();
                    foreach ($this->request->getVar('phone_number') as $phoneNumber) {
                        $busOfficeData = [
                            'bus_id' => $busId,
                            'phone_number' => $phoneNumber
                        ];
                        $BusPhoneModel->save($busOfficeData);
                    }
                }

                // Xử lý tải lên và lưu bus_slides
                $files = $this->request->getFiles();
                if (isset($files['files'])) {
                    foreach ($files['files'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $file->move(WRITEPATH . 'uploads', $newName);

                            $busSlideModel->insert([
                                'bus_id' => $busId,
                                'slide_url' => $newName // Lưu ý: cần điều chỉnh đường dẫn tương đối hoặc tuyệt đối tùy theo cách bạn truy cập file sau này
                            ]);
                        }
                    }
                }

                $db->transComplete(); // Kết thúc transaction

                if ($db->transStatus() === false) {
                    return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra trong quá trình thêm mới.');
                }

                return redirect()->to('/admin/bus')->with('success', 'Thêm mới thành công');
            } catch (\Exception $e) {
                // exit($e->getMessage());
                return redirect()->back()->withInput()->with('error', 'Có lỗi xảy ra trong quá trình thêm mới.');
            }
        }
        $data = [
            'title' => 'Quản lý xe buýt',
            'current_user' => $this->getAdministrator(),
            'validation' => $this->validator,
            'utilities' => $utilityModel->findAll(),
        ];

        return view('admin/bus/create.php', $data);
    }
}