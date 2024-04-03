<?php
namespace App\Models;

use CodeIgniter\Model;

class BusDetailModel extends Model
{
    protected $table = 'bus_details';
    protected $primaryKey = 'bus_id';

    protected $allowedFields = ['description', 'detailed_info', 'notes'];
}