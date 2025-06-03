<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table = 'user';
    protected $primarykey = 'id';
    protected $allowesFields = [
        'username', 'email', 'password', 'role', 'created_at', 'updated_at'
    ];
}