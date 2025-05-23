<?php

namespace App\Models;

use CodeIgniter\Model;

class ParcelModel extends Model
{
    protected $table = 'parcels';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'lot_number', 'owner_name', 'barangay', 'classification',
        'area', 'latitude', 'longitude', 'tax_declaration_id'
    ];
    protected $useTimestamps = true;
}
