<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script> 

    <?php 
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $pass = $_POST['password'];
        }
        else{
            $email = null;
            $pass = null;
        }

        $sesion_iniciada = false;

        define('admin_email', 'admin@admin');
        define('admin_pass',  '1234');

        $usu1 = ['email' => admin_email, 'pass' => admin_pass];
        $usuarios_admitidos = [];
        array_push($usuarios_admitidos, $usu1);
        
        foreach($usuarios_admitidos as $usuario_admitido){
            if($email !== null && $email == $usuario_admitido['email']){
                if($pass !== null && $pass == $usuario_admitido['pass']){
                    //echo "<h1 class='text-success'>Estás dentro.</h1>";
                    $sesion_iniciada = true;
                }
            }
        }
    ?>

    <?php 
        if($sesion_iniciada){
            $link = mysqli_connect("localhost", "root", "", "web");
            $link -> set_charset("utf8");
            
            $galeria = [];
            $noticias = [];

            if($result = mysqli_query($link, "SELECT * FROM GALERIA")){
                while($fila = mysqli_fetch_row($result)){
                    array_push($galeria, $fila);
                }
            }

            if($result = mysqli_query($link, "SELECT * FROM NOTICIAS")){
                while($fila = mysqli_fetch_row($result)){
                    array_push($noticias, $fila);
                }
            }

            

            echo '
            <div class="container border rounded " style="margin-top: 75px; margin-bottom: 100px;">
                <div class="row border-bottom">
                    <center><h1>BACK DEL NOTICIERO</h1></center>
                </div>
                <div class="row align-items-start border-bottom p-3">
                    <div class="col-5">
                        <center><h1>GALERÍA</h1></center>
                        <form enctype="multipart/form-data" method="POST" action="enviar_datos.php">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input name="titulo" type="text" class="form-control" id="titulo" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input name="fecha" type="date" class="form-control" id="fecha" aria-describedby="emailHelp">
                            </div>
                            <label for="tipo" class="form-label">Tipo</label>
                            <div class="mb-3">
                                <select name="tipo" class="form-select" aria-label="tipo">
                                    <option selected>Tipo de noticia</option>
                                    <option value="NACIONAL">Nacional</option>
                                    <option value="INTERNACIONAL">Internacional</option>
                                    <option value="CURIOSIDAD">Curiosidad</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="destinatario" class="form-label">Destinatario</label>
                                <select name="destinatario" class="form-select" aria-label="destinatario">
                                    <option selected>Destinatario de la noticia</option>
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
                                <input name="fuente" type="text" class="form-control" id="fuente" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Imagen</label>
                                <input name="imagen" class="form-control" type="file" id="formFile" accept="image/*">
                            </div>
                            <button name="submit" value="galeria" type="submit" class="btn btn-primary" style="width: 100%;">Enviar</button>
                        </form>
                    </div>
                    <div class="col"></div>
                    <div class="col-5 ">
                        <center><h1>NOTICIAS</h1></center>
                        <form method="POST" action="enviar_datos.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input name="titulo" type="text" class="form-control" id="titulo" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input name="fecha" type="date" class="form-control" id="fecha" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="enlace" class="form-label">Enlace</label>
                                <input name="enlace" type="text" class="form-control" id="enlace" aria-describedby="emailHelp" required>
                            </div>
                            <button name="submit" value="noticia" type="submit" class="btn btn-primary" style="width: 100%;">Enviar</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <form method="POST" action="modificar_datos.php" enctype="multipart/form-data">
                            <button name="submit" value="borrar_galeria" type="submit" class="btn btn-danger" style="width: 49%;">Borrar</button>
                            <input type="reset" class="btn btn-primary" style="width: 49%;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Título</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Tipo/Destinatario</th>
                                        <th scope="col">Noticia</th>
                                        <th scope="col">Imagen</th>
                                        <th scope="col">Selección</th>
                                    </tr>
                                </thead>
                                <tbody>';
                foreach($galeria as $item){
                    echo 
                    "<tr>
                        <th scope='row'>".$item[1]."</th>
                        <td>".substr($item[2], 0, 10)."</td>
                        <td>".$item[3]." ".$item[4]."</td>
                        <td>".substr($item[5], 0, 30)."..."."</td>
                        <td><img src='../img/".$item[7]."' style='width:75px; object-fit: cover;'></td>
                        <td><input type='checkbox' name='seleccion_galeria[]' value='".$item[0]."'></td>
                    </tr>";
                }
            echo '
                                    </form>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="col">
                        <form method="POST" action="modificar_datos.php" enctype="multipart/form-data">
                        <button name="submit" value="borrar_noticias" type="submit" class="btn btn-danger" style="width: 49%;">Borrar</button>
                        <input type="reset" class="btn btn-primary" style="width: 49%;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Título</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Selección</th>
                                    </tr>
                                </thead>
                                <tbody>';
            foreach($noticias as $noticia){
                echo '
                <tr>
                    <th scope="row">'.$noticia[2].'</th>
                    <td>'.substr($noticia[1], 0, 10).'</td>
                    <td><input type="checkbox" name="seleccion_noticias[]" value="'.$noticia[0].'"></td>
                </tr>
                ';
            }
            echo '
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
            ';
        }
        else{
            echo '
            <div class="container border p-4" style="margin-top: 200px;">
                <div class="row">
                    <center><h1>ACCESO DE MANTENIMIENTO</h1></center>
                </div>
                <form method="POST" action="admin.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Dirección de Correo Electrónico</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1" required>
                    </div>
                    <!--
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    -->
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
            ';
        }
    ?>
</body>
</html>