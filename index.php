<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello Ajax by Berdibek</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div></div>
        <div class="col-md-12">
          <h1 class="text-center">
            Hello Ajax!
          </h1>
          <hr style="height: 1px; color: black; background-color: black; ">
        </div>
      </div>
      <div class="row">
        <div class="col-md-5 mx-auto">
          <form action="" method="post" id="form">
            <div id="result"></div>
          <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email address</label>
  <input type="email" class="form-control" id="email" placeholder="name@example.com">
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
  <textarea class="form-control" id="textarea" rows="3"></textarea>

</div>
<div class="form-group">
  <button type="submit" id="submit" class="btn btn-outline-primary">Submit</button>
</div>
</form>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mt-1">
          <!--<div id="count"></div>-->
          <div id="show"></div>
          <div id="fetch"></div>

        </div>
      </div>

    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
    $(document).on("click","#submit", function(e){
      e.preventDefault();
      var email = $("#email").val();
      var textarea = $("#textarea").val();
      var submit = $("#submit").val();

      //alert(email);
      $.ajax({
        url: "insert.php",
        type: "post",
        data: {
          email: email,
          textarea: textarea,
          submit:submit
        },
        success: function(data){
          fetch();
          $("#result").html(data);
        }
      });
      $("#form")[0].reset();
    });

    function fetch(){
       $.ajax({
      url: "fetch.php",
      type: "post",
      success: function(data){
        $("#fetch").html(data);
      }
    });
  }
  fetch();


  $(document).on("click","#del_id" , function(e){
    e.preventDefault();

    var del_id = $(this).attr("value");

    $.ajax({
      url: "delete.php",
      type: "post",
      data:{
        del_id:del_id
      },
      success: function(data){
        fetch();
        $("#show").html(data);
      }
    });
  });

  $(document).ready(function(){
    $('textarea').keyup(function(){
      var values = $('#textarea').val();

      $.ajax({
        url: "counter.php",
        type: "post",
        data:{
          data:values
        },
        success: function(data){
          fetch();
          $("#count").html(data);
        }
      });
    })
  });
    </script>
  </body>
</html>
