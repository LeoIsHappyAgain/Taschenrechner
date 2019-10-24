<?php
$operator=$_REQUEST["operator"];
$firstnumber=$_REQUEST["Firstnumber"];
$secondnumber=$_REQUEST["Secondnumber"];
$ergebnis="ERROR";
//tells, when to do what
if($operator=="+"){
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
}
//var_dump($secondnumber,$firstnumber,$operator,$ergebnis);
$fh = fopen('ergebnis.txt', 'w+');
fwrite($fh, $ergebnis);
fclose($fh);
?>

<html>
<header>
<title>Taschenrechner</title>
</header>
<body>
	<form action="/" method="post">
	 <input type="number" name="Firstnumber" id="firstnumber" value="0" onkeyup="a()"><br>
	 <select name="operator">
   <option value="+">+</option>
   <option value="-">-</option>
   <option value="*">*</option>
   <option value="/">/</option>
 </select><br>
	 <input type="number" name="Secondnumber" id="secondnumber" value="0" onkeyup="b()"><br>
	<input type="submit" value="=">
	<input type="hidden" name="hiddenone" id="hiddenone">
	<input type="hidden" name="hiddentwo" id="hiddentwo">
<?php
echo $ergebnis;
?>
	</form>
	<script>
	function a (){
		document.getElementById("hiddenone").value=document.getElementById("firstnumber").value
	}

	function b (){
		document.getElementById("hiddentwo").value=document.getElementById("secondnumber").value
	}

	</script>
</body>
</html>
