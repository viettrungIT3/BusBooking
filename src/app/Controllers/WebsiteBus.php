<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class WebsiteBus extends Controller
{
    public function detail()
    {
        // Logic để lấy thông tin chi tiết xe khách từ CSDL
        $busData = []; // Thay thế này với dữ liệu thực tế từ CSDL

        // Truyền dữ liệu tới view
        $data = [
            'title' => 'Chi tiết xe khách',
            'busData' => $busData,
        ];

        return view('frontend/bus-detail', $data);
    }

    public function tickets()
    {
        // Logic để lấy thông tin chi tiết xe khách từ CSDL
        $busData = []; // Thay thế này với dữ liệu thực tế từ CSDL

        // Truyền dữ liệu tới view
        $data = [
            'title' => 'Đặt vé Đức Phúc Limousine',
            'busData' => $busData,
        ];

        // Dữ liệu filter
        $data['filters'] = [
            'common_criteria' => [
                'label' => 'Tiêu chí phổ biến',
                'is_show' => true,
                'options' => [
                    'common_criteria1' => [
                        'label' => 'Đón tận nơi',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'common_criteria2' => [
                        'label' => 'Trả tận nơi',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'common_criteria3' => [
                        'label' => 'Xe Limousine ghế ngồi',
                        'is_show' => true,
                        'checked' => false
                    ]
                ]
            ],
            'seat_bed' => [
                'label' => 'Ghế / giường',
                'is_show' => true,
                'options' => [
                    'seat_bed2' => [
                        'label' => 'Ghế ngồi',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'seat_bed3' => [
                        'label' => 'Giường nằm',
                        'is_show' => false,
                        'checked' => false
                    ]
                ]
            ],
            'departure_station' => [
                'label' => 'Bến đi',
                'is_show' => true,
                'options' => [
                    'departure_station1' => [
                        'label' => 'Đón Trả Tận Nơi',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station2' => [
                        'label' => '50 Võ Chí Công',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station3' => [
                        'label' => 'Ngã tư Xuân La',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station4' => [
                        'label' => 'Winmart Nhật Tân',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station5' => [
                        'label' => 'Đại học Giao Thông Vận Tải',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station6' => [
                        'label' => '180 Cầu Giấy',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station7' => [
                        'label' => 'Binh đoàn 789 ',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station8' => [
                        'label' => '94H quán trà đá Đường Láng',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station9' => [
                        'label' => '420 Đường Láng (Yên Lãng giao Láng)',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station10' => [
                        'label' => '530 Đường Láng (Lê Văn Lương gia',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station11' => [
                        'label' => '678 Đường Láng (Trần Duy Hưng gia',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station12' => [
                        'label' => '988 Đường Láng',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station13' => [
                        'label' => '275 Nguyễn Trãi',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station14' => [
                        'label' => 'BigC Hà Đông',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'departure_station15' => [
                        'label' => 'Sân bay Nội Bài',
                        'is_show' => true,
                        'checked' => false
                    ]
                ]
            ],
            'arrival_station' => [
                'label' => 'Bến đến',
                'is_show' => true,
                'options' => [
                    'arrival_station1' => [
                        'label' => 'Phú Bình (Trên Ql 37)',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'arrival_station2' => [
                        'label' => 'Văn phòng 257 Thống Nhất',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'arrival_station3' => [
                        'label' => 'Trả tận nơi Thái Nguyên',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'arrival_station4' => [
                        'label' => 'Trả tận nơi Tp Phổ Yên',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'arrival_station5' => [
                        'label' => 'Trả tận nơi Tp Sông Công',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'arrival_station6' => [
                        'label' => 'Trả tận nơi Phú Bình',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'arrival_station7' => [
                        'label' => 'Nút giao Yên Bình',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'arrival_station8' => [
                        'label' => 'Nút giao Sông Công',
                        'is_show' => true,
                        'checked' => false
                    ],
                ]
            ],
            'amenities' => [
                'label' => 'Tiện nghi',
                'is_show' => true,
                'options' => [
                    'amenity_1' => [
                        'label' => 'Wifi',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'amenity_2' => [
                        'label' => 'Cổng sạc USB',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'amenity_3' => [
                        'label' => 'LCD',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'amenity_4' => [
                        'label' => 'Nước uống',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'amenity_5' => [
                        'label' => 'Khăn lạnh',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'amenity_6' => [
                        'label' => 'Điều hòa',
                        'is_show' => true,
                        'checked' => false
                    ],
                    'amenity_7' => [
                        'label' => 'Chăn đắp',
                        'is_show' => true,
                        'checked' => false
                    ],
                ]
            ]
        ];

        return view('frontend/tickets/tickets', $data);
    }

    public function checkout()
    {
        $data = [
            'title' => 'Giỏ hàng & Thanh toán',
        ];
        return view('frontend/checkout/checkout', $data);
    }

    public function checkout_info()
    {
        // Kiểm tra xem session đã tồn tại chưa
        if (!session()->has('ticket_hold_start_time')) {
            // Nếu session chưa tồn tại, set thời điểm bắt đầu giữ vé và thời gian hết hạn của vé
            session()->set('ticket_hold_start_time', time());
            session()->setFlashdata('ticket_hold_start_time', true); // Đánh dấu session là session flash để session sẽ tự động xóa sau mỗi request

            // Thiết lập thời gian hết hạn cho session (15 phút)
            session()->setFlashdata('ticket_expiry_time', time() + 15 * 60); // Thời gian hết hạn tính bằng giây
        }

        // Tính thời gian còn lại của session
        $ticketHoldStartTime = session()->get('ticket_hold_start_time');
        $ticketExpiryTime = session()->get('ticket_expiry_time');
        $remainingTimeSeconds = $ticketExpiryTime - time();
        $remainingTimeMinutes = ceil($remainingTimeSeconds / 60);

        $data = [
            'title' => 'Thông tin thanh toán',
            'remaining_time' => $remainingTimeMinutes . ' phút',
            'remaining_time_seconds' => $remainingTimeSeconds
        ];

        return view('frontend/checkout-info/checkout-info', $data);
    }

    public function checkout_cancel()
    {
        if (session()->has('ticket_hold_start_time'))
            session()->remove('ticket_hold_start_time');
        if (session()->has('ticket_expiry_time'))
            session()->remove('ticket_expiry_time');
        $data = [
            'title' => 'Vé bị hủy',
        ];
        return view('frontend/checkout-cancel/index.php', $data);
    }
}
