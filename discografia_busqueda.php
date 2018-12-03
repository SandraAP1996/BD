<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>

        <?php
        /////////////////////////////////////////////////////////////////      CONEXION A LA BASE DE DATOS DISCOGRAFIA
        @$dwes = new mysqli('localhost','root', '', 'discografia');

        if ($dwes->connect_errno != null) { 
            echo 'Error conectando a la base de datos: '; 
            echo '$dwes->connect_error'; exit(); 
        }else{
            echo 'Exito en la conexion a Nueva Cancion<br>';
        }
        /////////////////////////////////////////////////////////////////

        //////////////////////////////////////    MOSTRAR EL FORMULARIO

        $consulta = "SELECT DISTINCT(genero) FROM cancion";
        $resultado = $dwes->query($consulta);
        $consult_genero = $resultado->fetch_object();

        /////////////////////////////////////////////////////////////////      COMPROBACIÓN DE LA INSERCIÓN DE DATOS

        if($_POST){

            //VARIABLES                     //VARIABLES DE ERRO         //VARIABLES DE MENSAJE
            @$tipo=$_REQUEST['tipo'];        $error_tipo=false;          $msg_tipo="";
            @$genero=$_REQUEST['genero'];
            @$buscar=$_REQUEST['buscar'];
            $select="*";                     $tabla="cancion";           $cadena="";

            echo $tipo,$genero,$buscar;

            //COMPROBACIÓN de selección de TIPO
            if(!isset($_POST['tipo'])){

                $msg_tipo="* Debe introducir un tipo de busqueda";
                echo "NO SE HA HECHO CORRECTAMENTE LA CONSULTA";

            }else{

                echo "SE HA HECHO BIEN LA CONSULTA";
                $msg_tipo="";

                //////////////////////////////////////    BUSCAR CONSULTA

                if($tipo == "titulo"){

                    $select="titulo";
                    $tabla="cancion, album";
                    $cadena=" genero = '".$genero."' AND ".$select." LIKE '%".$buscar."%'";

                }else if($tipo == "nombre"){
                    $select="nombre";
                    $tabla="album";
                    $cadena=" genero = '".$genero."' AND ".$select." LIKE '%".$buscar."%'";

                }else{
                    $select="titulo";
                    $tabla="cancion, album";
                    $cadena=" genero = '".$genero."' AND ".$select." LIKE '%".$buscar."%' OR nombre LIKE '%".$buscar."%'";
                }

                //SELECT titulo FROM cancion WHERE genero = "Jazz" AND titulo LIKE '%Fi%'

                $consulta = "SELECT DISTINCT ".$select." FROM ".$tabla." WHERE ".$cadena."";
                $resultado = $dwes->query($consulta);
                $consult_buscar = $resultado->fetch_object();

            }

            if($consult_buscar != null){


                while($consult_buscar != null){

                    echo '<p>'.$consult_buscar->$select.'</p>';

                    $consult_buscar = $resultado->fetch_object();

                }
            }

        }

        /////////////////////////////////////////////////////////////////

        ?>

        <h1>Buscar Canción</h1>
        <form name="input" action= discografia_busqueda.php method="post">           <!-----  COMEINZO de formulario   ----->

            <legend>
                Texto a buscar: <input type=text name="buscar" value="<?php if (isset($_POST['buscar'])){ echo $buscar; }else{ echo "Búsqueda";}?>" required><br><br>
                Buscar en:  Titulo de Canción <input type="radio" name="tipo" value="titulo"> Nombre de Albúm <input type="radio" name="tipo" value="nombre"> Ambos<input type="radio" name="tipo" value="Ambos">
                <br><br>
                Genero musical: <select name="genero" required>

                <?php     
                while( $consult_genero != null){

                    echo "<option value=". $consult_genero->genero.">". $consult_genero->genero."</option>";

                    $consult_genero = $resultado->fetch_object();
                }
                ?>
                </select>
            </legend><br><br>


            <input type=submit value="Buscar">

        </form>                                                             <!-----  FIN de formulario   ----->

        <a href="discografia.php"><h4>~Listado de Discos~</h4></a>




    </body>
</html>