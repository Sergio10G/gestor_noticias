<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> 
    <?php 
        if(isset($_POST['submit'])){
            $accion = $_POST['submit'];
        }

        if(isset($_POST['seleccion_galeria'])){
            $cods_galeria = $_POST['seleccion_galeria'];
        }

        if(isset($_POST['seleccion_noticias'])){
            $cods_noticias = $_POST['seleccion_noticias'];
        }

        $link = mysqli_connect("localhost", "root", "", "web");
    ?>
    <?php 
        echo "<h1>Borrando...</h1>";
        switch ($accion) {
            case 'borrar_galeria':
                foreach ($cods_galeria as $cod) {
                    mysqli_query($link, "DELETE FROM GALERIA WHERE COD = $cod");
                }
                break;

            case 'borrar_noticias':
                foreach ($cods_noticias as $cod) {
                    mysqli_query($link, "DELETE FROM NOTICIAS WHERE COD = $cod");
                }
                break;

            default:
                echo "<h1 class='text-danger'>ERROR $accion</h1>";
                break;
        }
        mysqli_close($link);
        header("refresh:1; admin.php");
    ?>
</body>
</html>