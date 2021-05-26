<?php
$arr = array(
    "MUSICALS" => array("Oklahoma", "The Music Man","South Pacific"),
    "DRAMAS" => array("Lawrence of Arabia","To Kill a Mockingbird","Casablanca"),
    "MYSTERIES" => array("The Maltese Falcon","Rear Window","North by Northwest")

);
foreach($arr as $key => $val)
{
    echo $key."</br>";
    foreach( $val as $keyItem => $valKey)
    {
        echo "---->".$keyItem ." = ".$valKey."</br>";
    }
} 
krsort($arr);
foreach($arr as $key => $val)
{
    echo $key."</br>";
    foreach( $val as $keyItem => $valKey)
    {
        echo "---->".$keyItem ." = ".$valKey."</br>";
    }
} 



?> 