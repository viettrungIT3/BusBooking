<?php
namespace App\Models;

use CodeIgniter\Model;

class BusUtilityModel extends Model
{
    protected $table = 'bus_utilities';
    // Không đặt primaryKey vì bảng này sử dụng composite key

    protected $allowedFields = ['bus_id', 'utility_id'];
}