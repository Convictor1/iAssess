<?php

namespace App\Controllers;

use App\Models\AppointmentModel;
use CodeIgniter\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AppointmentController extends BaseController
{
    public function create()
    {
        return view('public/schedule'); // your form view
    }

    public function store()
    {
        helper(['form']);

        $fullname = $this->request->getPost('fullname');
        $email = $this->request->getPost('email');
        $appointmentDate = $this->request->getPost('appointment_date');
        $transactionNumber = strtoupper(uniqid('TXN-'));

        $data = [
            'fullname' => $fullname,
            'email' => $email,
            'appointment_date' => $appointmentDate,
            'transaction_number' => $transactionNumber
        ];

        $appointmentModel = new AppointmentModel();
        $appointmentModel->save($data);

        // Send email using PHPMailer
        require_once(APPPATH . '../vendor/autoload.php'); // Make sure autoload is included

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USERNAME;
            $mail->Password = SMTP_PASSWORD;
            $mail->SMTPSecure = 'ssl'; // or 'tls' for port 587
            $mail->Port = SMTP_PORT;

            // Recipients
            $mail->setFrom(SMTP_FROM, SMTP_FROM_NAME);
            $mail->addAddress($email, $fullname);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Appointment Confirmation';
            $mail->Body = view('emails/appointment_email', [
                'fullname' => $fullname,
                'transaction_number' => $transactionNumber
            ]);

            $mail->send();
            return redirect()->to('/confirmation')->with('success', 'Appointment submitted and confirmation email sent!');
        } catch (Exception $e) {
            log_message('error', "Email error: {$mail->ErrorInfo}");
            return redirect()->back()->with('error', 'Appointment saved, but email failed to send.');
        }
    }
}
