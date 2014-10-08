var Canvas = null;
var ShowImageCenter = false;

// Diz o nome da canvas onde será desenhado
function SetCanvas(canvasId) {
    Canvas = document.getElementById(canvasId);
}

// Cria um objeto imagem
function CriarImagem(imgURL, optionalLoadCallback) {
    var img = new Image();
    img.src = imgURL;
    img.onload = optionalLoadCallback;
    return img;
}

function windowToCanvas(canvasMouse, x, y) {
   var bbox = canvasMouse.getBoundingClientRect();
   return { x: x - bbox.left * (canvasMouse.width  / bbox.width),
            y: y - bbox.top  * (canvasMouse.height / bbox.height)
          };
}

function estabilish(msg){
	var canvas = document.getElementById("Menu");
    var context = canvas.getContext("2d");
	context.font = "20pt Verdana";
	context.fillStyle = "rgba(0, 0, 0, 255)";
		
		
	window.setTimeout(function() {
				context.fillText(msg, 250, 416);
	}, 1);
}

function estabilish_finish(msg){
	var canvas = document.getElementById("Menu");
    var context = canvas.getContext("2d");
	context.font = "20pt Verdana";
	context.fillStyle = "rgba(0, 0, 0, 255)";
		
		
	window.setTimeout(function() {
				context.fillText(msg, 250, 473);
	}, 1);
}

function Desenhar_placar(pont_j, pont_o){
		var canvas = document.getElementById("Menu");
     	var context = canvas.getContext("2d");
		
		window.setTimeout(function() {
		imageObj = new Image();
		imageObj.src = "img/fim_de_jogo.png"; 
		imageObj.onload = function(){
       	context.drawImage(imageObj, 0, 0);
		};
		}, 10);	
		
		window.setTimeout(function() {
		context.font = "45pt Verdana";
		context.fillStyle = "rgba(0, 0, 0, 255)";
				context.fillText(pont_j, 80, 364); 
				context.fillText(pont_o, 392, 364); 
		}, 100);
}

// Desenha um objeto imagem criado
function DesenharImagem(img, x, y) {
    var ctx = Canvas.getContext('2d');
    ctx.drawImage(img, x, y);
    
}

function des_funcao(jogador_funcao){
		
		var canvas = document.getElementById("Menu");
     	var context = canvas.getContext("2d");
		context.font = "15pt Verdana";
		context.fillStyle = "rgba(0, 0, 0, 255)";
		
	if(jogador_funcao == "atacar"){
				context.fillText("Atacando", 520, 20); 
				context.fillText("Defendendo", 228, 20);
	} else {
				context.fillText("Atacando", 228, 20);
				context.fillText("Defendendo", 520, 20);
	}
}

function des_icon_posicao(funcao_jogador){
		var canvas = document.getElementById("Menu");
     	var context = canvas.getContext("2d");
	if(funcao_jogador == "atacar"){
		window.setTimeout(function() {
		defendIco = new Image();
		defendIco.src = "img/atack_icon.png"; 
		defendIco.onload = function(){
       	context.drawImage(defendIco, 615, 0);
		};
		}, 1);
		window.setTimeout(function() {
		AtackIco = new Image();
		AtackIco.src = "img/defend_icon.png"; 
		AtackIco.onload = function(){
       	context.drawImage(AtackIco, 350, 0);
		};
		}, 1);
	
	} else 
	if(funcao_jogador == "defender"){
		window.setTimeout(function() {
		DefendIco = new Image();
		DefendIco.src = "img/atack_icon.png"; 
		DefendIco.onload = function(){
       	context.drawImage(DefendIco, 323, 0);
		};
		}, 1);
		window.setTimeout(function() {
		AtackIco = new Image();
		AtackIco.src = "img/defend_icon.png"; 
		AtackIco.onload = function(){
       	context.drawImage(AtackIco, 640, 0);
		};
		}, 1);
	}
}

function xp_cristais(xp, cristais, elo){
	
					var canvas = document.getElementById("Menu");
	     			var context = canvas.getContext("2d");
	
		context.font = "20pt Verdana";
		context.fillStyle = "rgba(255, 255, 255, 255)";
		
		context.fillText(xp+"x", 673, 400); 
		context.fillText(cristais+"x", 673, 438);
		context.fillText(elo, 797, 395);
	
}

