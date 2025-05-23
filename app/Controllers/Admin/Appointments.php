<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;

class Appointments extends BaseController
{
    public function index()
    {
        $model = new AppointmentModel();
        $data['appointments'] = $model->orderBy('created_at', 'DESC')->findAll();

        return view('admin/appointments', $data);
    }

    public function updateStatus($id, $status)
    {
       
    $allowedStatuses = ['approved', 'declined'];
    if (!in_array($status, $allowedStatuses)) {
        return redirect()->to('/admin/appointments')->with('error', 'Invalid status.');
    }

    $model = new AppointmentModel();
    $appointment = $model->find($id);

    if (!$appointment) {
        return redirect()->to('/admin/appointments')->with('error', 'Appointment not found.');
    }

    $model->update($id, ['status' => $status]);

    // Send email notification
    $email = \Config\Services::email();

    $email->setTo($appointment['email']);
    $email->setFrom('iassess@irigacity.gov.ph', 'iAssess System');

    $email->setSubject('Your Appointment Status Has Been Updated');
    $email->setMessage("
        Hello <strong>{$appointment['fullname']}</strong>,<br><br>
        Your appointment for <strong>{$appointment['purpose']}</strong> scheduled on 
        <strong>{$appointment['preferred_date']}</strong> at <strong>{$appointment['preferred_time']}</strong> 
        has been <strong>" . ucfirst($status) . "</strong>.<br><br>
        Reference No: <strong>{$appointment['reference_number']}</strong><br><br>
        Thank you for using iAssess.
    ");

    if (!$email->send()) {
        log_message('error', $email->printDebugger(['headers']));
    }

    return redirect()->to('/admin/appointments')->with('success', "Appointment $status and user notified.");

    }
}
