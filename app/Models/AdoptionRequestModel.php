<?php

namespace App\Models;

use CodeIgniter\Model;

class AdoptionRequestModel extends Model
{
    protected $table = 'adoption_requests';

    protected $primaryKey = 'id';

    protected $allowedFields = [
        'pet_id',
        'adopter_name',
        'adopter_email',
        'phone',
        'address',
        'occupation',
        'reason',
        'status'
    ];

    protected $useTimestamps = true;

    protected $createdField = 'created_at';

    protected $updatedField = 'updated_at';
}