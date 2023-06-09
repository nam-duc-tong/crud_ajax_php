<?php

class Model{
    private $server = "localhost:3308";
    private $username = "root";
    private $password = "";
    private $db = "crud_ajax";

    private $conn;
    public function __construct(){
        try{
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db",$this->username,$this->password);
        }
        catch(PDOException $e)
        {
            echo "connect failed".$e->getMessage();
        }
    }
    public function insert(){
        if(isset($_POST['submit']))
        {
            if(isset($_POST['title'])&& isset($_POST['description']))
            {
                if(!empty($_POST['title']) && !empty($_POST['description']))
                {
                    $title = $_POST['title'];
                    $description = $_POST['description'];

                    $query = "INSERT INTO record (title,description) VALUES ('$title','$description')";

                    if($sql = $this->conn->exec($query))
                    {
                        echo "
                          <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Record added success
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        ";
                    }
                    else{
                        echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            empty fields
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        ";
                    }
                }
                else{
                    echo "
                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            empty fields
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                    ";
                }
            }
        }
    }
    public function fetch()
    {
        $data = null;
        $stmt = $this->conn->prepare("SELECT * FROM record");
        $stmt->execute();
        $data = $stmt->fetchAll();
        return $data;
    }
    public function del($del_id)
    {
        $query = "DELETE FROM record WHERE id = '$del_id'";
        if($sql = $this->conn->exec($query))
        {
            echo "
                   <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Record delete Successfully
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                   </div>
           ";
        }
        else{
            echo "
                 <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Record not delete Successfully
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                   </div>
            ";
        }
    }
    public function read($read_id)
    {
        $data= null;

        $stmt = $this->conn->prepare("SELECT * FROM record WHERE id = '$read_id'");

        $stmt-> execute();

        $data= $stmt->fetch();

        return $data;
    }
    public function edit($edit_id)
    {
        $data = null;
        $stmt = $this->conn->prepare("SELECT * FROM record WHERE id = '$edit_id'");
        $stmt->execute();
        $data = $stmt->fetch();
        return $data;
    }
    public function update($data){
        $query = "UPDATE record SET title = '$data[edit_title]',description='$data[edit_description]' WHERE id='$data[edit_id]'";
        if($sql = $this->conn->exec($query))
        {
            echo "
                   <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Record Update Successfully
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                   </div>
           ";
        }
        else{
            echo "
                   <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            failed to update record
                          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                   </div>
           ";
        }
    }
}