<?php
namespace App\Models;

use CodeIgniter\Model;

class SchedulesModel extends Model
{
    protected $table = 'schedules';

    protected $allowedFields = [
        'bus_id',
        'route_id',
        'departure_time',
        'arrival_time',
        'price'
    ];


    public function getSchedules($busId = NULL, $origin = NULL, $destination = NULL, $departureTimeFormatted = NULL, $endDateFormatted = NULL, $limit = 10, $page = 1)
    {
        $builder = $this->db->table('schedules AS s');
        $builder->select('s.*');
        $builder->distinct();
        $builder->join('stop_points AS sp', 's.id = sp.schedule_id');

        if (!is_null($origin) && (!is_null($destination))) {
            $builder->join('stop_points AS sp2', 's.id = sp2.schedule_id');
            $builder->where('sp.name', $origin);
            $builder->where('sp2.name', $destination);
            $builder->where('sp.schedule_id = sp2.schedule_id');
            $builder->where('sp.sequence < sp2.sequence');
        } else if (!is_null($origin)) {
            $builder->join('stop_points AS sp2', 's.id = sp2.schedule_id');
            $builder->where('sp.name', $origin);
            $builder->where('sp.schedule_id = sp2.schedule_id');
            $builder->where('sp.sequence < sp2.sequence');
            // $builder->where('sp.sequence', 1);
        } else if (!is_null($destination)) {
            $builder->where('sp.name', $destination);
            $builder->where('sp.sequence !=', 1);
        }

        if ($busId)
            $builder->where('s.bus_id', $busId);

        if ($departureTimeFormatted)
            $builder->where('s.departure_time >=', $departureTimeFormatted);

        if ($endDateFormatted)
            $builder->where('s.arrival_time <=', $endDateFormatted);

        $builder->where('sp.arrival_time >=', 'NOW()', false); // Sử dụng tham số thứ ba là false để không bind giá trị NOW() như một string
        $builder->orderBy('s.departure_time', 'ASC');
        $builder->groupBy('s.id');
        $schedules = $builder->get($limit, ($page - 1) * $limit)->getResult();

        return $schedules;
    }

}