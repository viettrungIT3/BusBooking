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

    // Fetch bookings with optional filters
    public function getBookings($filters = [])
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');

        // Apply filters if provided
        if (!empty($filters['startDate'])) {
            $builder->where('created_at >=', $filters['startDate']);
        }
        if (!empty($filters['endDate'])) {
            $endDate = date('Y-m-d H:i:s', strtotime($filters['endDate'] . ' 23:59:59'));
            $builder->where('created_at <=', $endDate);
        }
        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }
        if (!empty($filters['schedule'])) {
            $builder->where('schedule_id', $filters['schedule']);
        }

        return $builder->get()->getResultArray();
    }

    public function getBookingsWithPaymentStatus($filters = [])
    {
        $builder = $this->db->table($this->table);
        $builder->select('bookings.*, payments.status as payment_status');
        $builder->join('payments', 'payments.booking_id = bookings.id', 'left'); // Giả sử rằng 'left' join để có thể lấy cả những booking không có payment

        // Apply filters if provided
        if (!empty($filters['startDate'])) {
            $builder->where('bookings.created_at >=', $filters['startDate']);
        }
        if (!empty($filters['endDate'])) {
            $endDate = date('Y-m-d H:i:s', strtotime($filters['endDate'] . ' 23:59:59'));
            $builder->where('bookings.created_at <=', $endDate);
        }
        if (!empty($filters['status'])) {
            $builder->where('bookings.status', $filters['status']);
        }
        if (!empty($filters['schedule'])) {
            $builder->where('bookings.schedule_id', $filters['schedule']);
        }
        if (!empty($filters['payment_status'])) {
            $builder->where('payments.status', $filters['payment_status']);
        }

        return $builder->get()->getResultArray();
    }


    // Fetch distinct statuses for filter options
    public function getDistinctStatuses()
    {
        $builder = $this->db->table($this->table);
        $builder->select('status');
        $builder->distinct();
        return $builder->get()->getResultArray();
    }

    // Fetch distinct statuses for filter options by date
    public function getDistinctStatusesByDate($startDate, $endDate)
    {
        $builder = $this->db->table($this->table);
        $builder->select('status');
        $builder->distinct();
        if (!empty($filters['startDate']))
            $builder->where('created_at >=', $startDate . ' 00:00:00');
        if (!empty($filters['endDate']))
            $builder->where('created_at <=', $endDate . ' 23:59:59');
        return $builder->get()->getResultArray();
    }

    // Fetch distinct schedules based on bookings within a date range
    public function getDistinctSchedulesByDate($startDate, $endDate)
    {
        $builder = $this->db->table($this->table);
        $builder->select('schedules.id, routes.origin, routes.destination, schedules.price');
        $builder->join('schedules', 'schedules.id = bookings.schedule_id');
        $builder->join('routes', 'routes.id = schedules.route_id');
        if (!empty($filters['startDate']))
            $builder->where('bookings.created_at >=', $startDate . ' 00:00:00');
        if (!empty($filters['endDate']))
            $builder->where('bookings.created_at <=', $endDate . ' 23:59:59');
        $builder->groupBy('schedules.id');
        return $builder->get()->getResultArray();
    }
}