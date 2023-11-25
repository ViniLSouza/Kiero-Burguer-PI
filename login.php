<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIERO BURGUER</title>
    <link rel="stylesheet" type="text/css" href="css/login.css" media="screen"/>
</head>
<script>
    function togglePasswordVisibility() {
        var passwordField = document.getElementById("passwordField");
        if (passwordField.type === "password") {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
    function abrirModal() {
  var modal = document.getElementById('modal');
  modal.style.display = 'block';
}

function fecharModal() {
  var modal = document.getElementById('modal');
  modal.style.display = 'none';
}

// Substitua este trecho pelo código de envio do formulário para recuperar a senha
document.getElementById('formSenha').addEventListener('submit', function(e) {
  e.preventDefault();
  // Aqui você pode adicionar o código para enviar o formulário
  // Por exemplo, usar AJAX para enviar os dados do formulário para o servidor e processar a recuperação da senha
  // Após o envio, você pode exibir uma mensagem de confirmação ou executar outras ações
  alert('Formulário enviado com sucesso!'); // Apenas um exemplo, substitua por sua lógica de envio de formulário real
  fecharModal(); // Fechar o modal após o envio do formulário
});
</script>
<style>
    body{
    background-image: url('imagens/restaurante.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    }
</style>
<body>
    <section class="container">
        <div class="box">
            <a href="index.php" class="ancora">‹ Voltar à página inicial</a>
            <h1 class="name">LOGIN</h1>
            <form action="login.html" method="post" class="login">
                <input type="text" name="username" placeholder="Usuário" required class="barra">
                <input type="password" id="passwordField" name="password" placeholder="Senha" required class="barra senha">
                <button type="button" onclick="togglePasswordVisibility()" class="show">Mostrar Senha</button>
                <input type="submit" value="Entrar" class="botao">
            </form>
            <p>Esqueceu sua senha?<button class="ancora" onclick="abrirModal()">Trocar Senha</button></p>
            <p>Não tem uma conta?<a href="cadastro.html" class="ancora"> Cadastre-se</a></p>
            <p class="noMarg">Kiero Burguer®</p>
        </div>
    </section>
    <div id="modal" class="modal">
        <div class="modal-content">
          <span onclick="fecharModal()" style="float: right; cursor: pointer;" class="fechar">&times;</span>
          <h2>Recuperação de Senha</h2>
          <p>Informe seu e-mail para recuperar sua senha:</p>
          <form id="formSenha">
            <input type="email" id="email" name="email" placeholder="E-mail" required class="barra email">
            <br><br>
            <input type="submit" value="Enviar" class="botao">
          </form>
        </div>
      </div>  
</body>
</html>