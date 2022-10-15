<?php

namespace App\Models;

use CodeIgniter\Model;

class RightsGroup extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'description',
 
    ];
 
}