<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    
    protected $allowedFields = [
        'name', 
        'email',
        'password',
        'phone',
        'address'
    ];

    // Kiểm tra email đã tồn tại hay chưa
    public function isEmailExists($email) {
        $user = $this->where('email', $email)->first();
        if(!empty($user)){
            return true; 
        }else{
            return false;
        }
    }
    
}