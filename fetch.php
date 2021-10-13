<?php
  include 'model.php';

  $model = new Model();
  $rows = $model-> fetch();
 ?>

 <table class="table">
   <thead>
     <tr>
     <th>ID</th>
     <th>Email</th>
     <th>Text</th>
     <th>Text's counted chars</th>
     <th>Action</th>
   </tr>
   </thead>

   <tbody>
   <?php

   $i = 1;
if (!empty($rows)) {
  // code...
  foreach ($rows as $row) { ?>

    <tr>
    <td><?php echo $i++; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['textarea']; ?></td>
    <td><?php echo $row['chars']; ?></td>
    <td>
      <!--<a href="#" id="read" class="badge bg-info" value="<?php echo $row['id']; ?>">Read</a>
      <a href="#" id="edit" class="badge bg-warning" value="<?php echo $row['id']; ?>">Edit</a> -->
      <a href="#" id="del_id" class="badge bg-danger" value="<?php echo $row['id']; ?>">Delete</a>
    </td>
    </tr>

    <?php
  }
}else {
  echo "
  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  No data!
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div> ";
}
    ?>
  </tbody>
 </table>
