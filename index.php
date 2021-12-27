<!DOCTYPE html>
<html>
<head>
    <title>Lottery Bottery</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
input[type=number], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #3838e5;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: left;
}

input[type=submit]:hover {
  background-color: #6262f3;
}
.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
h2{
    color:green;
}
h3{
    color:darkgreen;
}
h4{
    color: red;
    font-size:16px;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>

<center><h2>Lottery Bottery</h2>
<h3>Feeling Lucky!!!</h3>
<h3>Feel this lottery form for participation</h3></center>

<div class="container">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div class="row">
      <div class="col-25">
        <label for="fname">First Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="fname" name="firstname" placeholder="Your first name.." required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Last Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="phoneno">Phone Number</label>
      </div>
      <div class="col-75">
        <input type="number" id="phoneno" name="phoneno" placeholder="Your phone number.." required>
      </div>
    </div>    
    <h4>Enter your unique username, if you have already filled this form kindly enter that old username only for increasing winning chance.</h4>
    <div class="row">
      <div class="col-25">
        <label for="username">Username</label>
      </div>
      <div class="col-75">
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <?php 
      $status = $_GET['status'];
      if($status == 'fail'){
          echo "<h4>Error occured.</h4>";
      }else if ($status == 'pass'){
          echo "<h3>You have been succesfully entered in Lottery Winner List.</h3>";
      }else{
          echo"";
      }
      ?>
    </div>    
    <div class="row">
      
      <input type="submit" value="Submit">
   
    </div>
  </form>
</div>

</body>
</html>

<!-- Backend-->

<?php
include('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname    = $_POST['firstname'];
    $lname    = $_POST['lastname'];
    $phoneno  = $_POST['phoneno'];
    $username = $_POST['username'];
    
    
    $sqlfetch = "SELECT * FROM LotteryUsers";
    $result   = $conn->query($sqlfetch);
    
    $ttb =0;
    
    $sql = "INSERT INTO LotteryUsers (firstname, lastname, phoneno, username ,ttb)
VALUES ('$fname', '$lname', '$phoneno', '$username', 1)";
    
    
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["username"] == $username) {
                $ttb = $row["ttb"];
            }
        }
    } 
         if($ttb==0){
                   if ($conn->query($sql) === TRUE) {
            header("Location: https://test.startost.com/intern/lottery_system/index.php?status=pass");
        } else {
            header("Location: https://test.startost.com/intern/lottery_system/index.php?status=fail");
        }  
        }else{
            $sqlttb = "UPDATE LotteryUsers SET ttb='$ttb'+1 WHERE username='$username'";
                if ($conn->query($sqlttb) === TRUE) {
                    header("Location: https://test.startost.com/intern/lottery_system/index.php?status=pass");
                } else {
                    header("Location: https://test.startost.com/intern/lottery_system/index.php?status=fail");
                }
         }
    $conn->close();
}
?>
