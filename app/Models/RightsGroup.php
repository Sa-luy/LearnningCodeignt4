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
    public function user()
    {
        return $this->belongsTo('user', 'App\Models\User');
        // $this->belongsTo('propertyName', 'model', 'foreign_key', 'owner_key');
    }
}