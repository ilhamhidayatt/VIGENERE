<?php

// inisialisasi variabel
$pswd = "";
$code = "";
$error = "";
$valid = true;
$color = "#FF0000";

// jika formulir dikirimkan
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// mendeklarasikan fungsi enkripsi dan dekripsi
	require_once('vigenere.php');
	
	// mengatur variabel
	$pswd = $_POST['pswd'];
	$code = $_POST['code'];
	
	// periksa apakah kata sandi disediakan
	if (empty($_POST['pswd']))
	{
		$error = "Please enter a password!";
		$valid = false;
	}
	
	// periksa apakah teks disediakan
	else if (empty($_POST['code']))
	{
		$error = "Please enter some text or code to encrypt or decrypt!";
		$valid = false;
	}
	
	// periksa apakah kata sandi alfanumerik
	else if (isset($_POST['pswd']))
	{
		if (!ctype_alpha($_POST['pswd']))
		{
			$error = "Password should contain only alphabetical characters!";
			$valid = false;
		}
	}
	
	// inputs valid
	if ($valid)
	{
		// jika tombol enkripsi diklik
		if (isset($_POST['encrypt']))
		{
			$code = encrypt($pswd, $code);
			$error = "ALHAMDULILLAH encrypted successfully!";
			$color = "#526F35";
		}
			
		//jika tombol dekripsi diklik
		if (isset($_POST['decrypt']))
		{
			$code = decrypt($pswd, $code);
			$error = "ALHAMDULILLAH decrypted successfully!";
			$color = "#526F35";
		}
	}
}

?>

<html>
	<head>
		<title>ILHAM GANTENG - Vigenere Cipher</title>
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="Script.js"></script>
	</head>
	<body>
		<br><br><br>
		<form action="index.php" method="post">
			<table cellpadding="5" align="center" cellpadding="2" border="7">
				<caption><hr><b>ILHAM GANTENG YA PAK - Text Cryption</b><hr></caption>
				<tr>
					<td align="center">key nama kota <input type="text" name="pswd" id="pass" value="<?php echo htmlspecialchars($pswd); ?>" /></td>
				</tr>
				<tr>
					<td align="center"><textarea id="box" name="code"><?php echo htmlspecialchars($code); ?></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" name="encrypt" class="button" value="Encode" onclick="validate(1)" /></td>
				</tr>
				<tr>
					<td><input type="submit" name="decrypt" class="button" value="Decode" onclick="validate(2)" /></td>
				</tr>
				
					<td><center><div style="color: <?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($error) ?></div></center></td>
				</tr>
			</table>
		</form>
	</body>
</html>