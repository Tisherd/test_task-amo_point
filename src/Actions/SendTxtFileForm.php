<?php

namespace Src\Actions;

use Src\Files\UploadTxtFile;

class SendTxtFileForm
{
    public static function index()
    {
        $uploadFile = $_FILES['txtFileForUpload'] ?? [];

        try {
            $uploadTxtFile = new UploadTxtFile($uploadFile);

            if ($uploadTxtFile->checkFileForUpload() === true) {
                $uploadTxtFile->upload();

                $fileText = file_get_contents(ENV['files_storage_dir'] . $uploadFile["name"]);
                $separatedFileTextArr = explode(' ', $fileText);

                $resBody = [];

                foreach($separatedFileTextArr as $index => $string){
                    $matchesCount = preg_match_all("/(\d{1})/", $string);
                    $resBody[$index] = $matchesCount;
                }

                $response = [
                    'status' => 'UPLOAD',
                    'body' => $resBody
                ];
            } else {
                $response = [
                    'status' => 'NOT_UPLOAD'
                ];
            }
        } catch (\Throwable $th) {
            $response = [
                'status' => 'NOT_UPLOAD',
                'error_msg' => $th->getMessage(), 
            ];
        }

        return json_encode($response);
    }
}