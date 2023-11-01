<?php

namespace Vendor\Services\Database;

use PDO;
use PDOException;
use Vendor\Services\Environment\Environment as Env;

/**
 * @author Peter Mwambi
 * @data Tue Jul 25 2023 12:22:29 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Database
 * @abstract Database Service Provider - Contains all database access queries
 */
abstract class DatabaseServiceProvider extends DatabaseServiceConfiguration
{

    /**
     * #### __constructor
     * - The constructor initializes database connection options and creates a live connection to the database
     * - The database name is defined as well as the host connection password and the connection options
     * - A new connection is created to access database objects
     * @param string $dbname - The database to query
     */
    protected function __construct(string $dbname = "")
    {
        $this->setName($dbname);
        $this->setPassword();
        $this->setOptions([PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $this->boot();
    }


    /**
     * #### Database connection setup
     * - This method initializes a live database connection by instantiating the PDO driver
     * - The method then registers the connection to the database connection registrar 
     * - Incase of any errors generated, the method generates a  `PDOException` which is displayed before halting the execution of the script.
     * @return void
     * @throws PDOException - Database Connection Errors
     */
    private function boot()
    {
        try {
            $this->setConn(
                new PDO(
                    "mysql:host=" . Env::get("MYSQL_HOST") .
                    ";dbname=" . $this->getName(),
                    Env::get("MYSQL_USERNAME"),
                    $this->getPassword(),
                    $this->getOptions()
                )
            );
        } catch (PDOException $e) {
            $this->getMessage($e->getMessage());
            exit;
        }
    }

    /**
     * #### Execute PDO Statement
     * - This method executes a prepared pdo statement 
     * @return self
     */
    private function executeQuery()
    {
        $this->getStmt()->execute();
        return $this;
    }

    /**
     * #### Prepare PDO Statement
     * - This method prepares a PDO statement
     * @return self 
     */
    private function prepareStatement()
    {
        $this->setStmt($this->getConn()->prepare($this->getSQL()));
        return $this;
    }

    /**
     * #### Bind PDO Parameters
     * - This method either binds a parameter passed to a PDO statement to its value, or prepares a PDO statement
     * - Parameters to be bounded are registered in the database parameters registrar
     * @depends Vendor\Services\Database\DatabaseServiceProvider::prepareStatement()
     * @return self 
     */
    private function bindParams(array $params)
    {
        if (count($params)) {
            $this->setParams($params);
            $this->bindStatementWithParams();
        } else {
            $this->prepareStatement();
        }
        return $this;
    }

    /**
     * #### Bind Statement with Parameters
     * - This method binds a PDO statement to its supplied parameters. 
     * - Parameters to be bound are set and fetch from the database parameters registrar.
     * - The number of bound parameters must always be equal to the number of passed variables for the binding to happen.
     * @depends Vendor\Services\Database\DatabaseServiceProvider::prepareStatement()
     * @depends Vendor\Services\Database\DatabaseServiceConfiguration::getParams()
     * @return self
     */
    private function bindStatementWithParams()
    {
        if (count($this->getParams())) {
            $this->prepareStatement();
            $x = 1;
            $i = 0;
            foreach ($this->getParams() as $param) {
                $this->getStmt()->bindParam($x, $this->getParams()[$i]);
                $x++;
                $i++;
            }
        }
        return $this;
    }

    /**
     * #### Fetch Results
     * - This method fetches database results based on the registered flag passed to the database fetch registrar
     * - When the fetch flag is set to 0, the method returns a single row from a result set
     * - When the fetch flag is set to 1, the method returns all rows from a result set
     * @depends Vendor\Services\Database\DatabaseServiceProvider::fetchSingle()
     * @depends Vendor\Services\Database\DatabaseServiceProvider::fetchVerbose()
     * @return void
     */
    protected function fetchResults(string $options = "array")
    {
        switch ($this->getFetch()) {
            case 0:
                return $this->fetchSingle($options);
            case 1:
                return $this->fetchVerbose($options);
        }
    }

    /**
     * #### Fetch Results from Single Row
     * - This method fetches database results from a single row in a result set 
     * - The method returns the results as an object or array 
     * @depends Vendor\Services\Database\DatabaseServiceConfiguration::setOutput()
     * @return void
     */
    private function fetchSingle(string $options)
    {
        switch ($options) {
            case "array":
                $this->setOutput($this->getStmt()->fetch(PDO::FETCH_ASSOC));
                return;
            case "object":
                $this->setOutput($this->getStmt()->fetch(PDO::FETCH_OBJ));
                return;
        }
    }

    /**
     * #### Fetch Results from Multiple Rows
     * - This method fetches database results from all rows in a result set
     * - The method returns the results as an object or array 
     * @depends Vendor\Services\Database\DatabaseServiceConfiguration::setOutput()
     * @return void
     */
    private function fetchVerbose(string $options)
    {
        switch ($options) {
            case "array":
                $this->setOutput($this->getStmt()->fetchAll(PDO::FETCH_ASSOC));
                return;
            case "object":
                $this->setOutput($this->getStmt()->fetchAll(PDO::FETCH_OBJ));
                return;
        }
    }



    /**
     * #### SQL query engine
     * - This method executes an sql query
     * @param string $sql - The SQL statement to be executed
     * @param array $params - The SQL parameters to be bound in the SQL statement
     * @param int $fetch - The fetch flag the controls the result fetch mode
     * @return self 
     */
    public function run(string $sql, array $params = array(), int $fetch = 3)
    {
        $this->setSQL($sql);
        $this->bindParams($params);
        $this->setFetch($fetch);
        $this->executeQuery();
        return $this;
    }

    /**
     * #### Bind SQL Statement
     * - This method binds an SQL statement to the SQL query engine.
     * - The method can bind two types of SQL statements. Statements with a where clause or statements without a where clause.
     * - Statements with a where clauss contain a key index specified by a query to obtain specific results.
     * - Statements without a where clause contain no key index to specify the results to be obtained by a query.
     * @depends Vendor\Services\Database\DatabaseServiceProvider::bindSQLWithWhereClause()
     * @depends Vendor\Service\Database\DatabaseServiceProvider::bindSQLWithoutWhereClause()
     * @return self
     */
    private function bindSQL()
    {
        $this->setOperators(array("=", "<", ">", "<=", ">=", "LIKE"));
        $this->setCount(count($this->getWhere()));
        if (parent::getCount() === 3) {
            $this->bindSQLWithWhereClause();
        } else {
            $this->bindSQLWithoutWhereClause();
        }
        return $this;
    }


    /**
     * #### Bind SQL Statement with Where Clause
     * - This method binds an SQL statement with a where clause.
     * - The method gets the registered where clause as an array from the `database where clause registrar`.
     * - The method also gets registered operators from the database query operators registrar.
     * - The method then forms an SQL statement with a where clause and executes the statement.
     * @depends Vendor\Services\Database\DatabaseServiceProvider::run()
     * @return self|false
     */
    private function bindSQLWithWhereClause()
    {
        $field = $this->getWhere()[0];
        $operator = $this->getWhere()[1];
        $values = [];
        $value = $this->getWhere()[2];
        if (in_array($operator, $this->getOperators())) {
            array_push($values, $value);
            $this->setSQL($this->getAction() . " FROM " . $this->getTable() . " WHERE {$field} {$operator} ?");
            if (count($values)) {
                $this->run($this->getSQL(), $values, $this->getFetch());
            } else {
                $this->run($this->getSQL(), [], $this->getFetch());
            }
            return $this;
        }
        return false;
    }

    /**
     * #### Bind SQL Statement without Where Clause
     * - This method binds an SQL statement without a where clause.
     * - The method forms an SQL statement and executes the statement.
     * @depends Vendor\Services\Database\DatabaseServiceProvider::run()
     * @return self
     */
    private function bindSQLWithoutWhereClause()
    {
        $this->setSQL($this->getAction() . " FROM " . $this->getTable());
        $this->run($this->getSQL(), [], $this->getFetch());
        return $this;
    }


    /**
     * #### Run Select Query
     * - This method executes a select query. 
     * - The method registers a select action with its respective columns to the database query command registrar
     * - The method then then binds any sql parameters that have been passed to the sql parameters registrar before executing the select statement.
     * - The method will still execute even when there are no parameters to bind.
     * @depends Vendor\Services\Database\DatabaseServiceProvider::bindSQL()
     * @return void|self
     */
    protected function runSelectQuery()
    {
        if (count($this->getColumns())) {
            $columns = '';
            $x = 1;
            foreach ($this->getColumns() as $column) {
                $columns .= $column;
                if ($x < count($this->getColumns())) {
                    $columns .= ', ';
                }
                $x++;
            }
            $this->setAction("SELECT {$columns}");
            return $this->bindSQL();
        }
    }

    /**
     * #### Run Delete Query
     * - This method generates and executes a delete query
     * @depends Vendor\Services\Database\DatabaseServiceConfiguration::setDatabaseAction()
     * @depends Vendor\Service\Database\DatabaseServiceProvider::bindSQL()
     * @return self
     */
    protected function runDeleteQuery()
    {
        $this->setAction("DELETE");
        return $this->bindSQL();
    }

    /**
     * #### Run Create DatabaseQuery
     * - This method creates a database if the database name supplied to it does not exist
     * @depends Vendor\Services\Database\DatabaseServiceProvider::run()
     * @return DatabaseServiceProvider
     */
    protected function runCreateDatabaseQuery()
    {
        return $this->run("CREATE DATABASE IF NOT EXISTS " . $this->getName(), [], 2);
    }

    /**
     * #### Run Create Table Query
     * - This method creates a table if the table does in the specified database
     * @depends Vendor\Services\Database\DatabaseServiceProvider::run()
     * @return self
     */
    protected function runCreateTableQuery()
    {
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->getTable() . " ( ";
        $x = 1;
        foreach ($this->getColumns() as $column) {
            $sql .= $column;
            if ($x < count($this->getColumns())) {
                $sql .= ', ';
            }
            $x++;
        }
        $sql .= " );";
        $this->setSQL($sql);
        return $this->run($this->getSQL(), [], 2);
    }


    /**
     * #### Run Insert Query
     * - This method inserts a row into a database table
     * @depends Vendor\Services\Database\DatabaseServiceProvider::run()
     * @return bool `true` if record was inserted otherwise `false`
     */
    protected function runInsertQuery()
    {
        if (count($this->getData())) {
            $keys = array_keys($this->getData());
            $values = '';
            $x = 1;
            foreach ($this->getData() as $data) {
                $values .= '?';
                if ($x < count($this->getData())) {
                    $values .= ',';
                }
                $x++;
            }
            $sql = "INSERT into {$this->getTable()} (`" . implode('`, `', $keys) . "`) VALUES({$values})";
            $this->run($sql, array_values($this->getData()), 2);
            return true;
        }
        return false;
    }


    /**
     * #### Run Update Query
     * - This method updates a record in a database
     * @depends Vendor\Services\Database\DatabaseServiceProvider::run()
     * @return bool `true` if record was updated otherwise `false
     */
    protected function runUpdateQuery()
    {
        if (count($this->getData())) {
            $set = "";
            $x = 1;
            foreach ($this->getData() as $data => $value) {
                $set .= "{$data} = ?";
                if ($x < count($this->getData())) {
                    $set .= ", ";
                }
                $x++;
            }
            if (count($this->getWhere())) {
                $where = "";
                foreach ($this->getWhere() as $whereField => $whereValue) {
                    $where .= "{$whereField} = ?";
                }
                $this->setSQL("UPDATE " . $this->getTable() . " SET {$set} WHERE {$where}");
                $data = $this->getData();
                array_push($data, $whereValue);
                if ($this->run($this->getSQL(), array_values($data), 2)) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }
}