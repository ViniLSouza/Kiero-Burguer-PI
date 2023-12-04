<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIERO BURGUER</title>
    <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/perfil.css" media="screen" />
</head>
<style>
    body {
        background-image: url('imagens/parede-de-concreto.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
    }
</style>

<body>
    <header>
        <div class="logoH">
            <img src="imagens/logo.png" class="logoN">
        </div>
        <ul class="nav">
            <li class="itemN"><a href="index.html" class="name">Home</a></li>
            <li class="itemN item"><a href="pedidos.html" class="name">Pedidos</a></li>
            <li class="itemN"><a href="peça.html" class="name">Peça aqui</a></li>
        </ul>
        <div class="loginH">
            <a href="login.html" class="login">LOGIN</a>
        </div>
    </header>
    <div class="cadB">
        <h1 class="cad">Meu perfil</h1>
    </div>
    <form action="cadastro.html" method="post"
        onsubmit="return validarNome() && validarUsuario() && validarEmail() && validarSenha() && validarCPF(document.getElementById('numero').value)">
        <input placeholder="Puff2002" type="text" id="username" name="username" class="barra duo">

        <input placeholder="Vinicius Luciano de Souza" type="text" id="nome" name="nome" class="barra duo">

        <input placeholder="viniciuslu1@hotmail.com" type="email" id="email" name="email" class="barra all">

        <input placeholder="Digite sua senha" type="password" id="confirmarSenha" name="senha" class="barra all">

        <input placeholder="Nova senha" type="password" id="senha" name="senha" class="barra duo">

        <input placeholder="Confirme sua nova senha" type="password" id="confirmarSenha" name="senha" class="barra duo">

        <input placeholder="10240164989" type="text" id="numero" name="numero" maxlength="11" pattern="[0-9]*"
            oninput="this.value = this.value.replace(/\D/g, '')" class="barra">

        <input placeholder="80230080" type="text" id="cep" name="cep" maxlength="8" pattern="[0-9]*"
            oninput="this.value = this.value.replace(/\D/g, '')" onblur="buscarCep()" class="barra">

        <input placeholder="Rua Vinte e Quatro de Maio" type="text" id="logradouro" name="logradouro" class="barra">

        <input placeholder="420" type="text" id="numero" name="numero" pattern="[0-9]*"
            oninput="this.value = this.value.replace(/\D/g, '')" class="barra">

        <input placeholder="Apto 101" type="text" id="complemento" name="complemento" class="barra">

        <input placeholder="Centro" type="text" id="bairro" name="bairro" class="barra">

        <input placeholder="Curitiba" type="text" id="cidade" name="cidade" disabled class="barra">

        <input placeholder="PR" type="text" id="estado" name="estado" disabled class="barra">

        <input type="submit" value="Atualizar" class="botao">
    </form>
    <footer>
        <p class="textoF">Kiero Burguer®</p>
        <p class="textoF dev">Desenvolvido por:</p>
        <div class="devs">
            <p class="textoF devs">Gabriel Gevezier</p>
            <p class="textoF devs">Hemily Batista</p>
            <p class="textoF devs">Luana Peracini</p>
            <p class="textoF devs">Vinicius Luciano</p>
            <p class="textoF devs">Wesley Scolaro</p>
        </div>
    </footer>
</body>

</html>