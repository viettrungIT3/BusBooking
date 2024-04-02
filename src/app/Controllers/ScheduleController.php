<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ScheduleController extends Controller
{
    public function index()
    {
        $request = \Config\Services::request();
        $busModel = new \App\Models\BusModel();
    $routesModel = new \App\Models\RoutesModel();
    $stopPointModel = new \App\Models\StopPointModel();
        $db = \Config\Database::connect();
    
        // Lấy và xử lý tham số truyền vào
        $origin = $request->getGet('origin');
        $destination = $request->getGet('destination');
        $departureTime = $request->getGet('departureTime');
    
        // Xử lý giá trị mặc định cho thời gian đi
        $now = new \DateTime();
        $endDate = $departureTime ? (new \DateTime($departureTime))->modify('+7 days') : (new \DateTime())->modify('+7 days');
        $departureTimeFormatted = $departureTime ? (new \DateTime($departureTime))->format('Y-m-d H:i:s') : $now->format('Y-m-d H:i:s');
        $endDateFormatted = $endDate->format('Y-m-d H:i:s');
    
        // Khởi tạo query builder
        $builder = $db->table('schedules AS s');
        $builder->select('s.*');
        $builder->join('buses AS b', 's.bus_id = b.id');
        $builder->join('routes AS r', 's.route_id = r.id');
        $builder->where('b.status', 1);
        
        // Áp dụng điều kiện lọc dựa trên tham số truyền vào
        if ($origin) {
            $builder->where('r.origin', $origin);
        }
        if ($destination) {
            $builder->where('r.destination', $destination);
        }
        $builder->where('s.departure_time >=', $departureTimeFormatted);
        $builder->where('s.departure_time <=', $endDateFormatted);
    
        // Thực hiện truy vấn để lấy lịch trình
        $schedules = $builder->get()->getResult();
    
        // Lấy thông tin điểm dừng cho mỗi lịch trình
        foreach ($schedules as &$schedule) {
            $spBuilder = $db->table('stop_points');
            $spBuilder->select('*');
            $spBuilder->where('schedule_id', $schedule->id);
            $spBuilder->orderBy('sequence', 'ASC');
            $schedule->bus = $busModel->find($schedule->bus_id);
            $schedule->route = $routesModel->find($schedule->route_id);
            $schedule->stop_points = $spBuilder->get()->getResult();
        }

        $data = [
            'title' => 'Lịch Trình - Đức Phúc Limousine',
            'schedules' => $schedules,
        ];

        //     return view('frontend/tickets/tickets', $data);
        // }

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

        return view('frontend/schedules/index', $data);
    }
}
