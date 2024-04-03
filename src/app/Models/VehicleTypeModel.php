<?php
namespace App\Models;

use CodeIgniter\Model;

class VehicleTypeModel extends Model
{
    protected $table = 'vehicle_types';
    protected $primaryKey = 'id';

    protected $allowedFields = ['type_name', 'description'];
}