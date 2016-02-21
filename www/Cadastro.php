<?php require_once("database.php");?>
<?php require_once("functions.php"); ?>
<?php require_once("form_functions.php"); ?>






<!DOCTYPE HTML> 
<html>
<head>
<title>REGISTO DE INFRACOES DO CONDUTOR</title>
<style>
.error {color: #FF0000;}
</style>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  

<!--link rel="stylesheet" href="forms.css" > -->
</head>
<body> 

<?php
// define variables and set to empty values
$cartaErr = $biErr = $nomeErr = $nascErr = $crimeErr = $penaErr = $ufcErr =  "";
$carta =    $bi =    $nome =    $nasc =    $crime =    $pena = $ufc = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["carta"])) {
     $cartaErr = "Numero da carta por favor";
   } else {
     $carta = test_input($_POST["carta"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ][0-9]*$/",$carta)) {
       $cartaErr = "apenas letras, espaco em branco e numeros"; 
     }
   }
   
   if (empty($_POST["bi"])) {
     $biErr = "O numero de bilhete de indentidade exigido";
   } else {
     $bi = test_input($_POST["bi"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$bi)) {
       $biErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["nome"])) {
     $nomeErr = "Nome do condutor e exigido";
   } else {
     $nome = test_input($_POST["nome"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$nome)) {
       $nomeErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["nasc"])) {
     $nacsErr = "Data de nascimento aqui";
   } else {
     $nasc = test_input($_POST["nasc"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$nasc)) {
       $nascErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["crime"])) {
     $crimeErr = "Infracao cometida";
   } else {
     $crime = test_input($_POST["crime"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$crime)) {
       $crimeErr = "Only letters and white space allowed"; 
     }
   }
   if (empty($_POST["pena"])) {
     $penaErr = "Pena aplicada";
   } else {
     $pena = test_input($_POST["pena"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$pena)) {
      $penaErr = "Only letters and white space allowed"; 
     }
   }
   
   if (empty($_POST["ufc"])) {
     $ufcErr = "Pena aplicada";
   } else {
     $pena = test_input($_POST["ufc"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$ufc)) {
      $ufcErr = "Only letters and white space allowed"; 
     }
   }
   
   
   
   
   
  // if (empty($_POST["email"])) {
  //   $emailErr = "Email is required";
  // } else {
   //  $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     //  $emailErr = "Invalid email format"; 
     //}
   //}
     
  // if (empty($_POST["website"])) {
  //   $website = "";
   //} else {
   //  $website = test_input($_POST["website"]);
     // check if URL address syntax is valid
   //  if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
   //    $websiteErr = "Invalid URL"; 
   //  } 
  // }

 //  if (empty($_POST["comment"])) {
 //    $comment = "";
//   } else {
//     $comment = test_input($_POST["comment"]);
   }

 //  if (empty($_POST["gender"])) {
 //    $genderErr = "Gender is required";
 //  } else {
 //    $gender = test_input($_POST["gender"]);
  // }
//}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}




 
     // VALIDAR FORMULARIO 
     if (isset($_POST['submit'])) { // formulario foi enviado
       $errors = array();

      // validar os dados do formulario

       $required_fields = array('carta', 'bi', 'nome','nasc', 'crime', 'pena','ufc');
       $errors = array_merge($errors, check_required_fields($required_fields, $_POST));

       $fields_with_lengths = array('carta' => 15, 'bi' => 15,'nome' => 50, 'nasc' => 15,'e-mail' => 50, 'crime' => 50,'pena' => 50, 'comment' => 100, 'gender' => 30, 'ufc' =>20);
       $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
    
       $carta =trim(mysql_prep($_POST['carta']));
       $bi =trim(mysql_prep($_POST['bi']));
	   $nome =trim(mysql_prep($_POST['nome']));
       $nasc =trim(mysql_prep($_POST['nasc']));
	   
	   //$email =trim(mysql_prep($_POST['email']));
       $crime =trim(mysql_prep($_POST['crime']));
	   
	   $pena =trim(mysql_prep($_POST['pena']));
       $ufc =trim(mysql_prep($_POST['ufc']));
	  // $usuario =trim(mysql_prep($_POST['gender']));
       
       
      
       if ( empty($errors)){
            $query = " INSERT INTO cadastro ( 
                              num_carta, BI, Nome_Condutor, data_nascimento, crime, pena, ufc
                          ) VALUES (
                             '{$carta}','{$bi}' ,'{$nome}','{$nasc}','{$crime}','{$pena}','{$ufc}'
                          )";
      $result = $database->query($query);
      if ($result){
        $message = "criacao novo usuario bem sucedido.";
       } else {
        $message = "The user could not be created.";
        $message .= "<br />" . mysql_error();
     }
} else {
     if (count($errors) == 1) {
        $message ="Houve 1 erro no formulario.";
     } else {
        $message = "Houve " . count($errors) ."erros no formulario. ";
        }
    }


   } else { // Form has not been submitted

       $carta = "";
	   $bi= "";
       $nome = "";
	   $nasc = "";
	  // $e-mail= "";
      $crime= "";
	  $pena = "";
	  $ufc = "";
      // $gender= "";
	   
       }
?>





<!-- attention -->

<div class="container">
 <h2>CONTRAORDENAÇÕES</h2>
  <form role="form" name="myForm"   method="post" action="Cadastro.php">
    <div class="form-group">
      <label for="nome">Carta de conducao:</label>
      <input type="text" class="form-control" id="nome" name="carta" placeholder="Carta de Condução">
	  

    </div>
    <div class="form-group">
      <label for="nasc">Bilhete de Indentidade:</label>
      <input type="text" class="form-control" id="nasc" name="bi"  placeholder="Bilhete de Indentidade">
    </div>
	<div class="form-group">
      <label for="nome">Nome do condutor:</label>
      <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do condutor">
    </div>
    <div class="form-group">
      <label for="nasc">Data de nascimento:</label>
      <input type="text" class="form-control" id="nasc" name="nasc"  placeholder="Data de Nascimento">
    </div>
	<div class="form-group">
      <label for="nome">Infracao cometida:</label>
      <input type="text" class="form-control" id="nome" name="crime" placeholder="Infração cometida">
    </div>
    <div class="form-group">
      <label for="nasc">Pena a aplicar:</label>
      <input type="text" class="form-control" id="nasc" name="pena" placeholder="Multa">
    </div>
	
	<div class="form-group">
      <label for="nome">UCF : </label>
      <input type="text" class="form-control" id="nome" name="ufc"   placeholder="UCF">
    </div>
    
	
	
    <div class="checkbox">
      <label><input type="checkbox"> Remember me</label>
    </div>
	<input type="submit" name="submit" value="Submit"> 

	<a href="automobilista.html" class="btn btn-success">Voltar</a>
    
	<a href="index.php" class="btn btn-primary">Logout</a>
  </form>
</div>








</body>
</html>



