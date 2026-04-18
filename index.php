<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = $_POST['nome'] ?? '';
    $dataNascimento = $_POST['data-nascimento'] ?? '';

    if (empty($nome) || empty($dataNascimento)) {
        echo "<div class='alert alert-danger'>Preencha todos os campos!</div>";
        exit;
    }

    try {
        $data = new DateTime($dataNascimento);
        $hoje = new DateTime();
        $idade = $hoje->diff($data)->y;

        $classificacao = ($idade >= 18) ? "Maior de idade" : "Menor de idade";

        echo "
            <div class='resultado-box'>
                <h5>Resultado</h5>
                <p><strong>Nome:</strong> $nome</p>
                <p><strong>Idade:</strong> $idade anos</p>
                <p><strong>Classificação:</strong> $classificacao</p>
            </div>
        ";
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Data inválida!</div>";
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>AgeSystem</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body {
    margin: 0;
    height: 100vh;
    font-family: Arial, sans-serif;
    display: flex;
}

.lado-info {
    width: 50%;
    background: linear-gradient(135deg, #7b2ff7, #f107a3);
    color: white;
    padding: 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.lado-info h1 {
    font-size: 36px;
    margin-bottom: 10px;
}

.lado-info p {
    font-size: 16px;
    opacity: 0.9;
}

.lado-form {
    width: 50%;
    background: #f4f4f4;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-custom {
    background: white;
    padding: 30px;
    border-radius: 15px;
    width: 100%;
    max-width: 350px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.form-control {
    border: none;
    border-bottom: 2px solid #ccc;
    border-radius: 0;
    margin-bottom: 15px;
}

.form-control:focus {
    box-shadow: none;
    border-color: #7b2ff7;
}

.btn-custom {
    width: 100%;
    background: linear-gradient(45deg, #7b2ff7, #f107a3);
    border: none;
    color: white;
    padding: 10px;
    border-radius: 25px;
}

.btn-custom:hover {
    opacity: 0.9;
}

.resultado-box {
    margin-top: 15px;
    padding: 15px;
    border-radius: 10px;
    background: #f1f1f1;
}

.rodape {
    position: fixed;
    bottom: 0;
    width: 100%;
    padding: 10px;
    font-size: 13px;
    color: white;
  
}


@media(max-width: 768px){
    body {
        flex-direction: column;
    }

    .lado-info, .lado-form {
        width: 100%;
    }
}

</style>
</head>

<body>

<div class="lado-info">
    <h1>Descubra sua idade com o AgeSystem.</h1>
    <p>Este site permite calcular a sua idade real em segundos apenas colocando o seu nome e data de nascimento,
        tendo também a função de dizer se é maior ou menor de idade!
    </p>
</div>

<div class="lado-form">
    <div class="card-custom">

        <h4 class="text-center mb-3">AgeSystem</h4>
        <p class="text-center text-muted">O melhor verificador de idade!</p>

        <form id="formulario">
            <input type="text" id="nome" name="nome" class="form-control" placeholder="Seu nome">

            <input type="date" id="data-nascimento" name="data-nascimento" class="form-control">

            <button type="submit" class="btn btn-custom">Calcular</button>
        </form>

        <div id="resultado"></div>

    </div>
</div>

<footer class="rodape">
    <p>Site postado no meu GitHub - @Larissa-Pereira-Rodrigues</p>

</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$(document).ready(function(){

    $("#formulario").on("submit", function(event){
        event.preventDefault();

        let nome = $("#nome").val();
        let dataNascimento = $("#data-nascimento").val();

        if(nome === "" || dataNascimento === ""){
            $("#resultado").html("<div class='alert alert-danger'>Preencha todos os campos!</div>");
            return;
        }

        if(nome.length < 3){
            $("#resultado").html("<div class='alert alert-warning'>Nome muito curto</div>");
            return;
        }

        $.ajax({
            url: "",
            method: "POST",
            data: {
                nome: nome,
                "data-nascimento": dataNascimento
            },
            success: function(resposta){
                $("#resultado").html(resposta);
            }
        });
    });

});
</script>

</body>
</html>