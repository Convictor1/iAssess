<?php

namespace App\Controllers;

use App\Models\DocumentModel;
use CodeIgniter\Controller;

class DocumentController extends BaseController
{
    public function upload()
    {
        return view('public/upload_doc');
    }

    public function saveupload()
    {
        $validation = \Config\Services::validation();

        // Validate input + file
        $rules = [
            'fullname' => 'required',
            'email' => 'required|valid_email',
            'doc_type' => 'required',
            'document' => 'uploaded[document]|max_size[document,2048]|ext_in[document,pdf,doc,docx,jpg,jpeg,png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode('<br>', $validation->getErrors()));
        }

        $file = $this->request->getFile('document');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName(); // unique filename
            $file->move(WRITEPATH . 'uploads', $newName);

            // Save to DB
            $docModel = new DocumentModel();
            $docModel->insert([
                'fullname'       => $this->request->getPost('fullname'),
                'email'          => $this->request->getPost('email'),
                'doc_type'       => $this->request->getPost('doc_type'),
                'original_name'  => $file->getClientName(),
                'file_name'      => $newName,
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s')
            ]);

            return redirect()->to('/upload')->with('success', '📁 Document uploaded successfully!');
        } else {
            return redirect()->back()->with('error', '❌ Failed to upload document.');
        }
    }
}
