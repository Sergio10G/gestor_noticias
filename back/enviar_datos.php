<?php
    $link = mysqli_connect("localhost", "root", "", "WEB") or die("<h1>No se ha podido conectar con la base de datos</h1>");

    if(isset($_POST['titulo'])){
        $titulo = $_POST['titulo'];
    }
    else{
        $titulo = "";
    }

    if(isset($_POST['fecha'])){
        $fecha = $_POST['fecha'];
    }
    else{
        $fecha = "";
    }

    if(isset($_POST['enlace'])){
        $enlace = $_POST['enlace'];
        if(substr($enlace, 0, 4) != "http"){
            $enlace = "https://".$enlace;
        }
    }

    if(isset($_POST['tipo'])){
        $tipo = $_POST['tipo'];
    }

    if(isset($_POST['destinatario'])){
        $destinatario = $_POST['destinatario'];
    }

    if(isset($_POST['noticia'])){
        $noticia = $_POST['noticia'];
    }
    else{
        $noticia = "";
    }

    if(isset($_POST['fuente'])){
        $fuente = $_POST['fuente'];
    }

    if(count($_FILES) > 0){
        if($_FILES['imagen'] !== null){
            $imagen = $_FILES['imagen'];
            foreach($imagen as $key => $value){
                echo "<strong>$key<strong>: $value<br>";
            } 
        }
    }
    

    if(isset($_POST['submit'])){
        $submit = $_POST['submit'];
    }
    /*
    foreach ($_FILES as $key => $archivo) {
        echo $key.": <br>";
        foreach ($archivo as $key2 => $value) {
            echo "____".$key2." - ".$value."<br>";
        }
        echo "<hr>";
    }
    */
?>

<?php 
    switch($submit){
        case "galeria":
            //echo "<h1>Enviando a galeria...</h1>";
            mysqli_query($link, "INSERT INTO GALERIA(TITULO, FECHA, TIPO, DESTINATARIO, NOTICIA, FUENTE, IMAGEN) VALUES
            ('$titulo', '$fecha', '$tipo', '$destinatario', '$noticia', '$fuente', '".$imagen['name']."')");
            move_uploaded_file($imagen['tmp_name'], "../img/".$imagen['name']);
            echo "";
            break;
        
        case "noticia":
            //echo "<h1>Enviando a noticias...</h1>";
            mysqli_query($link, "INSERT INTO NOTICIAS(FECHA, TEXTO, ENLACE) VALUES
            ('$fecha', '$titulo', '<a href=\"$enlace\" target=\"_blank\">Leer más...</a>')");
            break;

        default:
            break;
    }
    mysqli_close($link);
    $url = "admin.php?";
    //header("refresh: 1; admin.php?titulo=$titulo&noticia=$noticia");
    header("location: admin.php");
?>