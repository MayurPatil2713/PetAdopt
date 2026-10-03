<?php

namespace App\Models;

use CodeIgniter\Model;

class ShelterModel extends Model
{
    protected $table = 'shelters';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'phone',
        'address'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}