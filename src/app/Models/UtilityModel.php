<?php
namespace App\Models;

use CodeIgniter\Model;

class UtilityModel extends Model
{
    protected $table = 'utilities';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'description'];
}