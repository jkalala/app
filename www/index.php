

<?php require_once("database.php");?>
<?php require_once("functions.php"); ?>
<?php require_once("form_functions.php"); ?>

<?php 



 
     // VALIDAR FORMULARIO 
     if (isset($_POST['submit'])) { // formulario foi enviado
       $errors = array();
      // validar os dados do formulario
       $required_fields = array('nome', 'senha');
       $errors = array_merge($errors, check_required_fields($required_fields, $_POST));
       $fields_with_lengths = array('nome' => 30, 'senha' => 30);
       $errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));
    
       $usuario =trim(mysql_prep($_POST['nome']));
       $senha =trim(mysql_prep($_POST['senha']));
       $hashed_password = sha1($senha);
      
       if ( empty($errors)){
       // check database to see if username and the hashed password exist there.
       $query = "SELECT ID , usuario ";
       $query .= "FROM usuarios ";
       $query .= "WHERE usuario = '{$usuario}'";
       $query .= "AND hashed_password = '{$hashed_password}'";
       $query .= "LIMIT 1";
       $result_set = $database->query($query);
        confirm_query($result_set);
       if ($database->num_rows($result_set) ==1) {
           
        // username/password authenticated
        // and only 1 match
         $found_user = $database->fetch_array($result_set);
         $_SESSION['user_id'] = $found_user['id'];
         $_SESSION['usuario'] = $found_user['usuario'];
          redirect_to ("automobilista.html");
    
       } else {
        // username/password combo was not found in the database
          $message ="Usuario/senha incorecto.<br/>
               Please make sur your caps lock key is off and try again.";
       }
   } else {
 
     if (count($errors) == 1) {
        $message ="Aconteceu 1 erro no formulario.";
     } else {
        $message = "Houve " . count($errors) ."erros no formulario. ";
        }
    }
   } else { // Form has not been submitted
       
       if (isset($_GET['logout']) && $_GET['logout'] ==1 ) {
       $message ="You are now loggout";
        }
       $usuario = "";
       $senha = "";
       }
?>


<!DOCTYPE html>
<!--HTML5 doctype-->
<html>

<head>

    <title>Cadastro Rodoviaria</title>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" type="text/css" href="lib/appframework/icons.css" />
    <link rel="stylesheet" type="text/css" href="lib/appframework/af.ui.css" />

    <script type="text/javascript" charset="utf-8" src="lib/jquery.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="lib/fastclick.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="lib/appframework/appframework.ui.min.js"></script>

    <script>

        $(document).ready(function(){

            $("#main").bind("panelbeforeload", startApp);
            // setup signin and signup button events
            $("#login").on("click", function(){
                signIn();
            });

            $("#register").on("click", function(){
                signUp();
            });

        });

        function signIn(){


            // SIGNIN SERVER CALL CODE GOES HERE

            valid_login = false;

            if(valid_login){
                $.afui.loadContent("#main", null, null, "fade");
            }
            else
            {
                //Example use of the error toast api
                var opts={
                    message:"Senha/Palavra-passe Invalidos",
                    position:"tc",
                    delay:2000,
                    autoClose:true,
                    type:"error"
                };
                $.afui.toast(opts);
            }
        }

        function signUp(){

            //example client side validation
            if ($("#password").val() === $("#confirmpassword").val())
            {
                // SIGNUP SERVER CALL CODE GOES HERE

                //render main view
                $.afui.loadContent("#main", null, null, "fade");

                //Example use of the success toast
                var opts={
                    message:"Conta Criada",
                    position:"tc",
                    delay:2000,
                    autoClose:true,
                    type:"success"
                };
                $.afui.toast(opts);

            }
            else
            {
                //Example use of the error toast
                var opts={
                    message:"Palavras-passe não correspondem",
                    position:"tc",
                    delay:2000,
                    autoClose:true,
                    type:"error"
                };
                $.afui.toast(opts);
            }


        }

        function startApp(){
            // clears all back button history
            $.afui.clearHistory();

            // your app code here
        }

    </script>

</head>

<body>

    <div id="splashscreen" class='ui-loader heavy'>
        Registo do Condutor
        <br>
        <br>
        <span class='ui-icon ui-icon-loading spin'></span>
        <h1>Iniciando ...</h1>
    </div>

    <div class="view" id="mainview">
        <header>
            <h1>Registo do Condutor</h1>
        </header>

        <div class="pages">

            <!-- Welcome View -->
            <div class="panel" data-title="RIC" id="page1" data-header="none" data-footer="none" selected="true">
                <div style="text-align:center">
                    <br>
                    <br>
                    <h2>Bemvindo</h2>
                    <br>
                    <br>
					<article>
					
					O Registo Individual do Condutor (RIC), é uma espécie de cadastro dos automobilistas onde são anotadas 
					as infracções cometidas, no entanto só inclui contra-ordenações praticadas desde 1 de Janeiro de 2015.
					</article>
                </div>
                <ul class="list inset">
                    <li><a href="#signin" class="icon user" style="text-align:center">Login</a></li>
                    <li><a href="#signup" class="icon pencil" style="text-align:center">Registra-se</a></li>
                </ul>
            </div>

            <!-- Login View -->
            <div class="panel" data-title="Login" id="signin" data-footer="none">
                <div style="text-align:center">
                    <br>
                    <br>
                    <p>Favor de introduzir a sua palavra de usuario e senha</p>
                    <br>
                    <br>
                </div>
				
			<form name="login-form" action="index.php" method="post">
                <input name="nome" type="text" placeholder="usuario"  />
                <input name="senha" type="password" placeholder="palavra-passe" />
			   <input type="submit" name="submit"  class="button block" id="login" value="Login" /> 
            <!--   <a class="button block" href="automobilista.html" id="login">Login</a> -->
			</form>
            </div>

            <!-- Register View -->
            <div class="panel" data-title="Registra-se" id="signup" data-footer="none">
                <div style="text-align:center">
                    <br>
                    <br>
                    <p>Registre-se para ter acesso ao sistema</p>
                    <br>
                    <br>
                </div>
			<form name="login-form" action="registrar.php" method="post">
                <input name="name" type="text" placeholder="Name" id="name" />
                <input name="email" type="email" placeholder="Email" id="email" />
                <input name="username" type="text" placeholder="Username" id="username" />
                <input name="password" type="password" placeholder="Password" id="password" />
                <input name="password1" type="password" placeholder="Confirm Password" id="confirmpassword" />
				<input type="submit" name="submit"   class="button block" id="register" value="Registrar-se" /> 
            <!--    <a class="button block" href="#" id="register">Register</a> -->
			</form>
            </div>

            <!-- Main App View -->
            <div class="panel" data-title="REGISTO DO CONDUTOR" id="main">
                <p>Esta aplicação permite criar um ficheiro centralizado sobre todas infracções cometidas na via pública</p>
            </div>
        </div>
    </div>

</body>

</html>