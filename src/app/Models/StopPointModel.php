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
}