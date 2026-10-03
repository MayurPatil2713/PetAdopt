<?php

namespace App\Models;

use CodeIgniter\Model;

class PetModel extends Model
{
    protected $table = 'pets';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'shelter_id',
        'name',
        'species',
        'breed',
        'age',
        'gender',
        'vaccination_status',
        'description',
        'image',
        'status'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}