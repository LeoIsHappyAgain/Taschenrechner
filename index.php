<?php
	class Calculator {
		public function writeToFile($ergebnis){
			$fh = fopen('ergebnis.txt', 'w+');
			fwrite($fh, $ergebnis);
			fclose($fh);
		}
		public function calculate($operator, $secondnumber){
			$ergebnis="ERROR";
			$firstnumber=$this->readFromFile();
		/*	if($operator=="+"){
				$ergebnis=$firstnumber + $secondnumber;
			}
			elseif ($operator=="-") {
				$ergebnis=$firstnumber - $secondnumber;
			}
			elseif ($operator=="*") {
				$ergebnis=$firstnumber * $secondnumber;
			}
			elseif ($operator=="/") {
			//avoid divison by zero
				if($secondnumber==0){
					$ergebnis="ERROR";
				}
				else {
					$ergebnis=$firstnumber / $secondnumber;
				}
			}*/
			switch($operator){
				case '+':$ergebnis=$firstnumber + $secondnumber;break;
				case '-':$ergebnis=$firstnumber - $secondnumber;break;
				case '*':$ergebnis=$firstnumber * $secondnumber;break;
				case '/':	if($secondnumber==0){
						$ergebnis="ERROR";
					}
					else {
						$ergebnis=$firstnumber / $secondnumber;
					}
			}

			return $ergebnis;
		}
		private function readFromFile(){
			//return (int)file_get_contents("ergebnis.txt");
			return $_REQUEST["hiddenone"] ? $_REQUEST["hiddenone"] : (float)file_get_contents("ergebnis.txt");
		}
	}

	$calculator=new Calculator();

	if(isset($_REQUEST["reset"])&&$_REQUEST["reset"]) {
	//$ergebnis=0;
	$calculator->writeToFile(0);
		exit;
	}
	$operator=$_REQUEST["operator"];
	//$firstnumber=$_REQUEST["Firstnumber"];
	//$secondnumber=$_REQUEST["Secondnumber"];
	$secondnumber=$_REQUEST["hiddentwo"];
	/*$ergebnis="ERROR";
	$firstnumber=(int)file_get_contents("ergebnis.txt");*/
	//tells, when to do what
	$ergebnis=$calculator->calculate($operator, $secondnumber);
	//var_dump($secondnumber,$firstnumber,$operator,$ergebnis);
	/*$fh = fopen('ergebnis.txt', 'w+');
	fwrite($fh, $ergebnis);
	fclose($fh);*/
	$calculator->writeToFile($ergebnis);

?>

<html>
	<head>
