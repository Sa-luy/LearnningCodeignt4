<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'day_of_birth',
        'rights_group_id',
    ];
    public function findByKeywords($keywords)
    {
        
        $db = \Config\Database::connect();
        $sql= "SELECT * FROM `users` WHERE `name` LIKE '%$keywords%' 
        OR `email` LIKE '%$keywords%'
         OR`phone` LIKE '%$keywords%' 
        OR `gender` LIKE '%$keywords%'
        OR `address` LIKE '%$keywords%';";
        $query = $db->query($sql);

        $users = $query->getResultArray();

        // $builder = $db->table('users');
        // $users = $builder->like('name', $keywords);
        // ->orLike('email', $keywords)
        // ->orLike('phone', $keywords)
        // ->orLike('gender', $keywords)->get();
        

       

        return $users;
    }
}
