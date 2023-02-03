<?php


namespace Models\Core\App\Data;

use Exception;
use Controllers\Controller;
use Models\Auth\Input;
use Models\Auth\Sanitize;
use Models\Core\App\Helpers\Formatter;

class Data extends Controller
{

    private $_data;

    private $_generatedData = array();


    private function _GetData()
    {
        if (count($this->_data)) {
            return $this->_data;
        } else {
            throw new Exception("Warning: Form data has not been initialised");
        }
    }

    private function _WriteFormData()
    {
        $this->_data = Formatter::FormatToArray(parent::GetFormData())[$this->GetForm()];
        return;
    }


    private function _GenerateFormData(string $form)
    {
        $this->WriteForm($form);
        $datakeys = array();
        foreach ($this->_GetData() as $item) {
            if ($item === "email") {
                $data = Sanitize::Email(Input::Get($item));
            } else {
                $data = Sanitize::String(Input::Get($item));
            }
            array_push($datakeys, $item);
            array_push($this->_generatedData, $data);
            $this->_generatedData = Formatter::Run()->FormatArray($this->_generatedData, $datakeys);
        }
        return;
    }


    private function _GetGeneratedFormData(): array
    {
        if (count($this->_generatedData)) {
            return $this->_generatedData;
        } else {
            throw new Exception("Warning: No form data was generated");
        }
    }



    public function GenerateFormData(string $form)
    {
        parent::WriteFormData();
        $this->_WriteFormData();
        $this->_GenerateFormData($form);
        return $this->_GetGeneratedFormData();
    }

}