<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	<style>
		body{
			margin:0;
		}
		button,
		body,
		.anzeige input,
		.equal{
		font-family: 'Open Sans', sans-serif;
		font-weight:bold;
		}
		button,
		.equal{
			font-size: 4vmin;
			text-shadow: 1px 1px 2.5px black, -1px -1px 2.5px black;
			box-shadow: 2px 2px 10px 0 #B0B0B0 inset, -2px -2px 10px 0 black inset;
			border-width: 2px;
		 border-style: solid;
		 border-color: transparent;
		}
			button {
		    color: white;
		    display: block;
		    text-align: center;
		    background-color:#4F4F4F;
		    padding: 0;
				border-radius: 10px;
			}
			.taschenrechner {

				background:
				linear-gradient(27deg, #151515 5px, transparent 5px) 0 5px,
				linear-gradient(207deg, #151515 5px, transparent 5px) 10px 0px,
				linear-gradient(27deg, #222 5px, transparent 5px) 0px 10px,
				linear-gradient(207deg, #222 5px, transparent 5px) 10px 5px,
				linear-gradient(90deg, #1b1b1b 10px, transparent 10px),
				linear-gradient(#1d1d1d 25%, #1a1a1a 25%, #1a1a1a 50%, transparent 50%, transparent 75%, #242424 75%, #242424);
				background-color: #131313;
				background-size: 20px 20px;


				height: 100vmin;
				width: 100%;
				max-width: calc(4 * ((14vmin) + (2 * 2px) + (2 * 1vmin)));
				margin:auto;
			}

			.anzeige {
				width:100%;
			}
			.anzeige input {
				background-color:#228b22;
				width: calc(100% - 6vmin);
				height:10vmin;
				margin:3vmin;
				font-size:5vmin;
				color:white;
				padding:3vmin;
				text-align:right;
				margin-bottom:1vmin;
				border-color:#006400;
				text-shadow: 1px 1px 2.5px #006400, -1px -1px 2.5px #006400;
				box-shadow: 1px 1px 10px 0 #006400 inset;
			}
			.operator button{
				margin: 1vmin;
				width: 13vmin;
				height: 13vmin;
				display: inline-block;
				margin-left: 1.75vmin;
			}

			.ziffern button{
				margin: 1vmin;
				width: 13vmin;
				height: 13vmin;
				display: inline-block;
			}

			.equal {
				margin: 1vmin;
				width: 14vmin;
				height: 8vmin;
				display: inline-block;
				margin-top: 3vmin;
    		margin-left: 44vmin;
				color:white;
				background-color:#4F4F4F;
				border-radius: 10px;
			}

			.clearings button {
				margin: 1vmin;
				width: 14vmin;
				height: 8vmin;
				display: inline-block;
				margin-top: 2vmin;
				margin-bottom: 2vmin;
						}

.clearings button:first-of-type{
	margin-left: 31vmin;
}
			.ziffern {
				max-width: calc(3 * ((14vmin) + (2 * 2px) + (2 * 1vmin)));
				float:left;
				margin-left: 1.5vmin;
    		margin-right: -2vmin;
			}

			.operator {
				max-width: calc(1 * ((14vmin) + (2 * 2px) + (2 * 1vmin)));
				float:left;
			}

			.operator:after {
				clear:both;
			}

		</style>
	</head>
	<header>
		<title>Taschenrechner</title>
	</header>
	<body>

		<div class="taschenrechner">

			<div class="anzeige">
				<input type="text" id="result" value="<?php echo $ergebnis;?>" readonly>
			</div>

			<div class="clearings">
				<button type="button" onclick="clearValue()">c</button>
				<button type="button" onclick="allclear()">ac</button>
			</div>

			<div class="ziffern">
				<button type="button" onclick="addNumber(1)">1</button>
				<button type="button" onclick="addNumber(2)">2</button>
				<button type="button" onclick="addNumber(3)">3</button>
				<button type="button" onclick="addNumber(4)">4</button>
				<button type="button" onclick="addNumber(5)">5</button>
				<button type="button" onclick="addNumber(6)">6</button>
				<button type="button" onclick="addNumber(7)">7</button>
				<button type="button" onclick="addNumber(8)">8</button>
				<button type="button" onclick="addNumber(9)">9</button>
				<button type="button" onclick="addNumber('.')">,</button>
				<button type="button" onclick="addNumber(0)">0</button>
			</div>

			<div class="operator">
				<button type="button" onclick="setOperator('+')">+</button>
				<button type="button" onclick="setOperator('-')">-</button>
				<button type="button" onclick="setOperator('*')">*</button>
				<button type="button" onclick="setOperator('/')">/</button>
			</div>

				<form action="/" method="post">
				 <!--input type="number" name="Firstnumber" id="firstnumber" value="0" onkeyup="a()"><br-->
				 <!--select name="operator">
			   <option value="+">+</option>
			   <option value="-">-</option>
			   <option value="*">*</option>
			   <option value="/">/</option>
			 </select><br-->
				 <!--input type="number" name="Secondnumber" id="secondnumber" value="0" onkeyup="b()"><br-->
				<input class="equal" type="submit" value="=">
			  <input type="hidden" name="hiddenone" id="hiddenone" value="<?php	echo $ergebnis;?>">
				<input type="hidden" name="hiddentwo" id="hiddentwo">
				<input type="hidden" name="operator" id="operator">
				</form>
		</div>
			<script>
				/*function a (){
					document.getElementById("hiddenone").value=document.getElementById("firstnumber").value
				}*/

				/*function b (){
					document.getElementById("hiddentwo").value=document.getElementById("secondnumber").value
				}*/

				function setOperator(operator) {
					document.getElementById("operator").value=operator;
					document.getElementById("hiddenone").value=document.getElementById("hiddentwo").value
					clearValue();
				}

				function addNumber(number) {
					var oldnumber = document.getElementById("hiddentwo").value;
					if(oldnumber==0) {
						oldnumber="";
					}
					document.getElementById("hiddentwo").value = oldnumber+number;
					document.getElementById("result").value=document.getElementById("hiddentwo").value;
				}

			function clearValue() {
				document.getElementById("result").value=0;
				document.getElementById("hiddentwo").value=0;
			}

			function allclear() {
				clearValue();
				var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			    // document.getElementById("demo").innerHTML = this.responseText;
			    }
			  };
			  xhttp.open("GET", "index.php?reset=1", true);
			  xhttp.send();
			}


			</script>
	</body>
</html>
