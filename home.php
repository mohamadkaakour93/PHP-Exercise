<?php

session_start();

function check(){
    if (!empty($_POST["fullname"]) && !empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["phone"]) && !empty($_POST["birthday"]) && !empty($_POST["socialnumber"])){
        return TRUE;
    }else{
        return FALSE;
    }
}

function check1(){
    if (!empty($_POST["uname"]) && !empty($_POST["psw"])){
        return TRUE;
    }else{
        return FALSE;
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
<?php
$reg = array("fullname" => $_POST["fullname"], "username" => $_POST["username"], "password" => $_POST["password"], "email" => $_POST["email"], "phone" => $_POST["phone"], "dateofbirth" => $_POST["birthday"], "socialnumber" => $_POST["socialnumber"]);
$nameErr = $usernamerr = $passwordrr = $rpassrr = $emailrr = $phonerr = $birthdayrr = $socialnumberrr = "";
$fullname = $username = $password =  $repeatpass= $email = $phone = $dateofbirth = $socialnumber = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["fullname"])) {
        $nameErr = "Name is required";
      } else {
          $fullname = test_input($_POST["fullname"]);
      }
      if (empty($_POST["username"])) {
          $usernamerr = "username is required";
      } else {
          $username = test_input($_POST["username"]);
      }
      if (empty($_POST["password"])) {
        $passwordrr = "password is required";
      } else {
          $password = test_input($_POST["password"]);
      }
      if (empty($_POST["email"])) {
        $emailrr = "email is required";
      } else {
          $email= test_input($_POST["email"]);
      }
      if (empty($_POST["phone"])) {
        $phonerr = "phone is required";
      } else {
          $phone= test_input($_POST["phone"]);
      }
      if (empty($_POST["birthday"])) {
        $birthdayrr = "date of birth is required";
      } else {
          $dateofbirth= test_input($_POST["birthday"]);
      }
      if (empty($_POST["socialnumber"])) {
        $socialnumberrr = "social security number is required";
      } else {
          $socialnumber = test_input($_POST["socialnumber"]);
      }
  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
<div class="content">
<div class="sign-up">
<h2>Registration form :</h2>
<form method="post" action="home.php">
<?php
  if (isset($_POST["register"])){
    if(check()){
        if ($_POST["password"] == $_POST["repeatpass"]){
            $val = array("fullname" => $_POST["fullname"], "username" => $_POST["username"], "password" => $_POST["password"], "email" => $_POST["email"], "phone" => $_POST["phone"], "dateofbirth" => $_POST["birthday"], "socialnumber" => $_POST["socialnumber"]);
            $_SESSION["details"] = $val;
            echo "registered successfully!";
        }else{
            echo "unmatched passwords";
            session_destroy();
        }

    }
}
?>
<label for="Fname"><b>FullName</b></label>
    <input type="text" placeholder="Enter Full Name" name="fullname" id="Fname" value="<?php echo $_SESSION["fullname"] ;?>">
    <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
<label for="Uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="Uname" value="<?php echo $_SESSION["username"];?>">
    <span class="error">* <?php echo $usernamerr;?></span>
  <br><br>
 <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="psw" value="<?php echo $_SESSION["password"];?>">
    <span class="error">* <?php echo $passwordrr;?></span>
  <br><br>
 <label for="r-psw"><b>Repeat-Password</b></label>
    <input type="password" placeholder="Enter Password again" name="repeatpass" id="r-psw" value="<?php echo $_SESSION["repeatpass"];?>">
    <span class="error">* <?php echo $rpassrr;?></span>
  <br><br>
 <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" id="email" value="<?php echo $_SESSION["email"];?>">
    <span class="error">* <?php echo $emailrr;?></span>
  <br><br>
 <label for="phone"><b>Phone</b></label>
    <input type="tel" placeholder="Enter Phone number" name="phone" id="phone" value="<?php echo $_SESSION["phone"];?>">
    <span class="error">* <?php echo $phonerr;?></span>
  <br><br>
 <label for="birthday"><b>Date of birth:</b></label>
  <input type="date" id="birthday" name="birthday" value="<?php echo $_SESSION["dateofbirth"];?>">
  <span class="error">* <?php echo $birthdayrr;?></span>
  <br><br>
  <label for="ssn"><b>Social security number:</b></label>
    <input type="text" placeholder="Enter Social security number" name="socialnumber" id="ssn" value="<?php echo $_SESSION["socialnumber"];?>">
    <span class="error">* <?php echo $socialnumberrr;?></span>
  <br><br>
    <hr>
    <p>By creating an account you agree to our <a href="#">Terms & conditions</a>.</p>

<button type="submit" class="registerbtn" name="register">Register</button>
</div>
</form>
<div class="log-in">
<h2>Log In form :</h2>
<form method="post" action="home.php">
<?php
if(check1()){
    if (isset($_POST["submit"])){
        if ($_POST["uname"] == $_SESSION["details"]["username"] && $_POST["psw"] == $_SESSION["details"]["password"]){
          header("Location:safe.php");
        }else{
            echo "invalid username or password";
        }

    }

}
?>
<label for="uname"><b>Username</b></label>
<input type="text" placeholder="Enter Username" name="uname" id="Uname" value="<?php echo $_SESSION["uname"];?>">
    <span class="error">* <?php echo $usernamerr;?></span>
  <br><br>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id="psw" value="<?php echo $_SESSION["psw"];?>">
    <span class="error">* <?php echo $passwordrr;?></span>
  <br><br>
        
      <button type="submit" class="loginbtn" name="submit" value="submit">Login</button>
</div>
</form>
</div>
</body>
</html>