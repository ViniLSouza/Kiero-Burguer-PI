<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIERO BURGUER</title>
    <link rel="stylesheet" type="text/css" href="css/header.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/cadastro.css" media="screen" />
</head>
<style>
    @media screen and (max-width: 1450px) {
        form {
            display: block;
            padding-inline: 0;
        }
    }
    @media screen and (max-width: 620px) {
        form {
            margin: 0;
        }
        .cadB {
           padding-inline: 0;
        }
    }
    
@media screen and (max-width: 750px) {
    header{
        display: block;
    }
    .logoH{
        justify-content: center;
    }
    .itemN{
        margin-inline: 0;
    }
    .item{
        margin-inline: 1em;
    }
    header{
        padding: 1em;
    }
    .loginH{
        justify-content: center;
    }
    .login{
        font-size: 15px;
        width: 100%;
        text-align: center;
    }
}

@media screen and (max-width: 1050px) {
    .devs{
        display: block;
        font-size: 15px;
    }
}
    
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function buscarCep() {
        var cep = document.getElementById('cep').value.replace('-', '');

        if (cep.length === 8) {
            $.getJSON(`https://viacep.com.br/ws/${cep}/json/`, function(data) {
                if (!data.erro) {
                    document.getElementById('logradouro').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                } else {
                    alert('CEP não encontrado');
                }
            });
        }
    }



    function validarSenha() {
        var senha = document.getElementById("senha").value;
        var confirmarSenha = document.getElementById("confirmarSenha").value;

        if (senha !== confirmarSenha) {
            alert("As senhas são diferentes!");
            return false;
        }

        return true;
    }



    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]+/g, '');
        if (cpf.length !== 11 || /^(.)\1+$/.test(cpf)) {
            alert('CPF inválido!');
            return false;
        }

        var digitoVerificador = cpf.substring(9, 11);
        var soma = 0;
        for (var i = 0; i < 9; i++) {
            soma += parseInt(cpf.charAt(i)) * (10 - i);
        }

        var resto = soma % 11;
        var primeiroDigito = (resto < 2) ? 0 : 11 - resto;

        if (primeiroDigito != parseInt(cpf.charAt(9))) {
            alert('CPF inválido!');
            return false;
        }

        soma = 0;
        for (var i = 0; i < 10; i++) {
            soma += parseInt(cpf.charAt(i)) * (11 - i);
        }

        resto = soma % 11;
        var segundoDigito = (resto < 2) ? 0 : 11 - resto;

        if (segundoDigito != parseInt(cpf.charAt(10))) {
            alert('CPF inválido!');
            return false;
        }

        return true;
    }



    function validarNome() {
        var nome = document.getElementById("nome").value;

        if (!/\s/.test(nome)) {
            alert("Favor digitar Nome e Sobrenome!");
            return false;
        }

        return true;
    }



    function validarUsuario() {
        var username = document.getElementById("username").value;

        if (/\s/.test(username)) {
            alert("O nome de usuário não deve conter espaços!");
            return false;
        }

        return true;
    }



    function validarEmail() {
        var email = document.getElementById("email").value;
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            alert("E-mail inválido!");
            return false;
        }

        return true;
    }
</script>
<style>
    body {
        background-image: url('imagens/parede-de-concreto.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: repeat;
    }

    form {
        background-image: url(imagens/background.jpg);
    }
</style>

<body>
    <header>
        <div class="logoH">
        <a href="index.php"><img src="imagens/logo.png" class="logoN"></a>
        </div>
        <ul class="nav">
            <li class="itemN"><a href="index.php" class="name">Home</a></li>
            <li class="itemN item"><a href="pedidos.php" class="name">Pedidos</a></li>
            <li class="itemN"><a href="carrinho.php" class="name">Peça aqui</a></li>
        </ul>
        <div class="loginH">
            <a href="login.html" class="login">LOGIN</a>
        </div>
    </header>

    <div class="cadB">
        <h1 class="cad">Cadastre-se</h1>
    </div>

    <form action="cadastro.php" method="post" onsubmit="return validarNome() && validarUsuario() && validarEmail() && validarSenha() && validarCPF(document.getElementById('numero').value)">

        <input placeholder="Usuário" type="text" id="username" name="username" required class="barra duo">

        <input placeholder="Nome" type="text" id="nome" name="nome" required class="barra duo">

        <input placeholder="E-mail" type="email" id="email" name="email" required class="barra all">

        <input placeholder="Senha" type="password" id="senha" name="senha" required class="barra duo">

        <input placeholder="Confirme sua senha" type="password" id="confirmarSenha" name="confirmsenha" required class="barra duo">

        <input placeholder="CPF" type="text" id="numero" name="numero" maxlength="11" pattern="[0-9]*" required oninput="this.value = this.value.replace(/\D/g, '')" class="barra">

        <input placeholder="CEP" type="text" id="cep" name="cep" maxlength="8" pattern="[0-9]*" required oninput="this.value = this.value.replace(/\D/g, '')" onblur="buscarCep()" class="barra">

        <input placeholder="Logradouro" type="text" id="logradouro" name="logradouro" required class="barra">

        <input placeholder="Número" type="text" id="num" name="num" pattern="[0-9]*" required oninput="this.value = this.value.replace(/\D/g, '')" class="barra">

        <input placeholder="Complemento" type="text" id="complemento" name="complemento" required class="barra">

        <input placeholder="Bairro" type="text" id="bairro" name="bairro" required class="barra">

        <input placeholder="Cidade" type="text" id="cidade" name="cidade" required readonly class="barra">

        <input placeholder="Estado" type="text" id="estado" name="estado" required readonly class="barra">

        <input type="submit" value="Cadastrar" name="Cadastrar" class="botao">

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

<?php

include "conn.php";

if (isset($_POST['Cadastrar'])) {
    $username = $_POST['username'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['numero'];
    $cep = $_POST['cep'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['num'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];


    $grava = $conn->prepare('INSERT INTO `tbl_login` (`ID_Login`, `User_Login`, `Nome_Login`, `Email_Login`, `Senha_Login`, `CPF_Login`, `CEP_Login`, `Logradouro_Login`, `Numero_Login`, `Complemento_Login`, `Bairro_Login`, `Cidade_Login`, `Estado_Login`, `Tipo_Usuario`) VALUES (NULL, :pusername, :pnome, :pemail, :psenha, :pcpf, :pcep, :plogradouro, :pnumero, :pcomplemento, :pbairro, :pcidade, :pestado, 0);');


    $grava->bindValue(':pusername', $username);
    $grava->bindValue(':pnome', $nome);
    $grava->bindValue(':pemail', $email);
    $grava->bindValue(':psenha', $senha);
    $grava->bindValue(':pcpf', $cpf);
    $grava->bindValue(':pcep', $cep);
    $grava->bindValue(':plogradouro', $logradouro);
    $grava->bindValue(':pnumero', $numero);
    $grava->bindValue(':pcomplemento', $complemento);
    $grava->bindValue(':pbairro', $bairro);
    $grava->bindValue(':pcidade', $cidade);
    $grava->bindValue(':pestado', $estado);

    $grava->execute();

    echo "gravado";
}
?>