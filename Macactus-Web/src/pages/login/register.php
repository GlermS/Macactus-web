<html>
<body>




<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";



// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
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
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
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
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuário</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmar E-mail</label>
                <input type="email" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
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
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>




<!--

- Você é professor ou aluno?
Login Prof
Login Aluno
(checkbox)


Ainda não tem uma conta?
Botão criar conta

{fazer um div login e usar pro js fazer inner html}
<h2>Criar uma conta de Prof</h2>
    <form action="criarprof.php" method="post">
        Nome: <input type="text" placeholder="Seu nome aqui" required="true" name="nome" value="<?php $_POST['nome'] ?>">
        Sobrenome: <input type="text" placeholder="Seu sobrenome aqui" required="true" name="sobrenome">
        Email:<input type="email" placeholder="exemplo@exemplo.com" required="true" name="email1">
        Confirmar Email:<input type="email" placeholder="exemplo@exemplo.com" required="true" name="email2">

        Telefone: <input type="tel" name="cTelefone" id="telefone">
        Senha:<input type="password" placeholder="********" required="true">
        Confirmar Senha: <input type="password" placeholder="********" required="true">
        País: 
<select name=Pais>
    <option value="África do Sul">África do Sul</option>
    <option value="Albânia">Albânia</option>
    <option value="Alemanha">Alemanha</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Anguilla">Anguilla</option>
    <option value="Antigua">Antigua</option>
    <option value="Arábia Saudita">Arábia Saudita</option>
    <option value="Argentina">Argentina</option>
    <option value="Armênia">Armênia</option>
    <option value="Aruba">Aruba</option>
    <option value="Austrália">Austrália</option>
    <option value="Áustria">Áustria</option>
    <option value="Azerbaijão">Azerbaijão</option>
    <option value="Bahamas">Bahamas</option>
    <option value="Bahrein">Bahrein</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Barbados">Barbados</option>
    <option value="Bélgica">Bélgica</option>
    <option value="Benin">Benin</option>
    <option value="Bermudas">Bermudas</option>
    <option value="Botsuana">Botsuana</option>
    <option value="Brasil" selected>Brasil</option>
    <option value="Brunei">Brunei</option>
    <option value="Bulgária">Bulgária</option>
    <option value="Burkina Fasso">Burkina Fasso</option>
    <option value="botão">botão</option>
    <option value="Cabo Verde">Cabo Verde</option>
    <option value="Camarões">Camarões</option>
    <option value="Camboja">Camboja</option>
    <option value="Canadá">Canadá</option>
    <option value="Cazaquistão">Cazaquistão</option>
    <option value="Chade">Chade</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Cidade do Vaticano">Cidade do Vaticano</option>
    <option value="Colômbia">Colômbia</option>
    <option value="Congo">Congo</option>
    <option value="Coréia do Sul">Coréia do Sul</option>
    <option value="Costa do Marfim">Costa do Marfim</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Croácia">Croácia</option>
    <option value="Dinamarca">Dinamarca</option>
    <option value="Djibuti">Djibuti</option>
    <option value="Dominica">Dominica</option>
    <option value="EUA">EUA</option>
    <option value="Egito">Egito</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Emirados Árabes">Emirados Árabes</option>
    <option value="Equador">Equador</option>
    <option value="Eritréia">Eritréia</option>
    <option value="Escócia">Escócia</option>
    <option value="Eslováquia">Eslováquia</option>
    <option value="Eslovênia">Eslovênia</option>
    <option value="Espanha">Espanha</option>
    <option value="Estônia">Estônia</option>
    <option value="Etiópia">Etiópia</option>
    <option value="Fiji">Fiji</option>
    <option value="Filipinas">Filipinas</option>
    <option value="Finlândia">Finlândia</option>
    <option value="França">França</option>
    <option value="Gabão">Gabão</option>
    <option value="Gâmbia">Gâmbia</option>
    <option value="Gana">Gana</option>
    <option value="Geórgia">Geórgia</option>
    <option value="Gibraltar">Gibraltar</option>
    <option value="Granada">Granada</option>
    <option value="Grécia">Grécia</option>
    <option value="Guadalupe">Guadalupe</option>
    <option value="Guam">Guam</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guiana">Guiana</option>
    <option value="Guiana Francesa">Guiana Francesa</option>
    <option value="Guiné-bissau">Guiné-bissau</option>
    <option value="Haiti">Haiti</option>
    <option value="Holanda">Holanda</option>
    <option value="Honduras">Honduras</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Hungria">Hungria</option>
    <option value="Iêmen">Iêmen</option>
    <option value="Ilhas Cayman">Ilhas Cayman</option>
    <option value="Ilhas Cook">Ilhas Cook</option>
    <option value="Ilhas Curaçao">Ilhas Curaçao</option>
    <option value="Ilhas Marshall">Ilhas Marshall</option>
    <option value="Ilhas Turks & Caicos">Ilhas Turks & Caicos</option>
    <option value="Ilhas Virgens (brit.)">Ilhas Virgens (brit.)</option>
    <option value="Ilhas Virgens(amer.)">Ilhas Virgens(amer.)</option>
    <option value="Ilhas Wallis e Futuna">Ilhas Wallis e Futuna</option>
    <option value="Índia">Índia</option>
    <option value="Indonésia">Indonésia</option>
    <option value="Inglaterra">Inglaterra</option>
    <option value="Irlanda">Irlanda</option>
    <option value="Islândia">Islândia</option>
    <option value="Israel">Israel</option>
    <option value="Itália">Itália</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japão">Japão</option>
    <option value="Jordânia">Jordânia</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Latvia">Latvia</option>
    <option value="Líbano">Líbano</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lituânia">Lituânia</option>
    <option value="Luxemburgo">Luxemburgo</option>
    <option value="Macau">Macau</option>
    <option value="Macedônia">Macedônia</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malásia">Malásia</option>
    <option value="Malaui">Malaui</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marrocos">Marrocos</option>
    <option value="Martinica">Martinica</option>
    <option value="Mauritânia">Mauritânia</option>
    <option value="Mauritius">Mauritius</option>
    <option value="México">México</option>
    <option value="Moldova">Moldova</option>
    <option value="Mônaco">Mônaco</option>
    <option value="Montserrat">Montserrat</option>
    <option value="Nepal">Nepal</option>
    <option value="Nicarágua">Nicarágua</option>
    <option value="Niger">Niger</option>
    <option value="Nigéria">Nigéria</option>
    <option value="Noruega">Noruega</option>
    <option value="Nova Caledônia">Nova Caledônia</option>
    <option value="Nova Zelândia">Nova Zelândia</option>
    <option value="Omã">Omã</option>
    <option value="Palau">Palau</option>
    <option value="Panamá">Panamá</option>
    <option value="Papua-nova Guiné">Papua-nova Guiné</option>
    <option value="Paquistão">Paquistão</option>
    <option value="Peru">Peru</option>
    <option value="Polinésia Francesa">Polinésia Francesa</option>
    <option value="Polônia">Polônia</option>
    <option value="Porto Rico">Porto Rico</option>
    <option value="Portugal">Portugal</option>
    <option value="Qatar">Qatar</option>
    <option value="Quênia">Quênia</option>
    <option value="Rep. Dominicana">Rep. Dominicana</option>
    <option value="Rep. Tcheca">Rep. Tcheca</option>
    <option value="Reunion">Reunion</option>
    <option value="Romênia">Romênia</option>
    <option value="Ruanda">Ruanda</option>
    <option value="Rússia">Rússia</option>
    <option value="Saipan">Saipan</option>
    <option value="Samoa Americana">Samoa Americana</option>
    <option value="Senegal">Senegal</option>
    <option value="Serra Leone">Serra Leone</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Singapura">Singapura</option>
    <option value="Síria">Síria</option>
    <option value="Sri Lanka">Sri Lanka</option>
    <option value="St. Kitts & Nevis">St. Kitts & Nevis</option>
    <option value="St. Lúcia">St. Lúcia</option>
    <option value="St. Vincent">St. Vincent</option>
    <option value="Sudão">Sudão</option>
    <option value="Suécia">Suécia</option>
    <option value="Suiça">Suiça</option>
    <option value="Suriname">Suriname</option>
    <option value="Tailândia">Tailândia</option>
    <option value="Taiwan">Taiwan</option>
    <option value="Tanzânia">Tanzânia</option>
    <option value="Togo">Togo</option>
    <option value="Trinidad & Tobago">Trinidad & Tobago</option>
    <option value="Tunísia">Tunísia</option>
    <option value="Turquia">Turquia</option>
    <option value="Ucrânia">Ucrânia</option>
    <option value="Uganda">Uganda</option>
    <option value="Uruguai">Uruguai</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnã">Vietnã</option>
    <option value="Zaire">Zaire</option>
    <option value="Zâmbia">Zâmbia</option>
    <option value="Zimbábue">Zimbábue</option>
