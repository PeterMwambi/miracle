<?php

namespace Models\Core\App\Database\Shell;

use Exception;


define("ALLOW_DBQUERY_ACCESS", true);
class Show extends Query
{

    private $_sql = null;

    private $_fetch;

    public function Databases()
    {
        $this->_sql = "SHOW DATABASES";
    }

    public function Fetch(int $fetch)
    {
        $this->_fetch = $fetch;
    }

    public function Columns(string $table)
    {
        $this->_sql = "SHOW COLUMNS FROM {$table}"; //Use Prepared statements for more safer queries
    }

    public function Tables(string $database)
    {
        $this->_sql = "SHOW TABLES FROM {$database}";
    }


    public function Execute()
    {
        if (isset($this->_sql) && isset($this->_fetch)) {
            parent::RunSQL($this->_sql, $this->_fetch);
        } else {
            throw new Exception("Warning: No SQL statement was found");
        }
    }
}

// -Columns
// -Databases
// -Tables