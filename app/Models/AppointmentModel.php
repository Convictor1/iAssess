<?php

namespace App\Models;
use CodeIgniter\Model;

class AppointmentModel extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fullname', 'email', 'contact_number', 'purpose',
        'preferred_date', 'preferred_time', 'status'
    ];
}
