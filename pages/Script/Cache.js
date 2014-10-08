function animation_download(){
			
			if(relog == "validate"){
				
				top.location.href = "logonapplication.php";
			}
			
			 var i = 0;
			 var i2 = 0;
			
			 var download_app = window.setInterval(function() {
				
				if(i==0)
				bg_fundo = CriarImagem('img/download_animation/download_1.jpg', Fundo);
				if(i==1)
				bg_fundo = CriarImagem('img/download_animation/download_2.jpg', Fundo);
				if(i==2)
				bg_fundo = CriarImagem('img/download_animation/download_3.jpg', Fundo);
				if(i==3){
				bg_fundo = CriarImagem('img/download_animation/download_4.jpg', Fundo);
				i=0;
				} else {
				i++;
				}
				
				if(app_cache() != "Downloading"){
					clearInterval(download_app);
					var msg_conect = "Inicializando . ";
					var last = 0;
					
					//bg_fundo = CriarImagem('img/download_animation/download_finale.jpg', Fundo);
					
					var conecting = window.setInterval(function() {
					
						
					if(i2==0)
					bg_fundo = CriarImagem('img/download_animation/download_finale1.jpg', Fundo);
					if(i2==1)
					bg_fundo = CriarImagem('img/download_animation/download_finale2.jpg', Fundo);
					if(i2==2)
					bg_fundo = CriarImagem('img/download_animation/download_finale3.jpg', Fundo);
					if(i2==3){
					bg_fundo = CriarImagem('img/download_animation/download_finale4.jpg', Fundo);
					i2=0;
					} else {
					i2++;
					}
					
					}, 100);
					
					window.setTimeout(function(){
					clearInterval(conecting);
					soundEfx = document.getElementById("soundEfx");
					soundEfx.play();
					evento_mouse = "Menu1";
					start_play();
					}, 3000);
				}
				
			}, 100); // Executara isso em um intervalo de 50milisec
			
			}
			
			
function downloading(){
				var download_app = window.setInterval(function(){
					if(app_cache() != "Downloading"){
						clearInterval(download_app);
					}
				}, 100);
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


function start_play(){
				downloading();
				MouseEvent();
				window.setTimeout(function() {
				imagePPT1 = new Image();imagePPT1.src = "img/animation_menu/SoloBG.jpg";DesenharPPT(imagePPT1, 0, 201);}, 1);
				
				animacao_menu_init();
				
				animacao_menu = window.setInterval(function() {
					animacao_menu_init();
				}, 2300);
				
				carregaImagem();	
			}
