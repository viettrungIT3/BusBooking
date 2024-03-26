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
}