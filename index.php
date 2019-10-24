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
<header>
<title>Taschenrechner</title>
</header>
<body>
	<input type="text" id="result" value="
<?php
echo $ergebnis;
?>" readonly><br>
<button type="button" onclick="setOperator('+')">+</button>
<button type="button" onclick="setOperator('-')">-</button>
<button type="button" onclick="setOperator('*')">*</button>
<button type="button" onclick="setOperator('/')">/</button>
<button type="button" onclick="clearValue()">clear</button>
<button type="button" onclick="allclear()">allclear</button>
<button type="button" onclick="addNumber(1)">1</button>
<button type="button" onclick="addNumber(2)">2</button>
<button type="button" onclick="addNumber(3)">3</button>
<button type="button" onclick="addNumber(4)">4</button>
<button type="button" onclick="addNumber(5)">5</button>
<button type="button" onclick="addNumber(6)">6</button>
<button type="button" onclick="addNumber(7)">7</button>
<button type="button" onclick="addNumber(8)">8</button>
<button type="button" onclick="addNumber(9)">9</button>
<button type="button" onclick="addNumber(0)">0</button>
<button type="button" onclick="addNumber('.')">,</button>

	<form action="/" method="post">
	 <!--input type="number" name="Firstnumber" id="firstnumber" value="0" onkeyup="a()"><br-->
	 <!--select name="operator">
   <option value="+">+</option>
   <option value="-">-</option>
   <option value="*">*</option>
   <option value="/">/</option>
 </select><br-->
	 <!--input type="number" name="Secondnumber" id="secondnumber" value="0" onkeyup="b()"><br-->
	<input type="submit" value="=">
  <input type="hidden" name="hiddenone" id="hiddenone" value="
<?php
echo $ergebnis;
?>">
	<input type="hidden" name="hiddentwo" id="hiddentwo">
	<input type="hidden" name="operator" id="operator">
	</form>
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
