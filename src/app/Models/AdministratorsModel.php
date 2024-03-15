<?php
namespace App\Models;

use CodeIgniter\Model;

class AdministratorsModel extends Model
{
    protected $table = 'administrators';
    
    protected $allowedFields = [
        'name', 
        'user_name',
        'password',
        'role'
    ];    
}