<?php


namespace Vendor\Services\Database;

/**
 * @author Peter Mwambi
 * @date Tue Jul 25 2023 11:35:54 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @package Vendor\Services\Database
 * @abstract Database class. Binds all database methods and allows us to query data from
 * any database. Supports mysql, mongo, sqlserver, postgresql 
 * 
 * @todo Create support for join clauses  
 */
final class Database extends DatabaseServiceProvider
{
    /**
     * #### Database Query Provider
     * - This method creates a database instance and allows us to access database class methods
     * @param string dbname - The database to query
     * @return Database
     */
    public static function query(string $dbname = "")
    {
        return new Database($dbname);
    }


    /**
     * #### Create New Database
     * - This method creates a new Database
     * @param string $databaseName - The name of database to create
     * @depends Vendor\Services\Database\DatabaseServiceProvider::runCreateDatabaseQuery()
     * @return Database
     */
    public function add(string $databaseName)
    {
        $this->setName($databaseName);
        return $this->runCreateDatabaseQuery();
    }


    /**
     * #### Create Database Table
     * - This method creates a database table
     * @param $table - The name of the table to create
     * @param $columns - The columns to be contained in the table
     * @depends Vendor\Services\Database\DatabaseServiceProvider::runCreateTableQuery();
     */
    public function create(string $table, array $columns)
    {
        $this->setTable($table);
        $this->setColumns($columns);
        return $this->runCreateTableQuery();
    }



    /**
     * #### Select Query
     * - This method generates and executes a select statement
     * @param string $table - The table to be queried
     * @param array $columns - The columns to be queried in the select statement
     * @param array $where - (optional) The where clause
     * @param int $fetch - The fetch mode flag. Default is set to 0 which allows us to fetch a single row
     * @depends Vendor\Services\Database\DatabaseServiceProvider::runSelectQuery()
     * @return Database
     */
    public function select(string $table, array $columns, array $where = [], int $fetch = 0)
    {
        $this->setTable($table);
        $this->setColumns($columns);
        $this->setFetch($fetch);
        $this->setWhere($where);
        return $this->runSelectQuery();
    }

    /**
     * #### Insert Query
     * - This method generates and executes an insert statement
     * @param string $table -The table to insert a record
     * @param array $data - The record to be inserted to the table
     * @depends Vendor\Services\Database\DatabaseServiceProvider::runInsertQuery()
     */
    public function insert(string $table, array $data)
    {
        $this->setTable($table);
        $this->setData($data);
        return $this->runInsertQuery();
    }

    /**
     * #### Update Query
     * - This method generates and executes an update statement
     * @param string $table - The table to update
     * @param array $data - The data to be updated for existing record in the table
     * @param array $where - The unique udentifier for the record to update
     * @depends Vendor\Service\Database\DatabaseServiceProvider::runUpdateQuery();
     * @return bool `true` on successful update otherwise `false`
     */
    public function update(string $table, array $data, array $where)
    {
        $this->setTable($table);
        $this->setData($data);
        $this->setWhere($where);
        return $this->runUpdateQuery();
    }

    /**
     * #### Delete Query
     * - This method generates and executes a delete statement
     * @param string $table - The table to delete data
     * @param array $where - A unique identifier for the record to be deleted
     * @return Database
     */
    public function delete(string $table, array $where = [])
    {
        $this->setTable($table);
        $this->setWhere($where);
        return $this->runDeleteQuery();
    }


    /**
     * #### Get Results
     * - This method returns database results from an executed statement
     * @param string $options - The datatype of the results to fetch `array` or `object`
     * @depends Vendor\Services\Database\DatabaseServiceProvider::bindSQL()
     * @return array|object 
     */
    public function getResults(string $options = "array")
    {
        $this->fetchResults($options);
        return $this->getOutput();
    }

    /**
     * #### Get Count
     * - This method returns a row count of the reselts fetched from an executed statement
     * @return int - The row count of fetched results
     */

    public function getCount()
    {
        $this->setCount($this->getStmt()->rowCount());
        return parent::getCount();
    }
}