<!DOCTYPE html>
<html>
<head>
    <title>Lottery Admin Panel</title>
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

input[type=number] {
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

<center><h2>Lottery Admin Panel</h2>
<h3>Lottery Winner List</h3>

<div class="container">
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
          <div class="row">
      <div class="col-25">
        <label for="admin">Admin Username</label>
      </div>
      <div class="col-75">
        <input type="text" id="admin" name="admin" placeholder="Admin username" required>
      </div>
    </div>
          <div class="row">
      <div class="col-25">
        <label for="adminpass">Admin Password</label>
      </div>
      <div class="col-75">
        <input type="text" id="adminpass" name="adminpass" placeholder="Admin Password" required>
      </div>
    </div>    
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>

</body>
</html>

<!-- PHP backend-->
<?php 
include('db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $admin = $_POST['admin'];
    $adminpass = $_POST['adminpass'];
    
    $winnername = ""; 
    $winnerlname = "";
    $winnerphone = "";
    $winneruname = "";
    
if($admin == 'admin' && $adminpass == 'pass')  {

   $sql = "SELECT * FROM LotteryUsers ORDER BY RAND() LIMIT 1";

$result = $conn->query($sql);

while($row = $result->fetch_array()){
    $winnername = $row['firstname'];
     $winnerlname = $row['lastname'];
      $winnerphone = $row['phoneno'];
     $winneruname =  $row['username'];
} 


echo "<h2>Winner IS!!!!!!!</h3>";

echo "First Name " .$winnername . "<br>". "Last Name " .$winnerlname . "<br>" . "Phone Number " .$winnerphone . "<br>". "Username " .$winneruname . "<br>";
}  
else{
    echo "<h4>Login Failed </h4>";
}

}