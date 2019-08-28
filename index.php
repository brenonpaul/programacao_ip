<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculadora IP</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#botao").click(function () {
                var pri = $('#pri').val();
                var seg = $('#seg').val();
                var ter = $('#ter').val();
                var qua = $('#ult').val();
                var mas = $('#mascara').val();
                $.post("functions.php",
                {
                    primeiroOcteto : pri, segundoOcteto : seg, terceiroOcteto : ter, ultimoOcteto : qua, mascara : mas
                },
                function (data) {
                    $("#conteudo").html(data);
                });
            });
        });
    </script>
</head>
<body id="body">

    <h1 style="margin-top: 1%">Descubra as informações de seu IP(barramento 24 ao 32):</h1>

    <div id="input">
        <form method="post" id="formulario">
            <input type="number" name="primeiroOcteto" id="pri" class=" inputs"><b>.</b>
            <input type="number" name="segundoOcteto" id="seg" class=" inputs"><b>.</b>
            <input type="number" name="terceiroOcteto" id="ter" class=" inputs"><b>.</b>
            <input type="number" name="ultimoOcteto" id="ult" class=" inputs"><b style="font-size: 20px">/</b>
            <input type="number" min="24" max="32" name="mascara" id="mascara">
            <input type="button" id="botao" value="enviar">
        </form>
    </div>
    <br>
    <div id="conteudo">
    </div>
</body>
</html>
