<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>

        <?php
        /////////////////////////////////////////////////////////////////      CONEXION A LA BASE DE DATOS STOCK
        @$dwes = new mysqli('localhost','root', '', 'discografia');

        if ($dwes->connect_errno != null) { 
            echo 'Error conectando a la base de datos: '; 
            echo '$dwes->connect_error'; exit(); 
        }else{
            echo 'Exito en la conexion a Nueva Cancion<br>';
        }
        /////////////////////////////////////////////////////////////////

        //////////////////////////////////////     LISTADO DE LOS DISCOS

        $consulta = "SELECT column_type FROM information_schema.COLUMNS WHERE TABLE_NAME = 'cancion' AND COLUMN_NAME = 'genero'";
        $resultado = $dwes->query($consulta);
        $disco = $resultado->fetch_object();
                
        ?>


        <!----------------------------------- FORMULARIO DE AÑADIR CANCION -->
        <h1>Introducir Cancion</h1>
        <form name="input" action= discografia_cancion.php method="post">

            Titulo: <input type="text" name="titulo" required><br>
            Album: <select name="album">

            <?php     
            while($disco != null){

                echo "<option value=".$disco->titulo.">".$disco->titulo."</option>";

                $disco = $resultado->fetch_object();
            }
            ?>
            </select><br><br>


            ----------------------------------------------------------------------------------------
            <br><br>
            Tiempo: <input type="number">

            <input type=submit value="Enviar">

        </form>

        <a href="discografia.php"><h4>~Listado de Discos~</h4></a>
        <?php

        //////////////////////////////////////     CONTROL DE ENVIO DE DATOS
        if($_POST){

            //ATRIBUTOS
            $titulo=$_REQUEST['titulo'];
            $discografia=$_REQUEST['discografia'];
            $formato=$_REQUEST['formato'];
            $album=$_REQUEST['album'];
            $lanzamiento=$_REQUEST['lanzamiento'];
            $compra=$_REQUEST['compra'];
            $precio=$_REQUEST['precio'];


            echo "SE INTRODUCIDO LO SIGUIENTE: ".$titulo,$discografia,$formato,$album,$lanzamiento,$compra,$precio;



        }

        ?>

    </body>
</html>