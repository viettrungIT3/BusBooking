<?php
namespace App\Models;

use CodeIgniter\Model;

class BusPhoneModel extends Model
{
    protected $table = 'bus_phones';
    protected $primaryKey = 'id';

    protected $allowedFields = ['bus_id', 'phone_number'];
}