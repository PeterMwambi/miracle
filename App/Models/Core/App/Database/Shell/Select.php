<?php

namespace Models\Core\App\Database\Shell;

use Exception;

define("ALLOW_DBQUERY_ACCESS", true);
class Select extends Query
{


    private $_fields;

    private $_table;

    private $_fetch;

    private $_where = array();

    public function Fields(array $fields)
    {
        $this->_fields = $fields;
    }

    public function Table(string $table)
    {
        $this->_table = $table;
    }

    public function Fetch(int $fetch)
    {
        $this->_fetch = $fetch;
    }

    public function Where(array $where)
    {
        $this->_where = $where;
    }
    public function Execute()
    {
        if (count($this->_fields)) {
            $fieldValue = '';
            $x = 1;
            foreach ($this->_fields as $field) {
                $fieldValue .= $field;
                if ($x < count($this->_fields)) {
                    $fieldValue .= ', ';
                }
                $x++;
            }
            if (count($this->_where)) {
                return parent::BindSQL("SELECT {$fieldValue}", $this->_table, $this->_fetch, $this->_where);
            } else {
                return parent::BindSQL("SELECT {$fieldValue}", $this->_table, $this->_fetch);
            }
        }
        throw new Exception("Warning: Fields were not found");
    }

}