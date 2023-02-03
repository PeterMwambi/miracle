<?php

namespace Models\Core\App\Database\Shell;

define("ALLOW_DBQUERY_ACCESS", true);


class Delete extends Query
{

    private $_table;

    private $_where;

    public function Table(string $table)
    {
        $this->_table = $table;
    }

    public function Where(array $where)
    {
        $this->_where = $where;
    }

    public function Execute()
    {
        if (count($this->_where) === 3) {
            return $this->BindSQL("DELETE", $this->_table, 2, $this->_where);
        }
        return $this->BindSQL("DELETE", $this->_table, 2);
    }
}