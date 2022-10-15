<?php

namespace App\Models;

use CodeIgniter\Model;
use \Tatter\Relations\Traits\ModelTrait;

class User extends Model
{
    protected $with = 'rights_groups';
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
    public function rights_groups($id=null)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('rights_group');
        $builder->select('rights_group.id,rights_group.name,rights_group.description');
        $builder->join('users', 'rights_group.id = users.rights_group_id');
        $builder->distinct();
        if($id){
            $builder->where('users.id', $id);
            $query = $builder->get();
         return $query->getResult();    
        }
        $query = $builder->get();
        return $query->getResult();   


        }
}
