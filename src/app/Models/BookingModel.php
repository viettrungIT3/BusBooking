<?php
namespace App\Models;

use CodeIgniter\Model;

class BusUtilityModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $allowedFields = ['user_id', 'schedule_id', 'book_date', 'quantity', 'status', 'payment_status'];
}