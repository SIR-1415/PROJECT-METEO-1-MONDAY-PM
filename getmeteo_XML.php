<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="weather.css"/>
	</head>
	<body>
		<?php 
		
		// superglobals $_GET $_POST $_SERVER
		
		//var_dump($_GET);

		// $resposta = "o pedido foi efetuado para o local : ".$_GET['location']." e para ".$_GET['days']. " dias";
		// echo $resposta;
		/*
		 api.worldweatheronline.com/free/v1/weather.ashx?q=anha&format=json&=5&key=jx6a4hxmgej238dw8x4p8vvc
		 */
		 // codifica string de acordo com regras das URL
		 // e.g. substitui espaços por +
		 $local = urlencode($_GET['location']);
		 
		 $ndays = $_GET['days'];
		 
		 $coreURL = "http://api.worldweatheronline.com/free/v1/weather.ashx?";
		 $sep = "&";
		 $p_local = "q=".$local;
		 $p_days = "num_of_days=". $ndays;
		 $p_key = "key=jx6a4hxmgej238dw8x4p8vvc";
		 $p_format = "format=xml";
		 
		 $apiURL = $coreURL . $p_local . $sep . $p_format . $sep . $p_days . $sep . $p_key;
		 
		// echo("<hr/>");
		// echo ($apiURL);
		// echo("<hr/>");
		 
		// $forecastXML = file_get_contents($apiURL);
		 
		 //-----------------
		/*
		//  Initiate curl-
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$callURL);
		// Execute
		$result=curl_exec($ch);
		// Closing
		curl_close($ch);
		*/
		 //------------------
		 // echo("<hr/>");
		 // echo ($forecastJSON);
		 // echo("<hr/>");
		 
		 // versao online
		 // $forescastPHP = simplexml_load_string($forecastXML,null,LIBXML_NOCDATA);
		 
		 //versao de recurso (local estatico)
		 $forescastPHP = simplexml_load_file("sample_forecast.xml",null,LIBXML_NOCDATA);
		 

				 
		 $api_Location =  $forescastPHP->request->query;
		 
		 echo "<h1> O estado do tempo para : ".$api_Location."</h1>";
		 
		 echo "<div class=\"current\">";
		 echo "<h2> estado atual </h2>";
		 $api_CurDesc = $forescastPHP->current_condition[0]->weatherDesc[0];
		 $api_CurIcon = $forescastPHP->current_condition[0]->weatherIconUrl[0];
		 $api_CurTemp = $forescastPHP->current_condition[0]->temp_C;
		 $api_CurPrec = $forescastPHP->current_condition[0]->precipMM;
		 echo "<ul>";
		 echo "<li>". $api_CurDesc ."</li>";
		 echo "<li><img src=\"". $api_CurIcon ."\"/></li>";
		 echo "<li>temperatura ".$api_CurTemp." C</li>";
		 echo "<li>precipitação ".$api_CurPrec." mm</li>";
		 echo "</ul>";
		 echo "</div>";
		 
		 //----------------
		 echo "<div class=\"forecast\">";
		 // --- ciclo
		 $api_forecastNodeList = $forescastPHP->weather;
		 echo "<ul>";
		 foreach($api_forecastNodeList as $day_forecast) {
			
		  echo "<li>" .$day_forecast->date."</li>";
		  echo "<ul>";
		    echo "<li>". $day_forecast->weatherDesc[0] ."</li>";
		    echo "<li><img src=\"". $day_forecast->weatherIconUrl[0] ."\"/></li>";
		    echo "<li>temperaturas (min - max) ".$day_forecast->tempMinC."-".$day_forecast->tempMaxC."</li>";
		    echo "<li>precipitação ".$day_forecast->precipMM." mm</li>";
		  echo "</ul>";
		 }

		  echo "</ul>";
		  echo "</div>";
		 
		 
		 //echo "a temperatura atual = ". $forescastPHP->data->current_condition[0]->temp_C;
		 
		
		?>
	</body>
</html>