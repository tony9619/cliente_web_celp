<?php
    function API($endpoint){
        $url="https://testqacep.000webhostapp.com/php_proyectos/api/";
        $respuesta = $url . $endpoint;
        return $respuesta;
    }

    $direccion = API("all_users");
    $json = file_get_contents($direccion);
    
    $datos = json_decode($json,true);
    print_r($datos);

    $users = array(
        array('John', 'West'),
        array('Peter', 'Parker'),
        array('Ann', 'Jolie')
    );
   
?>
<html>
    <head>
        <title>All users</title>
    </head>
    <body>
        <table >
       
        <?php      
            
            foreach($datos as $item)
            {
                foreach($item as $item2)
                {
                    
                    foreach ($item2 as $key=>$value){
                       // echo $key; // Nombre de la variable(nom, des, rut, etc)
                        //echo $value; // Su valor
                        echo "
                            <tr><td>".$key."</td><td>".$value."</td></tr>";
                            
                    }
                   
                }
            }  

            

            
        ?>
        
        </table>
        <form method="post" action="index.php">
            <table>
                <tr>
                    <td><input type="text" placeholder="usuario" name="usuario"/></td>
                    <td><input type="text" placeholder="nombre" name="nombre"/></td>
                </tr>
                <tr>
                    <td><input type="text" placeholder="apellido" name="apellido"/></td>
                    <td><input type="text" placeholder="clave" name="clave"/></td>
                </tr>
                <tr>
                    <td><input type="submit" name="btn_enviar" value="Procesar"/></td>
                </tr>
            </table>
        </form>
    </body>
    <?php
        if(isset($_POST['btn_enviar'])){
            $usuario = $_POST['usuario'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $clave = $_POST['clave'];

            $form_data = array ('usuario'=>$usuario,'nombre' =>$nombre,'apellido'=>$apellido,'clave'=>$clave);
            
            //API URL
            $url = 'https://testqacep.000webhostapp.com/php_proyectos/api/new_user';

            //create a new cURL resource
            $ch = curl_init($url);

           
            $payload = json_encode($form_data);

            //attach encoded JSON string to the POST fields
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

            //set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

            //return response instead of outputting
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //execute the POST request
            $result = curl_exec($ch);

            print_r ($result);

            //close cURL resource
            curl_close($ch);
        }
    ?>
	<a href="fichero.php">Fichero</a>
</html>