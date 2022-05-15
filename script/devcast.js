$(document).ready(function(){
	setTimeout(function(){
	$("#erro1").fadeOut(500);
	}, 3000);
});
function clickInfo(item){
	var requery = $.get('includes/infobox.php?plugin_nome='+item+"");
	requery.done(function(data) {
		var x = document.getElementById("infobox");
		x.innerHTML = data;
		if($('#infobox').hide()){
			$('#infobox').fadeIn();
		}
	});
}
function clickClose(){
	$('#infobox').fadeOut();
}

window.onload = function(){
var count = 0;
setInterval(function(){
count++;
if(count == 1){ 
document.title = "Melhor serviços para seu servidor.";
}
if(count == 2){
document.title = "Plugins de alta qualidade.";
}
if(count == 3){
document.title = "Suporte super rápido.";
}
if(count >= 4){
count=0;
}
}, 5*1000);
}