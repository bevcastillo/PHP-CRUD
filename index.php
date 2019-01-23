<!DOCTYPE html>
<html>
<head>
  <title>Skills Test Practice</title>
</head>
<body>
  <?php require_once 'process.php'; ?>
  <h3><center>My Skills Test Practice</center></h3>
  <?php
    if(isset($_SESSION['message'])){
      echo $_SESSION['message'];
      unset ($_SESSION['message']);
    }
  ?>
  <?php
      $mysqli = new mysqli('127.0.0.1','root','','crud') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM tblsample") or die(mysqli_error($mysqli));
  ?>

  <form action="process.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id; ?>">

      <label>Lastname</label></br>
      <input type="text" name="lastname" value="<?php echo $lastname; ?>"></br>
      <label>Firstname</label></br>
      <input type="text" name="firstname" value="<?php echo $firstname; ?>"></br>
      </br>
      <?php if ($update == true): ?>
          <input type="submit" name="update" value="UPDATE">
      <?php else: ?>
          <input type="submit" name="save" value="ADD">
      <?php endif; ?>
      </br></br></br>
  </form>


  <form action="index.php" method="POST">  
    <input type="text" name="search" placeholder="Search items..">
    <input type="submit" value="SEARCH">
  </form>

  <div class="container">
  <table class="table">
    <thead>
      <tr>
          <th>LASTNAME</th>
          <th>FIRSTNAME</th>
          <th colspan="2">ACTION</th>
      </tr>
    </thead>
          <?php
            if(isset($_POST['search'])){
              $searchq = $_POST['search'];
              $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
              
              $result = $mysqli->query("SELECT * FROM tblsample WHERE lastname LIKE '%$searchq%' or firstname LIKE '%$searchq%' ") or die("unable to search");
              $count = mysqli_num_rows($result);

              if($count == 0) { ?>
                <tr>
                    <td><?php echo "No data found."; ?></td>
                </tr>
          <?php
              }
              else{
                  while($row = mysqli_fetch_array($result)): ?>
                  <tr>
                      <td><?php echo $row['lastname']; ?></td>
                      <td><?php echo $row['firstname']; ?></td>
                  </tr>
                  <?php endwhile; ?>
          <?php
              }
            }

            while($row = $result->fetch_assoc()){ ?>
              <tr>
                <td><?php echo $row['lastname']; ?></td>
                <td><?php echo $row['firstname']; ?></td>
                <td>
                  <a href="index.php?edit=<?php echo $row['id']?>">Edit</a>
                  <a href="index.php?delete=<?php echo $row['id']?>">Delete</a>
                </td>
              </tr>
          <?php
            }
          ?>
  </table>
  </div>


</body>
</html>