<!DOCTYPE html>
<html lang="es">
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
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $pass = $_POST['password'];
        }

        $sesion_iniciada = false;

        define('admin_email', 'sejobmx@hotmail.es');
        define('admin_pass',  '1234abcd!');
        
        if($email == admin_email && $pass == admin_pass){
            echo "<h1 class='text-success'>Estás dentro.</h1>";
            $sesion_iniciada = true;
        }
        else{
            echo "<h1 class='text-danger'>¿¿Quién eres tú y qué haces aquí??</h1>";
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
                <div class="row align-items-end border-bottom p-3">
                    <div class="col-5">
                        <form method="POST" action="modificar.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input name="titulo" type="text" class="form-control" id="titulo" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input name="fecha" type="date" class="form-control" id="fecha" aria-describedby="emailHelp" required>
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
                                <input class="form-control" type="file" id="formFile" accept="image/*">
                            </div>
                            <button name="submit" value="galeria" type="submit" class="btn btn-primary" style="width: 100%;">Enviar</button>
                        </form>
                    </div>
                    <div class="col"></div>
                    <div class="col-5 ">
                        <form method="POST" action="modificar.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input name="titulo" type="text" class="form-control" id="titulo" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input name="fecha" type="date" class="form-control" id="fecha" aria-describedby="emailHelp" required>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach($galeria as $item){
                echo 
                "<tr>
                    <th scope='row'>".$item[0]."</th>
                    <td>".$item[1]."</td>
                    <td>".$item[2]."</td>
                </tr>";
            }
            echo '
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>';
            foreach($noticias as $noticia){
                echo '
                <tr>
                    <th scope="row">'.$noticia[0].'</th>
                    <td>'.$noticia[2].'</td>
                    <td>'.$noticia[1].'</td>
                </tr>
                ';
            }
            echo '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            ';
        }
    ?>
</body>
</html>