<?php
  Class Model{

    private $server="YOUR_SERVER:PORT";
    private $username = "USERNAME";
    private $password = "PASSWORD%";
    private $db = "YOUR_DB";
    private $conn;

    public function __construct(){
      try {
        $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username,
        $this->password);
      } catch (PDOException $e) {
        echo "connection Failed" . $e -> getMessage();
      }
    }

    // TODO: insert the data
    public function insert(){
      if (isset($_POST['submit'] )) {
        // code...
        if (isset($_POST['email']) && isset($_POST['textarea']) ) {
          // code...
          if (!empty($_POST['email']) && !empty($_POST['textarea'])) {
            // code...
            $email = $_POST['email'];
            $textarea = $_POST['textarea'];
            $lenth = strlen($textarea);

            $query ="INSERT INTO records (email,textarea,chars) VALUES ('$email','$textarea','$lenth')";

            if ($sql = $this->conn -> exec($query)) {
              // code...
              echo "
              <div class='alert alert-success alert-dismissible fade show' role='alert'>
              Reccord added succesfully
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div> ";
            }else {
              echo "
              <div class='alert alert-danger alert-dismissible fade show' role='alert'>
              Failed to add record
              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div> ";
            }
          } else {
            // code...
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Empty fields
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div> ";
          }

        }

      }
    }

    // TODO: fetch the data
    public function fetch(){
      $data = null;

      $stmt = $this-> conn -> prepare("SELECT * FROM records");

      $stmt -> execute();

      $data = $stmt -> fetchAll();

      return $data;
    }

    // TODO: delete the data
    public function del($del_id){
      $query = "DELETE FROM records WHERE id='$del_id' ";
      if ($sql = $this-> conn-> exec($query)) {
        // code...
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Record deleted succesfully
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div> ";
      }else {
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Record doesn't deleted
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div> ";

      }
    }
  }

 ?>
