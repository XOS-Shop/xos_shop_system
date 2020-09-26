<?php
/**
 *  DB is a database class for PHP that uses the PDO extension 
 *
 * @author      Hanspeter Zeller <https://xos-shop.com>
 * @version     1.0
 *
 */
 
require(DIR_WS_CLASSES . 'Log.class.php');
class Db extends PDO
{    
    # @object, Object for logging exceptions    
    private $log;
    private $dsn = 'mysql:dbname='.DB_DATABASE.';host='.DB_SERVER;
    private $user = DB_SERVER_USERNAME;
    private $password = DB_SERVER_PASSWORD;
    private $options = array(PDO::ATTR_PERSISTENT => USE_PCONNECT, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true);
    
    public function __construct()
    {
        
        $this->log = new Log();
        
        try {
            parent::__construct($this->dsn, $this->user, $this->password, $this->options);
            if (DISABLE_SQL_MODE == 'true') parent::exec("SET SESSION sql_mode=''");            
        }
        catch (PDOException $e) {
            # Write into log and display Exception
            die($this->exceptionLog($e->getMessage()));
        }
    }
    
    public function query($statement, $param1 = null, $param2 = null, $param3 = null)
    {
        try {
            return parent::query($statement . ($param1 != null ? ', ' . $param1 : '') . ($param2 != null ? ', ' . $param2 : '') . ($param3 != null ? ', ' . $param3 : ''));
        }
        catch (PDOException $e) {
            # Write into log and display Exception 
            die($this->exceptionLog($e->getMessage(), $statement));
        }
    }
    
    public function exec($statement)
    {
        try {
            return parent::exec($statement);
        }
        catch (PDOException $e) {
            # Write into log and display Exception 
            die($this->exceptionLog($e->getMessage(), $statement));
        }
    }

    public function quote($param, $paramtype = null)
    {
        try {
            $preparedparam = $this->prepareDbInput($param);
            
            if ($paramtype === null) { 
                return parent::quote($preparedparam, is_null($preparedparam) ? PDO::PARAM_NULL : (is_bool($preparedparam) ? PDO::PARAM_BOOL : (is_int($preparedparam) ? PDO::PARAM_INT : PDO::PARAM_STR)));
            } else {
                return parent::quote($preparedparam, $paramtype);
            }
        }
        catch (PDOException $e) {
            # Write into log and display Exception 
            die($this->exceptionLog($e->getMessage(), $param));
        }
    }

    public function perform($obj, $bind = null)
    {
        try {
            if (is_array($bind)) {
                foreach ($bind as $key => $value) {
                    $obj->bindValue($key, $this->prepareDbInput($value), is_null($value) ? PDO::PARAM_NULL : (is_bool($value) ? PDO::PARAM_BOOL : (is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR)));
                }
                $obj->execute();
            } else {
                $obj->execute();
            }
        }
        catch (PDOException $e) {
            # Write into log and display Exception 
            die($this->exceptionLog($e->getMessage(), $obj->queryString));
        }
    }
            
    public function performExec($table, $data, $action = 'insert', $parameters = '')
    {
        try {
            reset($data);
            if ($action == 'insert') {
                $query = 'insert into ' . $table . ' (';
                foreach(array_keys($data) as $columns) {
                    $query .= $columns . ', ';
                }
                $query = substr($query, 0, -2) . ') values (';
                reset($data);
                foreach($data as $value) {
                    switch (strtolower((string)$value)) {
                        case 'now()':
                            $query .= 'now(), ';
                            break;
                        case 'null':
                            $query .= 'null, ';
                            break;
                        default:
                            $query .= '' . $this->quote($this->prepareDbInput($value)) . ', ';
                            break;
                    }
                }
                $query = substr($query, 0, -2) . ')';
            } elseif ($action == 'update') {
                $query = 'update ' . $table . ' set ';
                foreach($data as $columns => $value) {
                    switch (strtolower($value)) {
                        case 'now()':
                            $query .= $columns . ' = now(), ';
                            break;
                        case 'null':
                            $query .= $columns .= ' = null, ';
                            break;
                        default:
                            $query .= $columns . ' = ' . $this->quote($this->prepareDbInput($value)) . ', ';
                            break;
                    }
                }
                $query = substr($query, 0, -2) . ' where ' . $parameters;
            }
            return parent::exec($query);
        }
        catch (PDOException $e) {
            # Write into log and display Exception 
            die($this->exceptionLog($e->getMessage(), $query));
        }
    }
    
