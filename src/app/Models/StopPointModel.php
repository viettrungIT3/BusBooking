<?php
namespace App\Models;

use CodeIgniter\Model;

class StopPointModel extends Model
{
    protected $table = 'stop_points';

    protected $allowedFields = [
        'schedule_id',
        'name',
        'arrival_time',
        'sequence',
        'is_lock'
    ];

    public function getUniqueName($busId = NULL)
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