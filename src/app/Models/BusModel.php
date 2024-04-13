<?php
namespace App\Models;

use CodeIgniter\Model;

class BusModel extends Model
{
    protected $table = 'buses';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'license_plate',
        'seat_number',
        'status',
        'vehicle_type_id',
        'description',
        'notes'
    ];

    public function getCompleteBusDetails($busId)
    {
        $this->select('*');
        $this->where('id', $busId);
        $busData = $this->first();

        if (!$busData) {
            return null; // Trả về null nếu không tìm thấy xe bus
        }

        // Lấy thông tin offices
        $busOfficeModel = new \App\Models\BusOfficeModel();
        $offices = $busOfficeModel->where('bus_id', $busId)->findAll();

        // Lấy thông tin phones
        $busPhoneModel = new \App\Models\BusPhoneModel();
        $phones = $busPhoneModel->where('bus_id', $busId)->findAll();

        // Lấy thông tin slides
        $busSlideModel = new \App\Models\BusSlideModel();
        $slides = $busSlideModel->where('bus_id', $busId)->findAll();

        // Lấy thông tin utilities
        $db = \Config\Database::connect();
        $builder = $db->table('bus_utilities');
        $builder->select('utilities.id, utilities.name, utilities.description');
        $builder->join('utilities', 'utilities.id = bus_utilities.utility_id');
        $builder->where('bus_utilities.bus_id', $busId);
        $utilities = $builder->get()->getResult();

        // Thêm các thông tin liên kết vào mảng dữ liệu của xe bus
        $busData['offices'] = $offices ?? [];
        $busData['phones'] = $phones ?? [];
        $busData['slides'] = $slides ?? [];
        $busData['utilities'] = $utilities ?? [];

        return $busData;
    }

}