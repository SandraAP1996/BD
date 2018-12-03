<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>

        <?php

        /////////////////////////////////////////////////////////////////      CONEXION A LA BASE DE DATOS
        @$dwes = new mysqli('localhost','dwes', 'dwes', 'dwes');

        if ($dwes->connect_errno != null) { 
            echo 'Error conectando a la base de datos: '; 
            echo '$dwes->connect_error'; exit(); 
        }else{
            echo 'Exito en la conexion a Stock<br>';
        }
        /////////////////////////////////////////////////////////////////


        //////////////////////////////////////     LISTADO DE LOS PRODUCTOS

        $consulta = "SELECT * FROM producto";
        $resultado = $dwes->query($consulta);
        $producto = $resultado->fetch_object();

        echo "<br>";
        while($producto != null){

            $id=$producto->cod;
            echo '<a href="ficha_producto.php?id='.$id.'>'.$producto->nombre_corto.'</a><br>';

            $producto = $resultado->fetch_object();

        }



        ?>
    </body>
</html>