<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BUSQUEDA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> 

    <?php 
        if(isset($_POST['titulo_g'])){
            $titulo_g = "%".$_POST['titulo_g']."%";
        }
        else{
            $titulo_g = "%";
        }

        if(isset($_POST['titulo_n'])){
            $titulo_n = "%".$_POST['titulo_n']."%";
        }
        else{
            $titulo_n = "%";
        }

        if(isset($_POST['fecha_g']) && $_POST['fecha_g'] != ""){
            $fecha_g = substr($_POST['fecha_g'], 0, 10)."%";
        }
        else{
            $fecha_g = "%";
        }

        if(isset($_POST['fecha_n']) && $_POST['fecha_n'] != ""){
            $fecha_n = substr($_POST['fecha_n'], 0, 10)."%";
        }
        else{
            $fecha_n = "%";
        }

        if(isset($_POST['tipo'])){
            $tipo = $_POST['tipo'];
        }
        else{
            $tipo = "%";
        }

        if(isset($_POST['destinatario'])){
            $destinatario = $_POST['destinatario'];
        }
        else{
            $destinatario = "%";
        }

        if(isset($_POST['noticia'])){
            $noticia = "%".$_POST['noticia']."%";
        }
        else{
            $noticia = "%";
        }

        if(isset($_POST['fuente'])){
            $fuente = "%".$_POST['fuente']."%";
        }
        else{
            $fuente = "%";
        }

        if(isset($_POST['submit'])){
            $opcion = $_POST['submit'];
        }
        else{
            $opcion = null;
        }

        $link = mysqli_connect("localhost", "root", "", "WEB");

        $array_galeria = null;
        $array_noticias = null;

        switch ($opcion) {
            case 'galeria':
                $sql = "SELECT * FROM GALERIA WHERE TITULO LIKE '$titulo_g' AND FECHA LIKE '$fecha_g' AND TIPO LIKE '$tipo' AND DESTINATARIO LIKE '$destinatario' AND NOTICIA LIKE '$noticia' AND FUENTE LIKE '$fuente'";
                $array_galeria = [];
                if($res = mysqli_query($link, $sql)){
                    while($campo = mysqli_fetch_row($res)){
                        array_push($array_galeria, $campo);
                    }
                }
                break;
            
            case 'noticias':
                $sql2 = "SELECT * FROM NOTICIAS WHERE TEXTO LIKE '$titulo_n' AND FECHA LIKE '$fecha_n'";
                $array_noticias = [];
                if($res = mysqli_query($link, $sql2)){
                    while($campo = mysqli_fetch_row($res)){
                        array_push($array_noticias, $campo);
                    }
                }
                break;
            
            default:
                # code...
                break;
        }
    ?>

    <div class="container border rounded mt-5 mb-5">
        <div class="row border-bottom">
            <center><h1>BÚSQUEDA</h1></center>
        </div>
        <div class="row align-items-end border-bottom p-3">
            <div class="col-5">
                <center><h2>GALERÍA</h2></center>
                <form method="POST" action="busqueda.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input name="titulo_g" type="text" class="form-control" id="titulo" aria-describedby="emailHelp" >
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input name="fecha_g" type="date" class="form-control" id="fecha" aria-describedby="emailHelp">
                    </div>
                    <label for="tipo" class="form-label">Tipo</label>
                    <div class="mb-3">
                        <select name="tipo" class="form-select" aria-label="tipo">
                            <option selected value="%">Tipo de noticia</option>
                            <option value="NACIONAL">Nacional</option>
                            <option value="INTERNACIONAL">Internacional</option>
                            <option value="CURIOSIDAD">Curiosidad</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="destinatario" class="form-label">Destinatario</label>
                        <select name="destinatario" class="form-select" aria-label="destinatario">
                            <option selected value="%">Destinatario de la noticia</option>
                            <option value="ADULTO">Adulto</option>
                            <option value="JUVENIL">Juvenil</option>
                            <option value="INFANTIL">Infantil</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="noticia" class="form-label">Noticia</label>
                        <textarea name="noticia" class="form-control" rows="8" style="resize: none;"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="fuente" class="form-label">Fuente</label>
                        <input name="fuente" type="text" class="form-control" id="fuente" aria-describedby="emailHelp" >
                    </div>
                    <input type="reset" class="btn btn-warning" style="width: 49%;">
                    <button name="submit" value="galeria" type="submit" class="btn btn-primary" style="width: 49%;">Buscar en galería</button>
                </form>
            </div>
            <div class="col"></div>
            <div class="col-5">
                <center><h2>NOTICIAS</h2></center>
                <form method="POST" action="busqueda.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input name="titulo_n" type="text" class="form-control" id="titulo" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input name="fecha_n" type="date" class="form-control" id="fecha" aria-describedby="emailHelp">
                    </div>
                    <input type="reset" class="btn btn-warning" style="width: 49%;">
                    <button name="submit" value="noticias" type="submit" class="btn btn-primary" style="width: 49%;">Buscar en noticias</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php 
                    /*
                    echo "<strong>Titulo_G</strong>: $titulo_g<br>";
                    echo "<strong>Titul_N</strong>: $titulo_n<br>";
                    echo "<strong>Fecha_G</strong>: $fecha_g<br>";
                    echo "<strong>Fecha_N</strong>: $fecha_n<br>";
                    echo "<strong>Tipo</strong>: $tipo<br>";
                    echo "<strong>Destinatario</strong>: $destinatario<br>";
                    echo "<strong>Noticia</strong>: $noticia<br>";
                    echo "<strong>Fuente</strong>: $fuente<br>";
                    echo var_dump($array_galeria);
                    */
                    echo"<center><h3>".strtoupper($opcion)."</h3></center>";
                    switch ($opcion) {
                        case 'galeria':
                            echo '
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Titulo</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Tipo</th>
                                            <th scope="col">Destinatario</th>
                                            <th scope="col">Noticia</th>
                                            <th scope="col">Fuente</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            foreach($array_galeria as $item){
                                echo'
                                <tr>
                                    <th scope="row">'.$item[0].'</th>
                                    <td>'.$item[1].'</td>
                                    <td>'.substr($item[2], 0, 10).'</td>
                                    <td>'.$item[3].'</td>
                                    <td>'.$item[4].'</td>
                                    <td>'.substr($item[5], 0, 50).'...'.'</td>
                                    <td>'.$item[6].'</td>
                                </tr>
                                ';
                            }
                                echo '
                                    </tbody>
                                </table>
                            ';
                            break;

                        case 'noticias':
                            echo '
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Titulo</th>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Enlace</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                            foreach($array_noticias as $item){
                                echo'
                                <tr>
                                    <th scope="row">'.$item[0].'</th>
                                    <td>'.$item[2].'</td>
                                    <td>'.substr($item[1], 0, 10).'</td>
                                    <td>'.$item[3].'</td>
                                </tr>
                                ';
                            }
                                echo '
                                    </tbody>
                                </table>
                            ';
                            break;
                        
                        default:
                            # code...
                            break;
                    }
                ?>
            </div>
        </div>
        <div class="row bg-success" style="height: 100px;">
            <a href="index.php" class="d-block text-white align-self-center" style="text-decoration:none; text-align: center;"><h1>Volver al inicio</h1></a>
        </div>
    </div>
</body>
</html>