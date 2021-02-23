<?php
session_start();
if(isset($_POST['front'])){
    $front = true;
}
else{
    $front = false;
}

if(isset($_POST['cerrar'])){
    $cerrar = true;
}
else{
    $cerrar = false;
}

if($front){
    header("refresh: 0.1; ../index.php");
}
else if($cerrar){
    //var_dump($_SESSION['sesion_iniciada']);
    $_SESSION['sesion_iniciada'] = false;
    session_destroy();
    header("refresh: 0.1; admin.php");
}
/*
echo var_dump($front);
echo "<br>";
echo var_dump($cerrar);
*/