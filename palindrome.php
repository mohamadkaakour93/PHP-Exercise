<?php 
function Palindrome($string){ 
    $string_reverse = strrev($string);
    if (strcasecmp($string, $string_reverse) == 0) {
        echo "TRUE! it's a palindrome!"; 
    }
    elseif(is_numeric($string)==1){
        echo"enter a value as string";

    }else{
        echo "FALSE! it's not a palindrome!";
    }
} 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palindrome</title>
</head>
<body>
    <div class="content">
    <h4>check if your word is a palindrome</h4>
    <p>Enter your word here</p>
    <form action="palindrome.php" method="POST">
    <label for="str">your word:</label>
    <input type="text" name="string" id="str" value=<?php echo "$_POST[string]"; ?> required>
    <button type="submit">show me result</button>
    </form>
    <?php
    if (!empty($_POST["string"])){
        if (isset($_POST["string"])){
            Palindrome($_POST["string"]);
        }
            
    }
    ?>
    </div>



</body>
</html>
