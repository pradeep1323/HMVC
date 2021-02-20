<?php
class DatabaseConnect{
    public $con;
    public $connectedDb='ampere_en_site';
    //public $dbPassword='@AmpEnS1t3#';
    //public $dbUser='ampenuser';
    public $dbPassword='(aPvSjbt`+9n8H)[+|h4!ynj{|Xh=U-n';
    public $dbUser='dbmasteruser';
    public $dbHost='ls-df8b5148abd1fce54fa418ff5ffd74ed68c0f175.cc0sickfaqrw.us-west-2.rds.amazonaws.com';
#####    public $dbHost='ls-5092cab5d0b78b93746eb6a0fdff56c4952d3757.cc0sickfaqrw.us-west-2.rds.amazonaws.com';

    /**
     * DatabaseConnect constructor.
     */
    public function __construct()
    {
        $this->con = mysqli_connect($this->dbHost,$this->dbUser,$this->dbPassword,$this->connectedDb);
        if(!$this->con)
        {
            echo 'Database Connection Error ' . mysqli_connect_error($this->con);
        }
    }

    /**
     * @param $table_name
     * @param $data
     * @return bool
     */
    public function insert($table_name, $data)
    {
        $string = "INSERT INTO ".$table_name." (";
        $string .= implode(",", array_keys($data)) . ') VALUES (';
        $string .= "'" . implode("','", array_values($data)) . "')";
        if(mysqli_query($this->con, $string))
        {
            return true;
        }
        else
        {
            echo mysqli_error($this->con);
        }
    }

    /**
     * @param $table_name
     * @return array
     */
    public function select($table_name)
    {
        $array = array();
        $query = "SELECT * FROM ".$table_name."";
        $result = mysqli_query($this->con, $query);
        while($row = mysqli_fetch_assoc($result))
        {
            $array[] = $row;
        }
        return $array;
    }

    public function getResult($sql){
        $array = array();
        $result = mysqli_query($this->con, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $array[] =(object) $row;
        }
        return $array;
    }

    /**
     * @param $table_name
     * @param $where_condition
     * @return array
     */
    public function select_where($table_name, $where_condition)
    {
        $condition = '';
        $array = array();
        foreach($where_condition as $key => $value)
        {
            $condition .= $key . " = '".$value."' AND ";
        }
        $condition = substr($condition, 0, -5);
        $query = "SELECT * FROM ".$table_name." WHERE " . $condition;
        $result = mysqli_query($this->con, $query);
        while($row = mysqli_fetch_array($result))
        {
            $array[] = $row;
        }
        return $array;
    }

    public function delete_where($table_name, $where_condition)
    {
        $condition = '';
        $array = array();
        foreach($where_condition as $key => $value)
        {
            $condition .= $key . " = '".$value."' AND ";
        }
        $condition = substr($condition, 0, -5);
        $query = "DELETE FROM ".$table_name." WHERE " . $condition;
        if(mysqli_query($this->con, $query))
        {
            return true;
        }
    }

    /**
     * @param $table_name
     * @param $fields
     * @param $where_condition
     * @return bool
     */
    public function update($table_name, $fields, $where_condition)
    {
        $query = '';
        $condition = '';
        foreach($fields as $key => $value)
        {
            $query .= $key . "='".$value."', ";
        }
        $query = substr($query, 0, -2);
        /*This code will convert array to string like this-
        input - array(
             'key1'     =>     'value1',
             'key2'     =>     'value2'
        )
        output = key1 = 'value1', key2 = 'value2'*/
        foreach($where_condition as $key => $value)
        {
            $condition .= $key . "='".$value."' AND ";
        }
        $condition = substr($condition, 0, -5);
        /*This code will convert array to string like this-
        input - array(
             'id'     =>     '5'
        )
        output = id = '5'*/
        $query = "UPDATE ".$table_name." SET ".$query." WHERE ".$condition."";
        if(mysqli_query($this->con, $query))
        {
            return true;
        }
    }

    public function delete($sql){
        if(mysqli_query($this->con, $sql))
        {
            return true;
        }
    }
}
?>
