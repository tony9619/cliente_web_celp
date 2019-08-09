<html>
	<head></head>
	<body>
		<form method="POST" action="fichero.php" enctype="multipart/form-data">
			<input type="file" name="img">
			<input type="text" name="usuario">
			<input type="submit" name="enviar">
		</form>
	</body>
	<?php
		 if(isset($_POST['enviar'])){
            $file = $_POST['img'];
            $user = $_POST['usuario'];
            

           $form_data = array ('usuario'=>$file,'nombre' =>$user);
            
            //API URL
            $url = 'http://localhost:81/php_proyectos/api/upload.php';

            //create a new cURL resource
            $ch = curl_init($url);

           
            $payload = json_encode($form_data);

            //attach encoded JSON string to the POST fields
            curl_setopt($ch, CURLOPT_POSTFIELDS, $file);

            //set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:multipart/form-data'));

            //return response instead of outputting
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            //execute the POST request
            $result = curl_exec($ch);

            print_r ($result);

            //close cURL resource
            curl_close($ch);
        }
	?>
</html>