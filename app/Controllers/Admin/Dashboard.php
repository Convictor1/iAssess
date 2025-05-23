<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use App\Models\DocumentModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $appointmentModel = new AppointmentModel();
        $documentModel = new DocumentModel();

        $data = [
            'totalAppointments' => $appointmentModel->countAll(),
            'approvedAppointments' => $appointmentModel->where('status', 'approved')->countAllResults(),
            'declinedAppointments' => $appointmentModel->where('status', 'declined')->countAllResults(),
            'pendingAppointments' => $appointmentModel->where('status', 'pending')->countAllResults(),

            'totalDocuments' => $documentModel->countAll(),
            'verifiedDocuments' => $documentModel->where('status', 'verified')->countAllResults(),
            'rejectedDocuments' => $documentModel->where('status', 'rejected')->countAllResults()
        ];

        return view('admin/dashboard', $data);
    }
}
