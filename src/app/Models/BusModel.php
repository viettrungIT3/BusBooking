<?php
namespace App\Models;

use CodeIgniter\Model;

class BusModel extends Model
{
    protected $table = 'buses';
    
    protected $allowedFields = [
        'name',
        'license_plate',
        'seat_number'
    ];
}