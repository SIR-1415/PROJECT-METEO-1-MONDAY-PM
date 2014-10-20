<html>
	<head>
		
	</head>
	<body>
		<?php 
		
		echo date(DATE_RFC2822); 
		// superglobals $_GET $_POST $_SERVER
		
		//var_dump($_GET);
		$a=1;
		//echo "o valor é $a";
		echo "<hr/>";
		$resposta = "o pedido foi efetuado para o local : ".$_GET['location']." e para ".$_GET['days']. " dias";
		echo $resposta;
		/*
		 api.worldweatheronline.com/free/v1/weather.ashx?q=anha&format=json&=5&key=jx6a4hxmgej238dw8x4p8vvc
		 */
		 $local = $_GET['location'];
		 $ndays = $_GET['days'];
		 
		 $coreURL = "http://api.worldweatheronline.com/free/v1/weather.ashx?";
		 $sep = "&";
		 $p_local = "q=".$local;
		 $p_days = "num_of_days=". $ndays;
		 $p_key = "key=jx6a4hxmgej238dw8x4p8vvc";
		 $p_format = "format=json";
		 
		 $apiURL = $coreURL . $p_local . $sep . $p_format . $sep . $p_days . $sep . $p_key;
		 
		 echo("<hr/>");
		 echo ($apiURL);
		 echo("<hr/>");
		 
		 $forecastJSON = file_get_contents($apiURL);
		 echo("<hr/>");
		 echo ($forecastJSON);
		 echo("<hr/>");
		 
		 $forescastPHP = json_decode($forecastJSON);
		 
		 echo "a temperatura atual = ". $forescastPHP->data->current_condition[0]->temp_C;
		 
		
		?>
	</body>
</html>