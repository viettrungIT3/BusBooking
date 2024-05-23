<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class FileController extends ResourceController
{
    public function __construct() {
        ini_set('memory_limit', '-1');
    }
    
    public function upload()
    {
        $file = $this->request->getFile('file');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads', $newName);
            return $this->respondCreated(['message' => 'File uploaded successfully', 'file' => $newName]);
        }

        return $this->failValidationErrors('File upload failed');
    }
}
