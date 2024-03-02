<?php
if (isset($_POST['submit'])) {
    // Inclua o arquivo de configuração do banco de dados
    include_once('config.php');

    // Obtenha os dados do formulário
    $nome = $_POST['nome'];
    $data_nasc = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $mensagem = $_POST['message'];

    // Evite a injeção SQL usando declarações preparadas
    $query = "INSERT INTO usuarios (nome, data_nasc, telefone, email, mensagem) 
              VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($query);
    $stmt->bind_param("sssss", $nome, $data_nasc, $telefone, $email, $mensagem);
    
    // Execute a consulta
    if ($stmt->execute()) {
        // Inserção bem-sucedida
        $mensagem_sucesso = "Dados inseridos com sucesso!";
    } else {
        // Erro na inserção
        $mensagem_erro = "Erro ao inserir os dados no banco de dados.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Formulário</title>
<meta http-equiv="x-ua-compatible" content="IE=edge">
<link rel="stylesheet" href="style/formulario.css">
</head>
<body>
  <nav id="menu">
    <ul>
        <li><a href="http://localhost/setembroamarelo2/index.html">Home</a></li>
        <li><a href="https://www.youtube.com/watch?v=4wZUTpTupeo">Música</a></li>
        <li><a href="http://localhost/setembroamarelo2/relato.html">Relato</a></li>
        <li><a href="https://www.setembroamarelo.com/">Site oficial</a></li>
        <li><a href="http://localhost/setembroamarelo2/formulario.php">Fale Conosco</a></li>
    </ul>
</nav>
  <div class="container">
    <br>
    <h1>Seja bem-vindo(a)!</h1>
    <p>Preencha o formulário abaixo se você precisa de ajuda.</p>
  
    <form id="formulario" action="formulario.php" method="POST">
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
      </div>
      <div class="form-group">
        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>
      </div>
      <div class="form-group">
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>
        <div id="telefoneErro" class="error-message">  
        </div>
      </div>
      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="message">Mensagem:</label>
        <textarea id="message" name="message" rows="4" required></textarea>
      </div>
      <div class="form-group">
        <button type="submit" name="submit" onclick="js_submitForm()">Enviar</button>
      </div>
    </form> 
    <?php
    // Exibir mensagens de sucesso ou erro
    if (isset($mensagem_sucesso)) {
        echo '<div class="success-message">' . $mensagem_sucesso . '</div>';
    } elseif (isset($mensagem_erro)) {
        echo '<div class="error-message">' . $mensagem_erro . '</div>';
    }
    ?>
  </div>
</body>

<footer id="rodape">
    <ul>
      <li>PRODABEL</li>
      <li>Projeto / Curso Programação Web</li>
      <li>Programando Sonhos!</li>
      <li>Aluna: Maysa Santos   E-mail: maysaysa29@gmail.com</li>   
    </ul>
</footer>
</html>
