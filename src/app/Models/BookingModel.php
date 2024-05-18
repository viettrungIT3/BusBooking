<?php
namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'user_id',
        'schedule_id',
        'origin',
        'destination',
        'quantity',
        'notes',
        'status',
        'email',
        'created_at',
        'updated_at',
    ];

    // Rules
    // 'status'        => '[pending,confirmed,cancelled,expired,completed,refunded,failed,processing]',
}