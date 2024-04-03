<?php
namespace App\Models;

use CodeIgniter\Model;

class BusSlideModel extends Model
{
    protected $table = 'bus_slides';
    protected $primaryKey = 'id';

    protected $allowedFields = ['bus_id', 'slide_url', 'slide_type', 'description'];
}