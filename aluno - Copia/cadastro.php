<?php
require "Aluno.class.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rm    = $_POST['rm'] ?? '';
    $nome  = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $cpf   = $_POST['cpf'] ?? '';

    $aluno = new Aluno();

    if ($aluno->conectar()) {
        // Verifica se já existe cadastro com esse email
        if ($aluno->consultar($email)) {
            echo "<script>alert('Já existe um aluno cadastrado com esse e-mail.'); window.history.back();</script>";
        } else {
            if ($aluno->cadastrar($rm, $nome, $email, $cpf)) {
                echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='index.html';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar. Tente novamente.'); window.history.back();</script>";
            }
        }
    } else {
        echo "<script>alert('Erro na conexão com o banco de dados.'); window.history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro</title>
  <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
  <div class="container">
    <h2>CADASTRO DE USUARIO</h2>

    <?php if ($mensagem): ?>
      <p style="color: green; font-weight: bold;"><?php echo $mensagem; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
      <div class="form-group">
        <label for="rm">RM:</label>
        <input type="number" placeholder="Seu Numero" id="rm" name="rm" required>
      </div>
      <div class="form-group">
        <label for="cpf">CPF:</label>
        <input type="number" placeholder="Seu CPF" id="cpf" name="cpf" required>
      </div>
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" placeholder="Seu nome" id="nome" name="nome" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" placeholder="Seu gmail" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" placeholder="Sua senha" id="senha" name="senha" required>
      </div>
      <button type="submit" class="btn">CADASTRAR</button>
    </form>
  </div>
</body>
</html>

