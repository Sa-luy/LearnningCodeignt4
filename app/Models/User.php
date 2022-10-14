<?php
namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields =[
        'name',
        'email',
        'address',
        'gender',
        'day_of_birth',
        'rights_group_id',
    ];
   
}


?>