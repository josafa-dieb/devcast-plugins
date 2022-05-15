<?php
	include_once 'includes/conexao.php';
	$consulta = $pdo->prepare("SELECT * FROM plugins ORDER BY vendidos DESC");
	$consulta->execute();
?>
<?php require_once 'includes/header.php' ?>
<div id="infobox" class="shadown-box">
</div>
<header>
<nav>
<ul>
<li><a href="index.php">Inicio</a></li>
<li class="selected"><a href="#">Loja</a></li>
<li><a href="pedidos.php">Pedidos</a></li>
</ul>
</nav> 
<div id="logo">
<img src="storage/images/logo.png">
</div>
</header>	
	<section class="container-fluid">
		<div class="row">
			<div class="col-lg-12">

				<div class="panel">
					<select>
						<option id="recent">Recentes</option>
						<option id="recomend">Recomendações</option>
					</select>
				</div>
			</div>
			
			<?php 
				if(isset($_GET['action'])):
					if($_GET['action'] == 'erro1'){
						echo "<p id='erro1' style='text-align:center; width:100%;'class='red shadown-box'>O plugin escolhido ainda não esta pronto para venda.</p>";
					}
				endif;
			?>
		</div>

		<div class="row">

			<?php while ($plugins = $consulta->fetch()): ?>
			<div class="col-md-3">
			<div class="panel shadown-box">
				<div class="header green">
				</div>
				<div class="section">
					<figure>
						<img src="storage/images/3d-cube.png" width="100%">
						<figcaption>
							<h1><?php echo $plugins["plugin_nome"];?></h1>
							<p><strong>Total de vendas:</strong> <?php echo $plugins["vendidos"];?></p>
						</figcaption>
					</figure>
				</div>
				<div class="footer">
					<div class="row">
						<div class="col-12">
						<button onclick="clickInfo('<?php echo $plugins['plugin_nome']; ?>')" class="btn-infor" id="infor">INFORMAÇÕES</button>
						<a class="btn-comprar" target="_black" href="<?php echo $plugins['link_pagamento'];?>">COMPRAR</a>
						<!-- <button onclick="')" class="btn-comprar" id="comprar" value="<?php echo $plugins['plugin_nome'];?>">COMPRAR</button> -->
						</div>
					</div>
				</div>
			</div>
			</div>
			<?php endwhile; ?>

		</div>
	</section>
<?php require_once 'includes/footer.php' ?>