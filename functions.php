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

	$subrede = (int)($ultimoOcteto / $intervalo);
        //subrede que o ip se encontra

	$primeiroEnderecoRede = $subrede * $intervalo;

	$prihost = $primeiroEnderecoRede + 1;
	$primeirohost = $primeiroOcteto. "." . $segundoOcteto . "." . $terceiroOcteto . "." . $prihost . "/" . $mascara;
        //primeiro endereço de host da subrede

	$broadcast = $primeiroEnderecoRede + $intervalo - 1;
	$ipbroadcast = $primeiroOcteto. "." . $segundoOcteto . "." . $terceiroOcteto . "." . $broadcast . "/" . $mascara;
        //endereço BroadCast

	$IpEnderecoDeRede = $primeiroOcteto. "." . $segundoOcteto . "." . $terceiroOcteto . "." . $primeiroEnderecoRede . "/" . $mascara;
        //endereço de Rede

	$ulthost = ($broadcast - 1);
	$ultimohost = $primeiroOcteto. "." . $segundoOcteto . "." . $terceiroOcteto . "." . $ulthost . "/" . $mascara;
        //ultimo endereço host da subrede


        //broadcast da subrede

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

	echo "<p><strong> Quantidade de subredes:</strong> $qntdsubrede</p>";
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

	echo "<p><strong>Quantidade de hosts em cada subrede:</strong> $hosts </p>";
	echo "<p><strong>Máscara decimal:</strong> $mascaraA</p>";
	echo "<p><strong>Classe da rede:</strong> $classe</strong></p>";
	echo "<p><strong>Ip de rede:</strong> ". $o. "</p>";
	
	
	/*echo "<p>A rede possui $qntendsubrede endereços por subrede </p>";
	echo "<p>A rede possui o $primeirohost como primeiro host </p>";
	echo "<p>A rede possui o $ultimohost como ultimo host </p>";
	
	
	echo "<p>Endereços Disponíveis:</p>";

	
	
	

	$enderecoRede = $qntdsubrede * $intervalo -1;
	echo "broadcast $enderecoRede";



	if ($mascara == 24) {

		for ($i=1; $i < $intervalo-1 ; $i++) { 
			$Iphosts= $primeiroOcteto. "." . $segundoOcteto . "." . $terceiroOcteto . "." . $i . "/" . $mascara;

			if ($ip == $Iphosts) {
				echo "<p><strong>$Iphosts</strong></p>";
			}else{
				echo"<p>$Iphosts</p>";
			}
		}

	/*

	}elseif ($mascara == 25) {
		for ($j= 1; $j <= 1 ; $j++) {
			for ($i=1; $i < $limite = ($intervalo -1); $i++) { 
				$Iphosts= $primeiroOcteto. "." . $segundoOcteto . "." . $terceiroOcteto . "." . $i . "/" . $mascara;
				if ($ip == $Iphosts) {
					echo "<p><strong>$Iphosts</strong></p>";
				}else{
					echo"<p>$Iphosts</p>";
				}
			}
		}
		for ($j= 1; $j <= 1 ; $j++) { 
			for ($i=129; $i < ($qntdsubrede * $intervalo -1); $i++) { 
				$Iphosts= $primeiroOcteto. "." . $segundoOcteto . "." . $terceiroOcteto . "." . $i . "/" . $mascara;
				if ($ip == $Iphosts) {


					$seghost = $primeiroEnderecoRede + 1;
					$primeirohost = $primeiroOcteto. "." . $segundoOcteto . "." . $terceiroOcteto . "." . $seghost . "/" . $mascara;


					echo "<p><strong>$Iphosts</strong></p>";
				}else{
					echo"<p>$Iphosts</p>";
				}
			}
		}
	}

	
	}elseif ($mascara == 25) {
			for ($k=1; $k <= $qntdsubrede ; $k++) { 
				for ($i=1; $i < $limite = ($intervalo * $k) -1; $i++) { 
					$Iphosts= $primeiroOcteto. "." . $segundoOcteto . "." . $terceiroOcteto . "." . $i . "/" . $mascara;
						if ($ip == $Iphosts) {
							echo "<p><strong>$Iphosts</strong></p>";
						}else{
							echo"<p>$Iphosts</p>";
						}
				}
			}
	}
	
*/






//        echo "IP = ".$ip.". A rede possui ".$qntdsubrede." subredes, ".$qntendsubrede." endereços por subrede e ".$hosts." hosts por subrede.
//         O primeiro endereço de host onde o endereço de IP se encontra é ".$primeirohost.", o último é ". $ultimohost." e
//         o endereço de broadcast é ".$ipbroadcast.". A máscara de rede em decimal é ".$mascaraA.". A classe do ip é ".$classe." e
//         é um endereço ".$o.".";
}

calculos($mascara,$primeiroOcteto,$segundoOcteto, $terceiroOcteto, $ultimoOcteto, $bits);