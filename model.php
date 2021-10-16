<?php
//LOGGER
ini_set('display_errors',1);
ini_set('log_errors',1);
ini_set('error_log', dirname(__FILE__) . "/log.txt");

  Class Model{

    private $server="srv-pleskdb33.ps.kz:3306";
    private $username = "itrender_root";
    private $password = "Tdau739%";
    private $db = "itrender_form";
    private $conn;

    public function __construct(){
      try {
        $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username,
        $this->password);
      } catch (PDOException $e) {
        echo "connection Failed" . $e -> getMessage();
      }
    }
	  
	public function mapped_implode($glue, $array, $symbol = '=') {
    return implode($glue, array_map(
            function($k, $v) use($symbol) {
                return $k . $symbol . $v;
            },
            array_keys($array),
            array_values($array)
            )
        );
}

    // TODO: insert the data
    public function insert(){
      if (isset($_POST['submit'] )) {
        if (isset($_POST['email']) && isset($_POST['textarea']) ) {
          if (!empty($_POST['email']) && !empty($_POST['textarea'])) {
          $email = $_POST['email'];
          $textarea = $_POST['textarea'];
          $str = $textarea;
          $counts = preg_split("/([^[:alnum:]]|['-])+/us", $str); 
          $counts = array_unique($counts);
          $arr = array();
          foreach($counts as $count)
          {
              $arr[$count] = substr_count($str, $count);
          }
          arsort($arr);
          
		  $words =$this->mapped_implode("<br>",$arr);

            $query ="INSERT INTO records (email,textarea,words) VALUES ('$email','$textarea','$words')";

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
