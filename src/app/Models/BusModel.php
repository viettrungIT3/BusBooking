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

    public function getRoutesByBusId($bus_id)
    {
        $builder = $this->db->table('schedules s');
        $builder->select('r.origin, r.destination, r.listed_price, COUNT(*) as count'); 
        $builder->join('routes r', 's.route_id = r.id', 'inner');
        $builder->where('s.bus_id', $bus_id);
        $builder->groupBy('r.origin, r.destination, r.listed_price'); 
        $builder->orderBy('count', 'DESC');
        $routes = $builder->get()->getResult();
    
        return $routes;
    }
    

    public function getUniqueStopPointsName($busId = NULL)
    {
        $db = \Config\Database::connect();
    
        // Lấy danh sách nơi đi qua duy nhất với điều kiện arrival_time >= NOW()
        $stopPointBuilder = $db->table('schedules');
        $stopPointBuilder->distinct();
        $stopPointBuilder->select('stop_points.name');
        $stopPointBuilder->join('stop_points', 'stop_points.schedule_id = schedules.id');
        $stopPointBuilder->where('stop_points.arrival_time >=', 'NOW()', false); // Sử dụng tham số thứ ba là false để không bind giá trị NOW() như một string
        if ($busId) {
            $stopPointBuilder->where('schedules.bus_id', $busId);
        }
        $stopPoints = $stopPointBuilder->get()->getResult();
    
        return $stopPoints;
    }
}