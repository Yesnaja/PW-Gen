<?php
	include "helperclasses.php";
	$pw = new Pw();
	$sm = true;
	$lg = true;
	$nr = true;
	$ln="8";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Passwort Generator</title>
		<meta charset="utf-8">
		<script src="jquery-1.12.4.js"></script>
		<link href="design.css" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
		<link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<script src="qtip/jquery.qtip.min.js"></script>
		<link href="qtip/jquery.qtip.min" rel="stylesheet">
	</head>
	<body>
		<div id="header">
			<h1>Passwort Generator</h1>
		</div>
		<div id="PWForm">
			<form method="POST">
				<div id="form">
					<table>
						<tr>
							<td><p title="Wie viele Passwörter wollen sie Generieren?">Anzahl Passwörter:</p></td>
							<td>
								<select name="PW_Count">
									<option name="1" <?php if(isset($_POST["PW_Count"]) && $_POST["PW_Count"]=="1") echo "selected"; ?>>1</option>
									<option name="2" <?php if(isset($_POST["PW_Count"]) && $_POST["PW_Count"]=="2") echo "selected"; ?>>2</option>
									<option name="5" <?php if(isset($_POST["PW_Count"]) && $_POST["PW_Count"]=="5") echo "selected"; ?>>5</option>
									<option name="10" <?php if(isset($_POST["PW_Count"]) && $_POST["PW_Count"]=="10") echo "selected"; ?>>10</option>
									<option name="20" <?php if(isset($_POST["PW_Count"]) && $_POST["PW_Count"]=="20") echo "selected"; ?>>20</option>
								</select>
							</td>
							<td title="z.B. a,b,c,d,...">Kleinbuchstaben:</td>
							<td><input type="checkbox" name="sm_letters" <?php if(isset($_POST['sm_letters'])) echo "checked='checked'"; ?>></td>
						</tr>
						<tr>
							<td title="Wie viele Zeichen soll das Passwort haben">Länge:</td>
							<td><input type="text"  name="pw_size" value="<?php if(isset($_POST['pw_size'])) { echo htmlentities ($_POST['pw_size']); } else{ echo "8";} ?>" /></td>
							<td title="z.B. A,B,C,D,...">Großbuchstaben:</td>
							<td><input type="checkbox" name="lg_letters" <?php if(isset($_POST['lg_letters'])) echo "checked='checked'"; ?>></td>
						</tr>
						<tr>
							<td title="z.B.!,§,$,%,&,/,(,),=,?">Sonderzeichen:</td>
							<td><input type="text" name="sp_letters" value="<?php if(isset($_POST['sp_letters'])) { echo htmlentities ($_POST['sp_letters']); } else{ echo "!?@(){}[]\/=~$%&#*-+.,_";} ?>" /></td>
							<td title=" 0,1,2,3,4,5,6,7,8,9">Zahlen:</td>
							<td><input type="checkbox" name="numbers" <?php if(isset($_POST['numbers'])) echo "checked='checked'"; ?>></td>
						</tr>
						<tr>
							<td title="Es wird Empfohlen I und l auszulassen, da diese sehr ähnlich aussehen">Zeichen auslassen:</td>
							<td><input type="text" name="not_letters" value="<?php if(isset($_POST['not_letters'])) { echo htmlentities ($_POST['not_letters']); } else{ echo "IlyYzZO0";} ?>" /></td>
						</tr>
					</table>
				</div>
				<input type="submit" value="Generiere Passwort" name="generatePW" id="button">
				<div id="ausgabe">
					<?php
						if(isset($_POST["generatePW"]))
						{
							if(isset($_POST["sm_letters"]))
							{
								$sm=true;
							}else
							{
								$sm=false;
							}
							if(isset($_POST["lg_letters"]))
							{
								$lg=true;
							}else
							{
								$lg=false;
							}
							if(isset($_POST["numbers"]))
							{
								$nr=true;
							}else
							{
								$nr=false;
							}
							$sp=$_POST["sp_letters"];
							$pool=$pw->generatePool($sm,$lg,$nr,$sp);
							$pool=$pw->removeLetters($_POST["not_letters"], $pool);
							$ln=$_POST["pw_size"];
							if($_POST["PW_Count"]=="1"){
								echo("<p>Das generierte Passwort lautet: </p><br>");
							}
							else{
								echo("<p>Die generierten Passwörter lauten: </p><br>");
							}
							for($i=0; $i<$_POST["PW_Count"];$i++)
							{
								$passwort=$pw->generatePW($ln,$pool);
								echo("<p><b>".$passwort."</b> <i class='fa fa-files-o'></i></p><br>");
							}	
						}
					?>
				</div>
			</form>
		</div>
	</body>
</html>