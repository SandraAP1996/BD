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

        $consulta = "SELECT * FROM album";
        $resultado = $dwes->query($consulta);
        $disco = $resultado->fetch_object();
        ?>


        <!----------------------------------- FORMULARIO DE AÑADIR CANCION -->
        <h1>Introducir Album</h1>
        <form name="input" action= discografia_cancion.php method="post">

            Titulo: <input type="text" name="titulo" required><br>
            Discografia: <input type="texto" name="discografia" required ><br>
            Formato: <input type="texto" name="formato" required><br>

            ----------------------------------------------------------------------------------------
            <br><br>
            Fecha de Lanzamiento: <input type="date" name="lanzamiento" required><br>
            Fecha de Compra: <input type="date" name="compra" required><br>
            Precio: <input type="number" name="precio" required><br><br>

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
            $lanzamiento=$_REQUEST['lanzamiento'];
            $compra=$_REQUEST['compra'];
            $precio=$_REQUEST['precio'];

            //////////////////////////////////////     SACAR EL CODIGO MAYOR

            $consulta2 = "SELECT MAX(codigo) FROM album";
            $resultado2 = $dwes->query($consulta2);
            $max = $resultado2->fetch_object();

            echo $max;
        }

        ?>

    </body>
</html>