<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>

        <?php

        /////////////////////////////////////////////////////////////////      CONEXION A LA BASE DE DATOS STOCK
        @$dwes = new mysqli('localhost','dwes', 'dwes', 'dwes');

        if ($dwes->connect_errno != null) { 
            echo 'Error conectando a la base de datos: '; 
            echo '$dwes->connect_error'; exit(); 
        }else{
            echo 'Exito en la conexion a Stock<br>';
        }
        /////////////////////////////////////////////////////////////////


        //////////////////////////////////////    DATOS PASADOS DE tienda.php

        //Datos pasados
        $id=($_GET['id']);

        print_r ($_GET);    //Mostrar datos del Array
        $contanido="";
        $consulta = "SELECT * FROM producto p, stock s, tienda t WHERE p.cod=s.producto AND s.tienda=t.cod AND p.cod=".$id;                 //Relación de multitablas
        $resultado = $dwes->query($consulta);
        $contenido = $resultado->fetch_object();
        
        echo "Producto ".$contenido->p.nombre_corto;

                
        
        
        
        
        ?>
    </body>
</html>