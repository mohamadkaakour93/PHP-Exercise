<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style-safe.css">
    <title>Safe Page</title>
</head>

<body>
<?php
echo '<script>alert("logged in successfully!")</script>';
session_start();
?>
<?php
foreach ($_SESSION["details"] as $key => $value) {
  echo "$key".":"."$value"."<br>";
}
session_destroy();
?>


</body>

</html>