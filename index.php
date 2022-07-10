<?php
class createDataBase {
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    public function_construct(
        $dbname = 'NewDB',
        $tablename='NewTable',
        $servername='localhost',
        $username='root',
        $password='password'
    )

    $this->dbname = $dbname;
    $this->tablename = $tablename;
    $this->servername = $servername;
    $this->username = $username;
    $this->password = $password;
    $this->con = mysqli_connect($servername,$username,$password);

    if(!this->con){
        die('Connection Falied:::'.mysql_error());
    }
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if(mysqli_query($this->con,$sql)){
        $this->con = mysqli_connect($servername,$username,$password,$dbname);

        $sql = 'CREATE TABLE IF NOT EXISTS $tablename
        (ATTRIBUTES);';

        if(!mysqli_query($this->con,$sql)){
            echo "Error creating :: ".mysqli_error($this->con);
        }
    }
    else{
        return false;
    }
}


public function getData() {
    $sql = "Select * from this->tablename";
    $result = mysqli_query($this->con,$sql);
    if(mysqli_num_rows($result)>0){
        return $result;
    }
}