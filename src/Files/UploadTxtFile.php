<?php

namespace Src\Files;

class UploadTxtFile extends UploadFile
{
    public function checkFileForUpload(): bool
    {
        $fileStatus = parent::checkFileForUpload();
        if ($fileStatus === true) {
            $fileStatus = $this->isCorrectType($this->uploadFile["name"]);
        }
        return $fileStatus;
    }

    private function isCorrectType(): bool
    {
        $extension = pathinfo($this->uploadFile["name"], PATHINFO_EXTENSION);
        if ($extension == 'txt') {
            return true;
        } else {
            return false;
        }
    }
}