function resultado_final(lacaios_jogador, lacaios_oponente){
	
	
				var canvas = document.getElementById("Menu");
     			var context = canvas.getContext("2d");
				
	
	if(lacaios_jogador > lacaios_oponente){
		resultado_final_do_jogo = "vitoria";
		window.setTimeout(function() {
		imageObj = new Image();
		imageObj.src = "img/win.png"; 
		imageObj.onload = function(){
       	context.drawImage(imageObj, 70, 490);
		};
		}, 1);
	} else if(lacaios_oponente > lacaios_jogador){
		resultado_final_do_jogo = "derrota";
		window.setTimeout(function() {
		imageObj = new Image();
		imageObj.src = "img/loser.png"; 
		imageObj.onload = function(){
       	context.drawImage(imageObj, 70, 490);
		};
		}, 1);
	} else {
		window.setTimeout(function() {
		resultado_final_do_jogo = "empate";
		imageObj = new Image();
		imageObj.src = "img/draw.png"; 
		imageObj.onload = function(){
       	context.drawImage(imageObj, 70, 490);
		};
		}, 1);
	}
}

function des_pontuacao(pontosx, pontosy, name1, name2, funcao_jogador){
	window.setTimeout(function(){
				var canvas = document.getElementById("Menu");
     			var context = canvas.getContext("2d");
				context.font = "25pt Verdana";
				context.fillStyle = "rgba(0, 0, 0, 255)";
   				context.fillText(pontosx, 75, 68);
				context.fillText(pontosy, 786, 68);
				context.fillText(name1, 228, 50);
				context.fillText(name2, 520, 50);
				des_funcao(funcao_jogador);
	}, 1);
}

function Escrever(texto, x, y){
	var ctx = Canvas.getConext('2d');
	ctx.font = "20pt Arial";
	ctx.fillStyle = "red";
	ctx.fillText(texto, x,y);
}

function Dialogo_Jogador(vez_de_jogar, perdeu, ganhou){
		
		var canvas = document.getElementById("Menu");
     	var context = canvas.getContext("2d");
		
		if(vez_de_jogar){
		window.setTimeout(function() {
		imageObj = new Image();
		imageObj.src = "img/sua_vez_de_jogar.png"; 
		imageObj.onload = function(){
       	context.drawImage(imageObj, 705, 260);
		};
		}, 1);
			
		} 
		if(perdeu){
			
	window.setTimeout(function() {
		imageObj = new Image();
		imageObj.src = "img/voce_perdeu.png"; 
		imageObj.onload = function(){
       	context.drawImage(imageObj, 705, 148);
		};
	}, 1);
			
		}
		if(ganhou){
	
		window.setTimeout(function() {
		imageObj = new Image();
		imageObj.src = "img/voce_pegou.png"; 
		imageObj.onload = function(){
       	context.drawImage(imageObj, 705, 148);
		};
	}, 1);
	
			
		}
}

