
<?php require_once 'includes/header.php';?>
<?php require_once 'includes/reCAPTCHA.php';?>
<?php
include_once 'includes/conexao.php';
	$sql = "SELECT * FROM pedidos;";
	$listar = $pdo->prepare($sql);
	$listar->execute();
	if(isset($_GET['action'])){
		if($_GET['action'] == 'sucesso'){
			if(isset($_POST['enviar']) and isset($_POST['nome']) and isset($_POST['other'])and isset($_POST['plugin']) and isset($_POST['desc'])){

		
		$nome = filter_var($_POST['nome'], FILTER_SANITIZE_STRING);
		$nome = htmlspecialchars($nome, ENT_QUOTES);
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$email = htmlspecialchars($email, ENT_QUOTES);
		$plugin = filter_var($_POST['plugin'], FILTER_SANITIZE_STRING);
		$plugin = htmlspecialchars($plugin, ENT_QUOTES);
		$contato = filter_var($_POST['other'], FILTER_SANITIZE_STRING);
		$contato = htmlspecialchars($contato, ENT_QUOTES);
		$descricao = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);
		$descricao = htmlspecialchars($descricao, ENT_QUOTES);
		$stmt = $pdo->prepare("INSERT INTO pedidos VALUES(id, :nome, :plugin, :email, :contato, :descricao);");
		$stmt->bindParam(":nome", $nome);
		$stmt->bindParam(":plugin", $plugin);
		$stmt->bindParam(":email", $email);
		$stmt->bindParam(":contato", $contato);
		$stmt->bindParam(":descricao", $descricao);
		if($stmt->execute()){
			header("Location: pedidos.php?action=sucesso");
		}else{
			header("Location: pedidos.php?action=erro2");
		}

	}else{
		header("Location: pedidos.php?action=erro3");
	}
	}
	}
?>
	<header>
		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="loja.php">Loja</a></li>
				<li class="selected"><a href="#">Pedidos</a></li>
			</ul>
		</nav> 
		<div id="logo">
			<img src="storage/images/logo.png">
		</div>
	</header>
	<section class="container-fluid">
		<div class="row">
				<div class="col-md-6 offset-md-3">
					<div class=" text-center">
						<?php 
						if(isset($_GET['action'])){
							if($_GET['action'] == 'erro'){
								echo "<p class='red' style='color:#FFf;'>O correu um erro, tente novamente.</p>";
							}else if($_GET['action'] == 'erro2'){
								echo "<p class='red' style='color:#FFf;'>Você já fez seu pedido.</p>";
							}else if($_GET['action'] == 'erro3'){
								echo "<p class='red' style='color:#FFf;'>Insira os dados para fazer o pedido.</p>";
							}
						}
						 ?>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5">
				<form class="form shadown-box" id="pedidos" action="pedidos.php?action=sucesso" method="POST">
					<label for="nome">Nome</label>
					<input type="text" required name="nome" id="nome" placeholder="Digite seu nome indentificativo">
					<label for="email">Email</label>
					<input type="email" required name="email" id="email" placeholder="Email para contato">
					<label for="other">Contato</label>
					<input type="text" name="other" id="other" placeholder="Skype ou Discord">
					<label for="plugin">Plugin</label>
					<input type="text" required name="plugin" id="plugin" placeholder="Nome do seu plugin">
					<label for="desc">Descrição</label>
					<textarea style="resize: none"id="desc" name="desc" rows="10" form="pedidos" cols="33" minlength="20" maxlength="330" placeholder="Faça uma descrição de seu pedido com 330 caracteres." required></textarea>
					<div class="g-recaptcha" data-sitekey="6LfSlnsUAAAAAByE7Hlgf_aRGz8exJzDwZKjbG85"></div>
					<input type="submit" name="enviar" value="Enviar pedido">
				</form>
				
			</div>
			<div class="col-md-7">
				<div class="panel shadown-box">
					<table id="tabela">
						<thead>
							<tr>
								<td>Usuario</td>
								<td>Plugin</td>
								<td>Descrição</td>
							</tr>
						</thead>
						<tbody>
							<?php for($i =0; $i < 10; $i++):?>
							<?php while($pedidos = $listar->fetch()):?>
							<tr>
								<td><?php echo $pedidos['nome'];?></td>
								<td><?php echo $pedidos['plugin'];?></td>
								<td><?php echo $pedidos['descricao'];?></td>
							</tr>
							<?php endwhile; ?>
							<?php endfor; ?>
						</tbody>
					</table>
					<div class="section dark-red" style="color: #FFF;">
						<p>Ainda existe <strong>5</strong> pedidos sendo analizado.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
<?php require_once 'includes/footer.php' ?>
<?php $listar = null; $pdo = null;?>
