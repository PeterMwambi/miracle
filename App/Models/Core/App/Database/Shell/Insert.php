<?php

namespace Models\Core\App\Database\Shell;


class Insert extends Query
{

    private $_table;

    private $_fields;

    public function Table(string $table)
    {
        $this->_table = $table;
    }

    public function Fields(array $fields)
    {
        $this->_fields = $fields;
    }

    public function Execute()
    {
        if (count($this->_fields)) {
            $keys = array_keys($this->_fields);
            $values = '';
            $x = 1;
            foreach ($this->_fields as $field) {
                $values .= '?';
                if ($x < count($this->_fields)) {
                    $values .= ',';
                }
                $x++;
            }
            $sql = "INSERT into {$this->_table} (`" . implode('`, `', $keys) . "`) VALUES({$values})";
            $this->RunSQL($sql, 2, array_values($this->_fields));
        }
        return false;
    }
}