<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PropertyModel;

class GIS extends BaseController
{
    public function index()
    {
        return view('admin/gis');
    }

    public function getProperties()
    {
        $model = new ParcelModel();
        $properties = $model->findAll();
        return $this->response->setJSON($properties);
    }
}
