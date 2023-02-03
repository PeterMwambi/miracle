<?php

/**
 * @author Peter Mwambi
 * @content File Upload class
 * @date Mon May 24 2021 01:10:58 GMT+0300 (East Africa Time)
 * @updated Sat Jan 15 2022 22:02:51 GMT+0300 (East Africa Time)
 * 
 * Validate and upload files 
 */

class File
{


    private static $instance;
    /**
     * @var string filename
     * 
     * The name of the file being uploaded
     */
    private $filename = null;

    /**
     * @var string $tmp_filename
     * 
     * A temporary file name for the file
     */

    private $tmp_filename = null;

    /**
     * @var string $file_size
     * 
     * The size of the file being uploaded in bytes
     */

    private $filesize = null;

    /**
     * @var string $file_type
     * 
     * The mime type of the file being uploaded e.g jpg, png
     */

    private $filetype = null;

    /**
     * @var string $fileUploadPath
     * 
     * Path of the file to the upload folder
     */

    private $fileUploadPath = null;

    /**
     * @var string $uploadDirectory
     * 
     * Directory where file will be uploaded
     */

    private $uploadDirectory = null;



    private $errors = array();


    private $databaseHandler = null;


    public function __construct()
    {
        $this->databaseHandler = new DatabaseHandler;
    }


    /**
     * @var array $rules
     * 
     * The file validation rules
     */

    private $rules = array(
        "image" => array(
            "required" => true,
            "exists" => true,
            "allowedTypes" => array("png", "jpg", "jpeg"),
            "max" => 500000,
        )
    );

    public function write(string $filename, string $uploadDirectory)
    {
        if ($this->processWrite($filename, $uploadDirectory)) {
            return true;
        }
        return false;
    }

    private function processWrite(string $filename, string $uploadDirectory)
    {
        if (!empty($filename) && !empty($uploadDirectory)) {
            $this->filename = Sanitize::String($_FILES[$filename]["name"]);
            $this->tmp_filename = Sanitize::String($_FILES[$filename]["tmp_name"]);
            $this->filesize = Sanitize::String($_FILES[$filename]["size"]);
            $this->uploadDirectory = $uploadDirectory;
            $this->fileUploadPath = $uploadDirectory . basename($this->filename);
            $this->filetype = strtolower(pathinfo($this->fileUploadPath, PATHINFO_EXTENSION));
            $this->validate();
            return true;
        }
        return false;
    }


    private function validate(string $filetype = "image")
    {
        if (isset($this->filename) && isset($this->fileUploadPath)) {
            foreach (array_keys($this->rules[$filetype]) as $key) {
                switch ($key) {
                    case "required":
                        if (empty($this->filename)) {
                            $this->error("You havent selected any image");
                        }
                        break;
                    case "exists":
                        switch ($this->rules[$filetype]["exists"]) {
                            case true:
                                if (file_exists($this->fileUploadPath)) {
                                    $this->error("File already exists");
                                }
                                break;
                        }
                        break;
                    case "allowedTypes":
                        if (!in_array($this->filetype, $this->rules[$filetype]["allowedTypes"])) {
                            $this->error("Invalid file type");
                        }
                        break;
                    case "max":
                        if ($this->filesize > $this->rules[$filetype]["max"]) {
                            $this->error("File size is too large");
                        }
                        break;
                }
            }
            return $this;
        }
    }
    private function error($error)
    {
        array_push($this->errors, $error);
    }

    /**
     * @param null
     * @return string
     * 
     * Process Validation Errors
     */

    public function getMsg()
    {
        if (count($this->errors)) {
            foreach ($this->errors as $error) {
                return $error;
            }
        }
    }

    /**
     * @param null
     * @return bool
     * 
     * Confirms if validation has succeded. Returns true 
     * if validation has passed otherwise false
     */

    public function confirmRequestStatus()
    {
        if (empty($this->errors)) {
            return true;
        }
        return false;
    }

    public function upload()
    {
        if ($this->processUpload()) {
            return true;
        }
        return false;
    }

    private function processUpload()
    {
        if ($this->confirmRequestStatus()) {
            if (move_uploaded_file($this->tmp_filename, $this->fileUploadPath)) {
                return true;
            }
            return false;
        }
    }

    public function addToDB($table, $field, $update_identifier = array())
    {
        if ($this->processAddtoDB($table, $field, $update_identifier)) {
            return true;
        }
        return false;
    }

    private function processAddtoDB($table, $field, $update_identifier = array())
    {
        if ($this->confirmRequestStatus()) {
            $fields = array($field => $this->filename);
            $this->databaseHandler->setTable($table);
            $this->databaseHandler->setQueryItems($fields);
            $this->databaseHandler->setQueryIdentifier($update_identifier);
            $this->databaseHandler->queryDb("update");
            return true;
        }
        return false;
    }
}