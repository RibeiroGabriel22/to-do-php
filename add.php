


<link rel="stylesheet" type="text/css" href="assets/css/cssIndex.css">
<form method="POST" class="form">
	<h2>Cadastro</h2>
<?php

	if(isset($_POST['name'])){
		$name = addslashes($_POST['name']);
		$username = addslashes($_POST['username']);
		$email = addslashes($_POST['email']);
		$password = addslashes($_POST['password']);
		
		$curl = curl_init();
	    $postData = ['name'=>$name,'username'=>$username,'email'=>$email,'password'=> $password];
	        curl_setopt_array($curl, array(
	        CURLOPT_URL => 'http://localhost/to-do/api/user/new/',
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	        CURLOPT_CUSTOMREQUEST => 'POST',
	        CURLOPT_POSTFIELDS => json_encode($postData),
	        CURLOPT_HTTPHEADER => array('Content-Type: application/json',),));
	        $response = curl_exec($curl);
	        $js = json_decode($response, true);
	        

	        echo "Usuário cadastrado com sucesso!<br>";

	}



?>

	
	<input type="text" id="txt" name="name" placeholder="Nome" required><br>

	<input type="text" id="txt" name="username" placeholder="usuario" required><br>
 
	<input type="text" id="txt" name="email" placeholder="email" required><br>

	<input type="text" id="txt" name="password" placeholder="senha" required><br>

	<input type="submit" name="btn" class="btn" value="cadastrar"> <a href="index.php"><input type="button" name="voltar" value="voltar"></a>

</form>