<?php require_once("database.php");?>
<?php require_once("functions.php"); ?>
<?php require_once("form_functions.php"); ?>





 <?php
 
 
 
 
 
// define variables and set to empty values
$nomeErr = $emailErr = $usuarioErr = $senha1Err = $senha2Err = "";
$nome =    $email =    $usuario =    $senha1 =    $senha2 =  "";

function test_input($data) 
{
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $cartaErr = "Numero da carta por favor";
   } else {
     $nome = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$nome)) {
       $nomeErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["email"])) {
     $emailErr = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format"; 
     }
   }
   
   
   if (empty($_POST["username"])) {
     $usuarioErr = "O numero de bilhete de indentidade exigido";
   } else {
     $usuario = test_input($_POST["username"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$usuario)) {
       $usuarioErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["password"])) {
     $senhaErr = " formato erado";
   } else {
     $senha = test_input($_POST["password"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$senha)) {
       $senhaErr = "Only letters and white space allowed"; 
     }
   }
   
  if (empty($_POST["password1"])) {
     $senha2Err = "formato errado";
   } else {
     $senha2 = test_input($_POST["password1"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$senha2)) {
       $senhaErr = "Only letters and white space allowed"; 
     }
   } 
  




     // VALIDAR FORMULARIO 
     if (isset($_POST['submit'])) { // formulario foi enviado
       $errors = array();

      // validar os dados do formulario

       $required_fields = array('name', 'email', 'username','password', 'password1');
       $errors = array_merge($errors, check_required_fields($required_fields, $_POST));

       $fields_with_lengths = array('name' => 50, 'email' => 50,'username' => 50, 'password' => 50,'password1' => 50);
       $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
    
       $nome =trim(mysql_prep($_POST['name']));
       $email =trim(mysql_prep($_POST['email']));
	   $usuario =trim(mysql_prep($_POST['username']));
       $senha0 =trim(mysql_prep($_POST['password']));
	   $senha1 = sha1($senha);
	   $senha3 =trim(mysql_prep($_POST['password1']));
	   $senha2 = sha1($senha3);
	   
	         
      
       if ( empty($errors)){
            $query = " INSERT INTO registro ( 
                              name, email, username, password, password1
                          ) VALUES (
                             '{$nome}','{$email}' ,'{$usuario}','{$senha1}','{$senha2}'
                          )";
      $result = $database->query($query);
      if ($result){
	  
	       
		redirect_to ("geolocalisation.html");
	    
       // $message = "criacao novo usuario bem sucedido.";
       } else {
	   
	    echo 'failed';
      //  $message = "The user could not be created.";
       // $message .= "<br />" . mysql_error();
     }
     } else {
     if (count($errors) == 1) {
        $message ="Houve 1 erro no formulario.";
     } else {
        $message = "Houve " . count($errors) ."erros no formulario. ";
        }
    }


   } else { // Form has not been submitted

       $nome = "";
	   $email= "";
       $usuario = "";
	   $senha1 = "";
	
       $senha2= "";
	   
	   }   
	  }
	 
	   
?>


