<?php

namespace App\Controllers;
use App\Models\AppointmentModel;

class PublicPortal extends BaseController
{
    public function index()
    {
        return view('public/index');
    }

    public function trackStatus()
    {
        helper('form');

        $data = [];

        if ($this->request->getMethod() === 'post') {
            $ref = $this->request->getPost('reference_number');

            $model = new AppointmentModel();
            $result = $model->where('reference_number', $ref)->first();

            $data['result'] = $result ?? null;
            $data['searched'] = true;
        }

        return view('public/track_status', $data);
    }
}
