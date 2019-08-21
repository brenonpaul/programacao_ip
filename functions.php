<?php

$primeiroOcteto = $_POST['primeiroOcteto'];
$segundoOcteto = $_POST['segundoOcteto'];
$terceiroOcteto = $_POST['terceiroOcteto'];
$ultimoOcteto = $_POST['ultimoOcteto'];
$mascara = $_POST['mascara'];
$bits = 32 - $mascara;

function calculos($mascara, $primeiroOcteto, $segundoOcteto, $terceiroOcteto, $ultimoOcteto, $bits)
{
	$ip = $primeiroOcteto.".".$segundoOcteto.".".$terceiroOcteto.".".$ultimoOcteto."/".$mascara;

	$mascaradecimal = 256 - pow(2, $bits);
	$mascaraA = "255.255.255." . $mascaradecimal;
        //mascara de sub-rede definida

	$intervalo = 256 - $mascaradecimal;
	$qntdsubrede = 256 / $intervalo;
        //quantidade subredes definida

	$qntendsubrede = $intervalo;
        //quantidade de endereços por subrede definida

	$hosts = $qntendsubrede - 2;
        //quantidade hosts por subredes definida

        //classe que o ip pertence
	if ($primeiroOcteto <= 126 and $primeiroOcteto >= 1) {
		$classe = "Classe A";
		if ($primeiroOcteto == 10) {
			$o = "Privado";
		} else {
			$o = "Público";
		}

	} elseif ($primeiroOcteto <= 191 and $primeiroOcteto >= 128) {
		$classe = "Classe B";
		if ($primeiroOcteto == 172 and $segundoOcteto >= 16 and $segundoOcteto <= 31) {
			$o = "Privado";
		} else {
			$o = "Público";
		}
	} elseif ($primeiroOcteto <= 223 and $primeiroOcteto >= 192) {
		$classe = "Classe C";
		if ($primeiroOcteto == 192 and $segundoOcteto == 168) {
			$o = "Privado";
		} else {
			$o = "Público";
		}
	} elseif ($primeiroOcteto <= 239 and $primeiroOcteto >= 224) {
		$classe = "Classe D";
		$o = "Público";
	} elseif ($primeiroOcteto <= 255 and $primeiroOcteto >= 240) {
		$classe = "Classe E";
		$o = "Público";
	}

	if ($primeiroOcteto>255 or $segundoOcteto>255 or $terceiroOcteto>255 or$ultimoOcteto>255 or $mascara> 32) {
		echo "<h1 style='color: red; border: none'>Ip Inválido</h1>";
	}else{

		echo "<p><strong> Quantidade de subredes:</strong> $qntdsubrede</p>";
		echo "<p><strong>Quantidade de hosts em cada subrede:</strong> $hosts </p>";
		for ($i=1; $i <= $qntdsubrede ; $i++) { 
			$enderecosRede = -$intervalo*$i;
			$enderecosRede = $intervalo - $intervalo * $i;
			$enderecosRede = $enderecosRede *-1;
			$cont = $i;
			$enderecosBroad = $intervalo * $i -1;
			$primeirosHosts = $enderecosRede +1;
			$ultimosHost = $enderecosBroad -1;
			$ipInformado = $ip;

			if ($enderecosRede < $ultimoOcteto and $ultimoOcteto < $enderecosBroad) {
				echo "<p><strong> $cont ° subrede:</strong></p>";
				echo "<p><u>rede:</u><strong> $primeiroOcteto.$segundoOcteto.$terceiroOcteto.$enderecosRede/$mascara</strong></p>";
				echo "<p><u>broadcast:</u><strong> $primeiroOcteto. $segundoOcteto.$terceiroOcteto.$enderecosBroad/$mascara</strong></p>";
				echo "<p><u>primeiro host:</u><strong> $primeiroOcteto.$segundoOcteto.$terceiroOcteto.$primeirosHosts/$mascara</strong></p>";
				echo "<p><u>último host:</u><strong> $primeiroOcteto.$segundoOcteto.$terceiroOcteto.$ultimosHost/$mascara</strong></p>";
			}else{
				echo "<p><strong> $cont ° subrede:</strong></p>";
				echo "<p><u>rede:</u> $primeiroOcteto.$segundoOcteto.$terceiroOcteto.$enderecosRede/$mascara</p>";
				echo "<p><u>broadcast:</u> $primeiroOcteto. $segundoOcteto.$terceiroOcteto.$enderecosBroad/$mascara</p>";
				echo "<p><u>primeiro host:</u> $primeiroOcteto.$segundoOcteto.$terceiroOcteto.$primeirosHosts/$mascara </p>";
				echo "<p><u>último host:</u> $primeiroOcteto.$segundoOcteto.$terceiroOcteto.$ultimosHost/$mascara </p>";
			}

		}

		echo "<p><strong>Máscara decimal:</strong> $mascaraA</p>";
		echo "<p><strong>Classe da rede:</strong> $classe</strong></p>";
		echo "<p><strong>Ip de rede:</strong> ". $o. "</p>";

	}

}

calculos($mascara,$primeiroOcteto,$segundoOcteto, $terceiroOcteto, $ultimoOcteto, $bits);