<?php
namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'booking_id',
        'method_id',
        'image',
        'status',
        'created_at'
    ];

    // Rules
    // 'status'=> '[unpaid,pending,confirmed,reverification,cancelled,refunded,failed]',
    public static function getStatusOptions()
    {
        return [
            'unpaid' => 'Chưa thanh toán',
            'pending' => 'Chờ duyệt',
            'confirmed' => 'Xác nhận',
            'reverification' => 'Xác minh lại',
            'cancelled' => 'Hủy',
            'refunded' => 'Hoàn trả',
            'failed' => 'Thất bại',
        ];
    }

    public function listPaymentStatusesWithDescriptions()
    {
        return [
            [
                'status' => 'unpaid',
                'description' => 'Chưa thanh toán'
            ],
            [
                'status' => 'pending',
                'description' => 'Đang chờ xử lý'
            ],
            [
                'status' => 'confirmed',
                'description' => 'Đã xác nhận'
            ],
            [
                'status' => 'reverification',
                'description' => 'Cần xác minh lại'
            ],
            [
                'status' => 'cancelled',
                'description' => 'Đã hủy'
            ],
            [
                'status' => 'refunded',
                'description' => 'Đã hoàn tiền'
            ],
            [
                'status' => 'failed',
                'description' => 'Thất bại'
            ]
        ];
    }

}