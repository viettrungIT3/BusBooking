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
        'payment_status',
        'book_date'
    ];

    // Rules
    // 'status'        => '[pending,confirmed,cancelled,expired,completed,refunded,failed,processing]',
    // 'payment_status'=> '[paid,unpaid,refunded,failed]',
}