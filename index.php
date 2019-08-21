<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JobProgramathions</title>

    <link rel="stylesheet" href="estilo.css">
    <link rel="stylesheet" type="text/css" href="bootstrap.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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

    <h1 style="margin-top: 1%">Descubra as informações de seu IP:</h1>

    <div id="input">
        <form method="post" id="formulario">
                <input type="number" name="primeiroOcteto" id="pri" class=" inputs">.
                <input type="number" name="segundoOcteto" id="seg" class=" inputs">.
                <input type="number" name="terceiroOcteto" id="ter" class=" inputs">.
                <input type="number" name="ultimoOcteto" id="ult" class=" inputs">/
                <input type="number" min="24" max="32" name="mascara" id="mascara">
                <input type="button" id="botao" value="enviar">
        </form>
    </div>
    <br>
    <div id="conteudo">
        



        
    </div>

</body>
</html>