</select>

        Cidade: <input type="text" name="" id="cidade" required="true">
        Sua matéria principal: 
        <select name="cMaterias" id="materias">
            <optgroup name=Materias>
                <option value="Matemática" selected>Matemática</option>
                <option value="Potuguês">Potuguês</option>
                <option value="História">História</option>
                <option value="Filosofia">Filosofia</option>
                <option value="Religião">Religião</option>
                <option value="Música">Música</option>
                <option value="Arte">Arte</option>
                <option value="Literatura">Literatura</option>
                <option value="Ed.Física">Ed.Física</option>
                <option value="Física">Física</option>
                <option value="Música">Música</option>
                <option value="Ciências">Ciências</option>
                <option value="Informática">Informática</option>
                <option value="Química">Química</option>
                <option value="Biologia">Biologia</option>
                <option value="Outro">Outro</option>
            </optgroup>
        </select>
        
        <br>
        se selecionado = outro, caixa de texto required p escrever 
        <br>
        
        Escola: <input type="text" name="cEscola" id="escola">
        Sua identidade: 
        <input type="file" name="cID" id="ID">
            (pedimos uma prova de identidade para garantir a segurança dos alunos e dos outros professores)

        <input type="checkbox" id="termos" name="cTermos" required="true"><label for="termos">Concordo com os <a href="">Termos e Condições de uso</a><p id="ob">*</p>
        
        </label for="termos" id="conf" name="cConf" required="true">Concordo com a <a href="">Política de Confidencialidade</a><p id="ob">*</p></label>

        <input type="checkbox" id="noticias" name="cNoticias"><label for="noticias">Desejo receber novidades e notícias da Macactus por e-mail.</label>
        <br>

        ReCaptcha
        <input type="submit" !!!!!!content="criar conta">
    </form>

    Ao enviar: Obrigado, enviaremos um email de confirmação.
    Após a confirmação seus documentos serão analizados por nossa equipe



    Já tem uma conta?
    <form action="" method="post">
        Email:<input type="email" placeholder="exemplo@exemplo.com" required="true">
        Senha:<input type="password" placeholder="********" required="true">
        <br>
        ReCaptcha 
        <input type="checkbox" name="cLembrar" id="lembrar"><label for="lembrar">Lembrar de mim</label>
        <input type="submit">
        
    </form>
</div>-->
    



