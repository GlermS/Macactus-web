<html>
<body>




<?php
require_once "config.php";

$nome = $escola = $whatsapp = $email = $confirm_email = $username = $password = $confirm_password = "";
$email_err = $confirm_email_err = $username_err = $password_err = $confirm_password_err = "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor insira um usuário.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id_prof FROM professores WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Esse usuário já está sendo utilizado.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Algo deu errado. Tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor, insira a senha.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Por favor, confirme a senha.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "As senhas não combinam.";
        }
    }
/*
    // Confirmar emaill
    if(empty($_POST["confirm_email"])){ #antes tava if(empty($_POST["confirm_email"])){ (MOTIVO: ERRO)
        $confirm_email_err = "Por favor, confirme seu e-mail";     
    } else{
        $confirm_email = trim($_POST["confirm_email"]);
        if(empty($email_err) && ($email != $confirm_email)){
            $confirm_email_err = "Os e-mails digitados não conferem.";
        }
    }
    */
    // Check input errors before inserting in database
    /*if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){*/
        
        //pegando as var que faltavam
        $username = $_POST["username"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $escola = $_POST["escola"];
        $whatsapp = $_POST["whatsapp"];
       

        // Prepare an insert statement
        $sql = "INSERT INTO professores (id_prof, username, nome_prof, email_prof, senha_prof, escola_prof, foto_prof_id, whatsapp_prof) VALUES (default, $username, $nome, $email, $password, $escola, default, $whatsapp)";

        if ($link->query($sql) === TRUE) {
            echo "New record created successfully";
          } else {
            echo "Error: " . $sql . "<br>" . $link->error;
          }}

         /*
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_nome, $param_email, $param_password, $param_escola, $param_whatsapp);
            
            //pegando as var que faltavam
            $nome = $_POST["nome"];
            $escola = $_POST["escola"];
            $whatsapp = $_POST["whatsapp"];

            // Set parameters
            $param_username = $username;
            $param_nome = $nome;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_escola = $escola;
            $param_whatsapp = $whatsapp;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Algo deu errado. Tente novamente mais tarde.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}*/
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Criar Conta Professor</h2>
        <p>Preencha o formulário para criar uma conta de professor</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuário</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
                <p>O usuário será usado para fazer login.</p>
            </div>    
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Nome</label>
                <input type="text" name="nome" class="form-control" required="true">
            </div> 
            <div class="form-group">
                <label>Escola</label>
                <input type="text" name="escola" class="form-control">
                <p>Caso não tenha uma escola, deixe <b>vazio.</b></p>
            </div> 
            <div class="form-group">
                <label>WhatsApp (Opcional)</label>
                <input type="tel" name="whatsapp" class="form-control">
            </div> 
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <!--   
                 <div class="form-group <?php# echo (!empty($confirm_email_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar E-mail</label>
                <input type="email" name="confirm_email" class="form-control" value="<?php# echo $confirm_email; ?>">
                <span class="help-block"><?php# echo $confirm_email_err; ?></span>
            </div>-->
        
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Senha</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar Senha</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Criar">
                <input type="reset" class="btn btn-default" value="Resetar">
            </div>
            <p>Já tem uma conta? <a href="login.php">Faça Login aqui.</a>.</p>
        </form>
    </div>    
</body>
</html>