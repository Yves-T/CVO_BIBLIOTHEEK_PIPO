<?php

class Uploader
{
    private $fileName;
    private $fileData;
    private $destination;
    private $errorMessage;
    private $errorCode;

    /**
     * Uploader constructor.
     */
    public function __construct($key)
    {
        $this->fileName = $_FILES[$key]['name'];
        $this->fileData = $_FILES[$key]['tmp_name'];
        $this->errorCode = ($_FILES[$key]['error']);
    }

    public function saveIn($folder)
    {
        $this->destination = $folder;
    }

    public function save()
    {
        if ($this->readyToUpload()) {
            move_uploaded_file(
                $this->fileData,
                "$this->destination/$this->fileName");
        } else {
            $exc = new Exception($this->errorMessage);
            throw $exc;
        }
    }

    private function readyToUpload()
    {
        $folderIsWriteAble = is_writable($this->destination);
        if ($folderIsWriteAble === false) {
            //provide a meaningful error message
            $this->errorMessage = "Error: destination folder is ";
            $this->errorMessage .= "not writable, change permissions";
            //indicate that code is NOT ready to upload file
            $canUpload = false;
        } elseif ($this->errorCode === 1) {
            $maxSize = ini_get('upload_max_filesize');
            $this->errorMessage = "Error: File is too big. ";
            $this->errorMessage .= "Max file size is $maxSize";
            $canUpload = false;
        } else if ($this->errorCode > 1) {
            $this->errorMessage = "Something went wrong! ";
            $this->errorMessage .= "Error code: $this->errorCode";
            $canUpload = false;
        } else {
            //assume no other errors - indicate we're ready to upload
            $canUpload = true;
        }
        return $canUpload;
    }
}
