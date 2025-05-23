<?php

namespace App\Controllers\Admin;
use App\Models\DocumentModel;
use App\Controllers\BaseController;

class Documents extends BaseController
{
    public function index()
    {
        $model = new DocumentModel();
        $data['documents'] = $model->orderBy('created_at', 'DESC')->findAll();

        return view('admin/documents', $data);
    }
}
