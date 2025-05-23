<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AppointmentModel;
use App\Models\DocumentModel;
use Dompdf\Dompdf;

class Report extends BaseController
{
    public function export()
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
            'rejectedDocuments' => $documentModel->where('status', 'rejected')->countAllResults(),
        ];

        $html = view('admin/report_pdf', $data);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("iAssess_Report.pdf", ["Attachment" => false]); // open in browser
    }
}
