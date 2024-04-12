<?php
namespace App\Models;

use CodeIgniter\Model;

class BusOfficeModel extends Model
{
    protected $table = 'bus_offices';
    // protected $primaryKey = 'id';

    protected $allowedFields = ['bus_id', 'office_address'];
}