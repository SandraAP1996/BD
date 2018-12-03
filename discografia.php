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
            echo 'Exito en la conexion a Discografia<br>';
        }
        /////////////////////////////////////////////////////////////////

        //////////////////////////////////////     LISTADO DE LOS DISCOS

        $consulta = "SELECT * FROM album";
        $resultado = $dwes->query($consulta);
        $disco = $resultado->fetch_object();


        ?>

        <h1>Listado de Discos</h1>

        <!-----------------------------------     LISTADO DE LOS DISCOS -->
        <br>
        <table>
            <tr>
                <td>Codigo</td>
                <td>Titulo</td>
                <td>Discografia</td>
                <td>Formato</td>
                <td>Fecha Lazamiento</td>
                <td>Fecha Compra</td>
                <td>Precio</td>
            </tr>

            <?php

            while($disco != null){

                echo '<tr><td>'.$disco->codigo.'</td><td>'.$disco->titulo.'</td><td>'.$disco->discografica.'</td><td>'.$disco->formato.'</td><td>'.$disco->fecha_lanzamiento.'</td><td>'.$disco->fecha_compra.'</td><td>'.$disco->precio.'</td></tr>';

                $disco = $resultado->fetch_object();

            }


            ?>
        </table>
        <br>
        <a href="discografia_album.php"><h4>~Album Nuevo~</h4></a>

        <a href="discografia_cancion.php"><h4>~Cancion Nueva~</h4></a>
        
        <a href="discografia_busqueda.php"><h4>~Buscar Cancion~</h4></a>




    </body>
</html>