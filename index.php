<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRONT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> 
    
    <div class="container contenedor_padre">
        <header class="row">            <!-- BANNER SUPERIOR DE LA PÁGINA -->
            <div class="col" id="cabecera">
                <h1>Noticiero Illinois</h1>
            </div>
        </header>

        <div class="container row">     <!-- COLUMNA DE NOTICIAS DE LA IZQUIERDA -->
            <section class="col-8">
                <div class='row'>
                    <?php
                        $link = mysqli_connect("localhost", "root", "", "web");
                        $link -> set_charset("utf8");

                        $sql = "SELECT * FROM GALERIA";

                        $cont = 0;

                        echo '<div class="row row-cols-2 g-4">';

                        if($result = mysqli_query($link, $sql)){
                            while($fila = mysqli_fetch_row($result)){

                                echo "
                                <div class='col'>
                                    <div class='card w-100 h-100 p-2' style='width: 18rem;'>
                                        <img src='img/".$fila[7]."' class='card-img-top' style='width: 356px; height:200px; object-fit: cover; border-radius: 5px;' alt='...'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>".$fila[1]."</h5>
                                            <p class='card-text' style='font-size: 16px; text-align: justify; text-indent: 20px;'>".$fila[5]."</p>
                                        </div>
                                        <div class='card-footer'>
                                            <p style='float: left; font-style: italic; color: grey;'>".$fila[6]."</p>
                                            <p style='float: right; font-style: bold; color: grey;'>".$fila[2]."</p>
                                        </div>
                                    </div>
                                </div>";
                            }
                        }
                        echo "</div>";
                    ?>
                </div>
            </section>
            <div class="col"></div>     <!-- COLUMNA DE ESPACIO AUTOMÁTICO -->
            <aside class="col-3 g-4">       <!-- COLUMNA DE ENLACES DE LA DERECHA -->
                <?php
                    $sql2 = "SELECT * FROM NOTICIAS";

                    if($result2 = mysqli_query($link, $sql2)){
                        while($linea = mysqli_fetch_row($result2)){
                            echo "
                                <div class='row'>
                                    <div class='card col' style='width: 18rem;'>
                                        <div class='card-body'>
                                            <h5 class='card-title'>".$linea[2]."</h5>
                                            <p class='card-text'>".$linea[3]."</p>
                                        </div>
                                        <div class='card-footer'>
                                            <p class='card-text'>".$linea[1]."</p>
                                        </div>
                                    </div>
                                </div>";
                        }
                    }
                ?>
            </aside>
        </div>
    </div>
</body>
</html>