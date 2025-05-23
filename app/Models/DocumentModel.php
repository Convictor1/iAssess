<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table = 'documents';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'fullname',
        'email',
        'file_name',
        'original_name',
        'doc_type',
        'status',
        'created_at'
    ];

    public $timestamps = false; // because you're manually setting created_at
}
