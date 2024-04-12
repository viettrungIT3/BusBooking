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
}