function Dialogo(texto1, texto2, texto3, x, y){
	var canvas = document.getElementById("Menu");
    var context2 = canvas.getContext("2d");
	
	window.setTimeout(function() {
		imageObj = new Image();
		imageObj.src = "img/select/dialog.png"; 
		imageObj.onload = function(){
       	context2.drawImage(imageObj, x, y);
		};
	}, 1);
	
	
		window.setTimeout(function() {
		context2.font = "15pt Arial";
		context2.fillStyle = "black";
		context2.fillText(texto1, 80, 130);
		context2.fillText(texto2, 80, 150);
		context2.fillText(texto3, 80, 170);
		}, 150);
			
		
	
	
	
}

			/////////////////////////////// Função para limpar a tela //////////////////////

			function LimparTela(){
			// Store the current transformation matrix
var canvas = document.getElementById('Menu');
var ctx = canvas.getContext('2d');
context.clearRect(0, 0, canvas.width, canvas.height);
  var w = canvas.width;
  canvas.width = 1;
  canvas.width = w;
			}
			
			
			function clearCanvas() {
			var canvas = document.getElementById('Menu');
			var context = canvas.getContext('2d');
  			context.clearRect(0, 0, canvas.width, canvas.height);
  			var w = canvas.width;
  			canvas.width = 1;
  			canvas.width = w;
}
			
			/////////////////////////////////////////////////////////////////////////////////


			////////////////////////////// LOCALIZAÇÕES PARA PINTURA ////////////////////////

			
			/////////////// PARA TODA A TELA ------------------------------------------------
			
			function Fundo() {
                SetCanvas('Menu');

                var x = 0;
                var y = 0;                DesenharImagem(bg_fundo, x, y);
				
	
            }
			
			function Fundo2() {
                SetCanvas('Menu');

                var x = 300;
                var y = 300;                DesenharImagem(bg_fundo, x, y);
				
	
            }
			
			function Localizacao(x, y) {
                SetCanvas('Menu');
                DesenharImagem(sob, x, y);
            }
			
			////////////////////////////////////////////////////////////////////////////////
			
			
			

			////////////////////////// Função escolher Adversario ///////////////////////
			
			function DesenharImagemTextMenu2(imageObj, Texto, Texto2, x, y, x1, y1){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     				imageObj.onload = function(){
         		context.drawImage(imageObj, 0, 0);
         		context.font = "30pt Arial";
				context.fillStyle = "rgba(255, 255, 255, 255)";
         		context.fillText(Texto, x, y);
				context.font = "20pt Arial";
				context.fillText(Texto2, x1, y1);
     		};
			}
			
			function DesenharPersonagens(imageObj, Texto, x, y, x1, y2){
			     var canvas = document.getElementById("Menu");
     			 var context2 = canvas.getContext("2d");
     				imageObj.onload = function(){
         		context2.drawImage(imageObj, x, y);
         		context2.font = "12pt Arial";
				context2.fillStyle = "rgba(255, 255, 255, 255)";
         		context2.fillText(Texto, x1, y2);
     		};
     			
			}
			
			function Desenhar_round_animation(imageObj, Texto, x, y, x1, y2){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     				imageObj.onload = function(){
         		context.drawImage(imageObj, x, y);
         		context.font = "30pt Berlin Sans FB Demi";
				context.fillStyle = "rgba(255, 255, 255, 255)";
         		context.fillText(Texto, x1, y2);
     		};
     			
			}
			
			function DesenharCarta_tabuleiro(imageObj, burst, rage, ataque, defesa, x, y, x1, y1, x2, y2, x3, y3, x4, y4){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     				imageObj.onload = function(){
         		context.drawImage(imageObj, x, y, 120, 165);
         		context.font = "12pt Arial";
				context.fillStyle = "rgba(255, 255, 255, 255)";
         		context.fillText(burst, x1, y1);
				context.fillText(rage, x2, y2);
				context.fillText(ataque, x3, y3);
				context.fillText(defesa, x4, y4);
     		};	
			}

			function DesenhaP(imageObj, x, y){
			 var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     				imageObj.onload = function(){
         		context.drawImage(imageObj, x, y);
     							};
     			
			}
			
			function DesenhaLimpo(imageObj, x, y){
				LimparTela();
			 var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     				imageObj.onload = function(){
         		context.drawImage(imageObj, x, y);
     							};
     			
			}
			
			function DesenharPPT(imageObj, x, y){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     				imageObj.onload = function(){
				context.globalCompositeOperation = 'source-atop'; 
         		context.drawImage(imageObj, x, y);
     		};
     			
			}
			
			function DesenharFundo(imageObj, x, y){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     				imageObj.onload = function(){
         		context.drawImage(imageObj, x, y);
     		};
     			
			}
			
			function Logar_Imagem(imgURL, optionalLoadCallback) {
    		var img = new Image();
    		img.src = imgURL;
    		img.onload = optionalLoadCallback;
   		 	return img;
			}
	
	
	function Deck_Source(c1, c2, c3, c4, c5, c6){
			if(c1){
			window.setTimeout(function(){
			Carta_draw1 = new Image()
			
			if(cartas_usuario[5].nome != null){
			 var url_img = cartas_usuario[5].nome.toLowerCase();
			 url_img = url_img.replace(" ","_");
			 if(cartas_usuario[5].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
			 } else
			 if(cartas_usuario[5].nome.toLowerCase() == "fate - k"){
				 url_img = "fate-k";
			 }
			 
			Carta_draw1.src = "img/ddl_cartas/"+url_img+".png"; 
			DesenharCarta_tabuleiro1(Carta_draw1, cartas_usuario[5].burst, cartas_usuario[5].rage, cartas_usuario[5].ataque, cartas_usuario[5].defesa, 712, 400, 795, 544, 753, 487, 840, 487);	
				}
			} ,1);	
			}
			if(c2){	
			window.setTimeout(function(){
			Carta_draw1 = new Image()
			if(cartas_usuario[4].nome != null){
			var url_img = cartas_usuario[4].nome.toLowerCase();
			 url_img = url_img.replace(" ","_");
			 if(cartas_usuario[4].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
			 } else
			 if(cartas_usuario[4].nome.toLowerCase() == "fate - k"){
				 url_img = "fate-k";
			 }
			
			Carta_draw1.src = "img/ddl_cartas/"+url_img+".png"; 
			DesenharCarta_tabuleiro2(Carta_draw1, cartas_usuario[4].burst, cartas_usuario[4].rage, cartas_usuario[4].ataque, cartas_usuario[4].defesa, 722, 400, 795, 544, 753, 487, 840, 487);	
			}
			} ,2);	
			}
			if(c3){
			window.setTimeout(function(){
				
			Carta_draw1 = new Image()
			if(cartas_usuario[3].nome != null){
				var url_img = cartas_usuario[3].nome.toLowerCase();
			 url_img = url_img.replace(" ","_");
			 if(cartas_usuario[3].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
			 } else
			 if(cartas_usuario[3].nome.toLowerCase() == "fate - k"){
				 url_img = "fate-k";
			 }
			
			Carta_draw1.src = "img/ddl_cartas/"+url_img+".png"; 
			DesenharCarta_tabuleiro3(Carta_draw1, cartas_usuario[3].burst, cartas_usuario[3].rage, cartas_usuario[3].ataque, cartas_usuario[3].defesa, 732, 400, 795, 544, 753, 487, 840, 487);	
			}
			} ,3);	
			}
			if(c4){
			window.setTimeout(function(){
				
			Carta_draw1 = new Image()
			if(cartas_usuario[2].nome != null){
			var url_img = cartas_usuario[2].nome.toLowerCase();
			 url_img = url_img.replace(" ","_");
			 if(cartas_usuario[2].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
			 } else
			 if(cartas_usuario[2].nome.toLowerCase() == "fate - k"){
				 url_img = "fate-k";
			 }
			 
			Carta_draw1.src = "img/ddl_cartas/"+url_img+".png"; 
			DesenharCarta_tabuleiro4(Carta_draw1, cartas_usuario[2].burst, cartas_usuario[2].rage, cartas_usuario[2].ataque, cartas_usuario[2].defesa, 742, 400, 795, 544, 753, 487, 840, 487);	
			}
			} ,4);	
			}
			if(c5){
			
			window.setTimeout(function(){
			Carta_draw1 = new Image()
			
			if(cartas_usuario[1].nome != null){	
			var url_img = cartas_usuario[1].nome.toLowerCase();
			 url_img = url_img.replace(" ","_");
			 if(cartas_usuario[1].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
			 } else
			 if(cartas_usuario[1].nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
			 }
			
			Carta_draw1.src = "img/ddl_cartas/"+url_img+".png"; 
			DesenharCarta_tabuleiro5(Carta_draw1, cartas_usuario[1].burst, cartas_usuario[1].rage, cartas_usuario[1].ataque, cartas_usuario[1].defesa, 752, 400, 795, 544, 753, 487, 840, 487);	
			}
			} ,5);	
			}
			if(c6){
			
			window.setTimeout(function(){
			Carta_draw1 = new Image()
			if(cartas_usuario[0].nome != null){
			
			 var url_img = cartas_usuario[0].nome.toLowerCase();
			 url_img = url_img.replace(" ","_");
			 if(cartas_usuario[0].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
			 } else
			 if(cartas_usuario[0].nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
			 }
			
			Carta_draw1.src = "img/ddl_cartas/"+url_img+".png"; 
			DesenharCarta_tabuleiro6(Carta_draw1, cartas_usuario[0].burst, cartas_usuario[0].rage, cartas_usuario[0].ataque, cartas_usuario[0].defesa, 762, 400, 795, 544, 753, 487, 840, 487);	
			}
			} ,6);	
			}
			}
			function DesenharCarta_tabuleiro1(imageObj, burst, rage, ataque, defesa, x, y, x1, y1, x2, y2, x3, y3, x4, y4){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     			
					imageObj.onload = function(){
				
		context.save(); 
		context.translate(x, y); 
		context.translate(60, 82);
		context.rotate(-0.06); 
		context.drawImage(imageObj, -60, -82, 120, 165);
		context.font = "12pt Arial";
				context.fillStyle = "rgba(255, 255, 255, 255)";
         		context.fillText(burst, -12, -36);
				context.fillText(rage, -12, 75);
				context.fillText(ataque, -52, 17);
				context.fillText(defesa, 36, 17); 
		context.restore();			
     		};	
			}
			function DesenharCarta_tabuleiro2(imageObj, burst, rage, ataque, defesa, x, y, x1, y1, x2, y2, x3, y3, x4, y4){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     			
					imageObj.onload = function(){
				
		context.save(); 
		context.translate(x, y); 
		context.translate(60, 82);
		context.rotate(-0.03); 
		context.drawImage(imageObj, -60, -82, 120, 165);
		context.font = "12pt Arial";
				context.fillStyle = "rgba(255, 255, 255, 255)";
         		context.fillText(burst, -12, -36);
				context.fillText(rage, -12, 75);
				context.fillText(ataque, -52, 17);
				context.fillText(defesa, 36, 17); 
		context.restore();			
     		};	
			}
			
			function DesenharCarta_tabuleiro3(imageObj, burst, rage, ataque, defesa, x, y, x1, y1, x2, y2, x3, y3, x4, y4){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     			
					imageObj.onload = function(){
				
		context.save(); 
		context.translate(x, y); 
		context.translate(60, 82);
		context.rotate(0); 
		context.drawImage(imageObj, -60, -82, 120, 165);
		context.font = "12pt Arial";
				context.fillStyle = "rgba(255, 255, 255, 255)";
           		context.fillText(burst, -12, -36);
				context.fillText(rage, -12, 75);
				context.fillText(ataque, -52, 17);
				context.fillText(defesa, 36, 17);  
		context.restore();			
     		};	
			}
			
		function DesenharCarta_tabuleiro4(imageObj, burst, rage, ataque, defesa, x, y, x1, y1, x2, y2, x3, y3, x4, y4){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     			
					imageObj.onload = function(){
		context.save(); 
		context.translate(x, y); 
		context.translate(60, 82);
		context.rotate(0.03); 
		context.drawImage(imageObj, -60, -82, 120, 165);
		context.font = "12pt Arial";
				context.fillStyle = "rgba(255, 255, 255, 255)";
         		context.fillText(burst, -12, -36);
				context.fillText(rage, -12, 75);
				context.fillText(ataque, -52, 17);
				context.fillText(defesa, 36, 17); 
		context.restore();			
     		};	
			}
			
			function DesenharCarta_tabuleiro5(imageObj, burst, rage, ataque, defesa, x, y, x1, y1, x2, y2, x3, y3, x4, y4){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     			
					imageObj.onload = function(){
				
		context.save(); 
		context.translate(x, y); 
		context.translate(60, 82);
		context.rotate(0.06); 
		context.drawImage(imageObj, -60, -82, 120, 165);
		context.font = "12pt Arial";
				context.fillStyle = "rgba(255, 255, 255, 255)";
         		context.fillText(burst, -12, -36);
				context.fillText(rage, -12, 75);
				context.fillText(ataque, -52, 17);
				context.fillText(defesa, 36, 17); 
		context.restore();			
     		};	
			}
			
			function DesenharCarta_tabuleiro6(imageObj, burst, rage, ataque, defesa, x, y, x1, y1, x2, y2, x3, y3, x4, y4){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     			
					imageObj.onload = function(){
				
		context.save(); 
		context.translate(x, y); 
		context.translate(60, 82);
		context.rotate(0.09); 
		context.drawImage(imageObj, -60, -82, 120, 165);
		context.font = "12pt Arial";
				context.fillStyle = "rgba(255, 255, 255, 255)";
         		context.fillText(burst, -12, -36);
				context.fillText(rage, -12, 75);
				context.fillText(ataque, -52, 17);
				context.fillText(defesa, 36, 17); 
		context.restore();			
     		};	
			}
			
	function Desenhar_Position(imageObj, x, y){
			     var canvas = document.getElementById("Menu");
     			 var context = canvas.getContext("2d");
     			
					imageObj.onload = function(){
		context.save(); 
		context.drawImage(imageObj, x, y);
		ctx.setTransform(1, 0, 0, 1, 0, 0);
		ctx.clearRect(0, 0, canvas.width, canvas.height);
		context.restore();			
		//context.clear();
     		};	
			}
			
			/////////////////////////////////////////////////////////////////////////////