    public function insertPrepareExecute($table, $data)
    {
        try {
            $dataParts = array();
            $bindData  = array();
            foreach ($data as $dk => $dv) {
                if (stripos($dv, 'now()') !== false) {
                    $dataParts[] = $dk . ' = ' . $dv;
                } else {
                    $dataParts[] = $dk . ' = ?';
                    $bindData[]  = $this->prepareDbInput($dv);
                }
            }
            $dataStr = implode(', ', $dataParts);
            $query   = 'INSERT ' . $table . ' SET ' . $dataStr;
            
            $dbh = $this->prepare($query);
            $dbh->execute($bindData);
        }
        catch (PDOException $e) {
            # Write into log and display Exception 
            die($this->exceptionLog($e->getMessage(), $query));
        }
    }
    
    public function updatePrepareExecute($table, $data, $where, $limit = false)
    {
        try {
            $dataParts = array();
            $bindData  = array();
            foreach ($data as $dk => $dv) {
                if (stripos($dv, 'now()') !== false) {
                    $dataParts[] = $dk . ' = ' . $dv;
                } else {
                    $dataParts[] = $dk . ' = ?';
                    $bindData[]  = $this->prepareDbInput($dv);
                }
            }
            
            $whereParts = array();
            $bindWhere  = array();
            foreach ($where as $wk => $wv) {
                $whereParts[] = $wk . ' = ?';
                $bindWhere[]  = $this->prepareDbInput($wv);
            }
            
            $dataStr  = implode(', ', $dataParts);
            $whereStr = implode(' AND ', $whereParts);
            
            $query = 'UPDATE ' . $table . ' SET ' . $dataStr . ' WHERE ' . $whereStr;
            if ($limit && is_int($limit)) {
                $query .= ' LIMIT ' . $limit;
            }
            
            $bind = array_merge($bindData, $bindWhere);
            
            $dbh = $this->prepare($query);
            $dbh->execute($bind);
        }
        catch (PDOException $e) {
            # Write into log and display Exception 
            die($this->exceptionLog($e->getMessage(), $query));
        }
    }
    
    public function deletePrepareExecute($table, $where, $limit = false)
    {
        try {
            
            $whereParts = array();
            $bindWhere  = array();
            foreach ($where as $wk => $wv) {
                $whereParts[] = $wk . ' = ?';
                $bindWhere[]  = $this->prepareDbInput($wv);
            }
            
            $whereStr = implode(' AND ', $whereParts);
                       
            $query = 'DELETE FROM ' . $table . ' WHERE ' . $whereStr;
            if ($limit && is_int($limit)) {
                $query .= ' LIMIT ' . $limit;
            }
                       
            $dbh = $this->prepare($query);
            $dbh->execute($bindWhere);
        }
        catch (PDOException $e) {
            # Write into log and display Exception 
            die($this->exceptionLog($e->getMessage(), $query));
        }
    }
    
    private function prepareDbInput($string)
    {
        if (is_string($string)) {
//            return trim(stripslashes($string));
            return trim(str_ireplace(array('<?', '<script'), '_', stripslashes($string))); 
        } else {
            return $string;
        }  
    } 
       
    /**	
     * Writes the log and returns the exception
     *
     * @param  string $message
     * @param  string $sql
     * @return string
     */    
    private function exceptionLog($message, $sql = "")
    {
        $exception = 'Unhandled Exception. <br>';
        $exception .= $message;
        $exception .= "<br> You can find the error back in the db_logs.";
        
        if (!empty($sql)) {
            # Add the Raw SQL to the Log
            $message .= "\r\nRaw SQL : " . $sql;
        }
        # Write into log
        $this->log->write($message);
        
        return $exception;
    }    
}