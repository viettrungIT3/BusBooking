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

    /**
     * Lấy tất cả đặt chỗ trong khoảng ngày chỉ định.
     * 
     * @param string $startDate Ngày bắt đầu.
     * @param string $endDate Ngày kết thúc.
     * @return array
     */
    public function getBookingsByDate($startDate, $endDate)
    {
        // Thêm 23 giờ, 59 phút, 59 giây vào ngày kết thúc để bao gồm cả ngày
        $endDateTime = new \DateTime($endDate);
        $endDateTime->setTime(23, 59, 59);
        $formattedEndDate = $endDateTime->format('Y-m-d H:i:s');
    
        // Định nghĩa truy vấn lấy đặt chỗ
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('created_at >=', $startDate);
        $builder->where('created_at <=', $formattedEndDate); 
    
        // Thực hiện truy vấn và trả về kết quả
        $query = $builder->get();
        return $query->getResultArray();
    }
    
}