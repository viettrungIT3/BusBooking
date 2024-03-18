<?php
namespace App\Models;

use CodeIgniter\Model;

class RoutesModel extends Model
{
    protected $table = 'routes';
    
    protected $allowedFields = [
        'origin',
        'destination',
        'listed_price'
    ];
}