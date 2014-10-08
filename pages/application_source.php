<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html  manifest="app.appcache" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
<script type="text/javascript">


var canvas_download = document.getElementById('download');
var bg_fundo_download = null;

	
function CriarImagem(imgURL, optionalLoadCallback) {
    var img = new Image();
    img.src = imgURL;
    img.onload = optionalLoadCallback;
    return img;
}

function SetCanvas(canvasId) {
    canvas_download = document.getElementById(canvasId);
}
    

function DesenharImagem(img, x, y) {
    var ctx = canvas_download.getContext('2d');
    ctx.drawImage(img, x, y);
}

function Fundo() {
                SetCanvas('download');
                var x = 0;
                var y = 0;                
				DesenharImagem(bg_fundo_download, x, y);
			}
	
	function download(){
		window.setTimeout(function(){
		
	var i = 0;
	var i2 = 0;

	var percent = 1;
	var clocking_time = window.setInterval(function(){
		
		if(percent == 1){
			var obj = document.getElementById("information");
			obj.innerHTML = "14% - Downloading Animations...";
		} else if(percent == 2){
		var obj = document.getElementById("information");
			obj.innerHTML = "22% - Downloading Animations...";
		}else if(percent == 3){
		var obj = document.getElementById("information");
			obj.innerHTML = "34% - Downloading Images...";
		}else if(percent == 4){
		var obj = document.getElementById("information");
			obj.innerHTML = "45% - Downloading Images...";
		}else if(percent == 5){
		var obj = document.getElementById("information");
			obj.innerHTML = "53% - Downloading Tutorial...";
		}else if(percent == 6){
		var obj = document.getElementById("information");
			obj.innerHTML = "75% - Downloading Scripts...";
		}else if(percent == 7){
		var obj = document.getElementById("information");
			obj.innerHTML = "90% - Downloading Scripts...";
		}else if(percent == 8){
		var obj = document.getElementById("information");
			obj.innerHTML = "100% - Finishing...";
		}
		
		percent++;
	}, 45000);			
				
			
			 var download_app = window.setInterval(function() {
				 
				 if(i==0)
				bg_fundo_download = CriarImagem('img/download_animation/download_1.jpg', Fundo);
				if(i==1)
				bg_fundo_download = CriarImagem('img/download_animation/download_2.jpg', Fundo);
				if(i==2)
				bg_fundo_download = CriarImagem('img/download_animation/download_3.jpg', Fundo);
				if(i==3){
				bg_fundo_download = CriarImagem('img/download_animation/download_4.jpg', Fundo);
				i=0;
				} else {
				i++;
				}
				 
				if(app_cache() != "Downloading"){
					clearInterval(download_app);
					clearInterval(clocking_time);
					window.location.href = "application.php?lg=on&relog=&xp=&cristais=";
				}
				
			}, 100); // Executara isso em um intervalo de 50milisec
			
			
			
	}, 5000);
			}
			
function app_cache(){				
var sCacheStatus = "Not supported";
if (window.applicationCache) 
{
   var oAppCache = window.applicationCache;
   switch ( oAppCache.status ) 
   {
      case oAppCache.UNCACHED : 
         sCacheStatus = "Not cached"; 
         break;
      case oAppCache.IDLE : 
         sCacheStatus = "Idle"; 
         break;
      case oAppCache.CHECKING : 
         sCacheStatus = "Checking"; 
         break;
      case oAppCache.DOWNLOADING : 
         sCacheStatus = "Downloading"; 
         break;
      case oAppCache.UPDATEREADY : 
         sCacheStatus = "Update ready"; 
         break;
      case oAppCache.OBSOLETE : 
         sCacheStatus = "Obsolete"; 
         break;
      default : 
        sCacheStatus = "Unexpected Status ( " + 
                       oAppCache.status.toString() + ")";
        break;
   }
}
return sCacheStatus;
}

	window.onload = download;
	
</script>
<style type="text/css">
#topLabel {
	width: 900px;
	height: 50px;
	z-index: 1;
	left: 8px;
	top: 3px;
	background-color: black;
}
#information {
	position: absolute;
	width: 333px;
	height: 36px;
	z-index: 1;
	left: 592px;
	top: 62px;
	color: black;
	font: italic small-caps bold 16px
 	"Verdana", sans-serif;
}
#apDiv1 {
	position: absolute;
	width: 897px;
	height: 596px;
	z-index: 2;
	left: 11px;
	top: 60px;
}
</style>
</head>
<body>
<div id="information"></div>
<div id="topLabel">
</div>
<canvas id="download" width="900" height="600"> Seu navegador não suporta HTML 5 :/ <br /> 
Por favor atualize! </canvas>
</body>
</html>