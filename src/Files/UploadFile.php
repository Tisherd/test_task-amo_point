<?php

namespace Src\Files;

class UploadFile
{
    protected const FILES_STORAGE_DIR = ENV['files_storage_dir'];

    protected const MAX_ALLOW_FILE_SIZE = ENV['max_allow_file_size'];

    protected array $uploadFile;

    public function __construct(array $uploadFile)
    {
        $this->uploadFile = $uploadFile;
    }

    public function checkFileForUpload(): bool
    {
        if (empty($this->uploadFile)){
            return false;
        }

        if ($this->uploadFile['error'] !== 0){
            return false;
        }

        if ($this->uploadFile["size"] > self::MAX_ALLOW_FILE_SIZE) {
            return false;
        }
        return true;
    }

    public function upload()
    {
        $tmp_name = $this->uploadFile["tmp_name"];
        $filename = basename($this->uploadFile["name"]);
        move_uploaded_file($tmp_name, self::FILES_STORAGE_DIR . $filename);
    }
}