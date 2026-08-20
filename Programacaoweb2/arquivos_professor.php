<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Cadatro</title>
</head>
<body>
	<fieldset>
		<legend>Cadastro</legend>
		<form action="" method=POST enctype="multipart/form-data">
			<p>
				<label for="foto">Selecione uma foto</label> <br>
				<input type="file" name="foto">
			</p>
			<p>
				<label for="nome">Nome:</label><br>
				<input type="text" name="nome">
			</p>
			<p>
				<label for="city">Cidade:</label><br>
				<input type="text" name="city">
			</p>
			<p>
				<label for="telefone">Telefone:</label><br>
				<input type="tel" name="telefone">
			</p>
			<p><input type="submit" value="Cadastrar" name="btn"></p>
		</form>
	</fieldset>
</body>
</html>

<?php
	###### ARQUIVOS #######
	# FILE - fwrite - fopen - fclose

	## criar um arquivo e gravar
	if (isset($_POST['btn'])){
		$nome = $_POST['nome'];
		$city = $_POST['city'];
		$tel = $_POST['telefone'];

		$temp = $_FILES['foto']['tmp_name'];
		$novoNome = uniqid().".jpg";
		move_uploaded_file($temp, "img/".$novoNome);

		$file = "texto.txt";

		$arquivo = fopen($file, "a+");
		fwrite($arquivo, "$nome;$city;$tel;$novoNome" . PHP_EOL);
		fclose($arquivo);
        echo "<h1>$nome cadastrado com sucesso!</h1>";
	}

	#### Leitura do arquivo
	if (isset($file)){
		$abrir = file($file);
		foreach ($abrir as $linha) {
			$info = explode(";", $linha);
			echo "<img src=img/$info[3] width=100px> <br>";
			echo "Nome: $info[0] <br>";
			echo "Cidade: $info[1] <br>";
			echo "Telefone: $info[2] <hr>";
		}
	}

?>