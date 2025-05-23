<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ParcelModel;

class ParcelController extends BaseController
{
    public function create()
    {
        helper(['form']);

        if ($this->request->getMethod() === 'post') {
            $model = new ParcelModel();

            $data = [
                'lot_number' => $this->request->getPost('lot_number'),
                'owner_name' => $this->request->getPost('owner_name'),
                'barangay' => $this->request->getPost('barangay'),
                'classification' => $this->request->getPost('classification'),
                'area' => $this->request->getPost('area'),
                'latitude' => $this->request->getPost('latitude'),
                'longitude' => $this->request->getPost('longitude')
            ];

            if (!$model->save($data)) {
                return view('admin/add_parcel', [
                    'error' => 'Something went wrong.',
                    'validation' => $model->errors()
                ]);
            }

            return redirect()->to('/admin/gis')->with('success', 'Parcel added successfully!');
        }

        return view('admin/add_parcel');
    }
    public function fetch()
    {
        $model = new ParcelModel();
        $parcels = $model->findAll();

        return $this->response->setJSON($parcels);
    }

}
