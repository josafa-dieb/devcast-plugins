<?php 
	include_once 'conexao.php';
	$sql = "SELECT * FROM plugins WHERE plugin_nome = '".$_GET['plugin_nome']."';";
	$consult = $pdo->prepare($sql);
	$consult->execute();
	if($consult->rowCount() >= 1 AND isset($_GET['plugin_nome'])):
	while($plugin = $consult->fetch()):
?>
<ul>
	<div onclick="clickClose()" id="close" style="cursor: pointer;float: right;">X</div>

	<li><h1><?php echo $plugin['plugin_nome'] ?></h1></li>
	
	<li ><?php echo $plugin['plugin_desc'] ?></li>
		<li class="blue" style="color: #FFF">
		<p><?php echo $plugin["recomenda"];?> pessoas <strong>recomendam</strong>  esse plugin outras <?php echo $plugin["nao_recomenda"];?> nao <strong>recomendam</strong></p>
	<li>
</ul>
<?php 
endwhile; 
else: 
	header("Location: ../index.php");
endif;?>