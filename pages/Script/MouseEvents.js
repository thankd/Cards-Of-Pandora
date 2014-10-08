function MouseEvent(){
			var canvasMouse = document.getElementById("Menu");
			// EVENTOS DE DRAW/REDRAW DE MOUSE
			canvasMouse.onmousemove = function(e) {
			
			// EVENTO PARA EXIBIR MENU INICIAL
			if(evento_mouse == "Menu1"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 587) && (pMouse.y >= 334) && (pMouse.x <= 860) && (pMouse.y <= 398)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(indice != 1)
						soundEfx3.play();
						indice = 1;
						indice = 1;
						carregaImagem();
					}
					if((pMouse.x >= 603) && (pMouse.y >= 426) && (pMouse.x <= 847) && (pMouse.y <= 480)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(indice != 2)
						soundEfx3.play();
						indice = 2;
						carregaImagem();
					}
					if((pMouse.x >= 604) && (pMouse.y >= 511) && (pMouse.x <= 847) && (pMouse.y <= 566)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(indice != 3)
						soundEfx3.play();
						indice = 3;
						carregaImagem();
					}
					if((pMouse.x >= 65) && (pMouse.y >= 34) && (pMouse.x <= 334) && (pMouse.y <= 117)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(indice != 4)
						soundEfx3.play();
						indice = 4;
						carregaImagem();
					}
				}
			
			// EVENTO PARA EXIBIR O MENU2 (SELECIONAR DIFICULDADE)
			if(evento_mouse == "Menu2"){
				    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 148) && (pMouse.y >= 128) && (pMouse.x <= 434) && (pMouse.y <= 556)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_menu2 != 1)
						soundEfx3.play();
						som_menu2 = 1;
						EscolherAdversario1();
					} else
					if((pMouse.x >= 456) && (pMouse.y >= 128) && (pMouse.x <= 741) && (pMouse.y <= 556)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_menu2 != 2)
						soundEfx3.play();
						som_menu2 = 2;
						EscolherAdversario2();
					} else
					if((pMouse.x >= 688) && (pMouse.y >= 34) && (pMouse.x <= 842) && (pMouse.y <= 87)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_menu2 != 3)
						soundEfx3.play();
						som_menu2 = 3;
						EscolherVoltar();
					} else {
						som_menu2 = 0;
						EscolherNada();
					}
			}
			
			// EVENTO PARA EXIBIR O MENU3 (SELECIONAR OPONENTE)
			if(evento_mouse == "Menu3"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
					if((pMouse.x >= 75) && (pMouse.y >= 32) && (pMouse.x <= 229) && (pMouse.y <= 84)){
						if(IndMenu == 1){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_menu3 != 1)
						soundEfx3.play();
						som_menu3 = 1;
						bg_fundo = CriarImagem('img/Oponentes/Novatos/OpVoltar.jpg', Fundo);
						}
						else if(IndMenu == 2){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_menu3 != 2)
						soundEfx3.play();
						som_menu3 = 2;
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpEVoltar.jpg', Fundo);
						}
						btn_combater = false;
					} 
			}
			
			// EVENTO PARA EXIBIR O BOTÃO DE COMBATER
			if(btn_combater == true){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
					if((pMouse.x >= 327) && (pMouse.y >= 495) && (pMouse.x <= 521) && (pMouse.y <= 549)){
						if(oponente_desbloq){
						imagePPT = new Image();imagePPT.src = "img/Oponentes/btn_combater.png";DesenharPPT(imagePPT, 328, 494);	
						} else {
						imagePPT = new Image();imagePPT.src = "img/Oponentes/btn_combater_no.png";DesenharPPT(imagePPT, 328, 494);	
						}
						soundEfx3 = document.getElementById("soundEfx3");
						if(btn_combate_som != 1)
						soundEfx3.play();
						btn_combate_som = 1;
					} else {
						
						btn_combate_som = 0;
						if(oponente_desbloq){
						imagePPT = new Image();imagePPT.src = "img/Oponentes/btn_combater_unhover.png";DesenharPPT(imagePPT, 328, 494);					} else {
						imagePPT = new Image();imagePPT.src = "img/Oponentes/btn_combater_no.png";DesenharPPT(imagePPT, 328, 494);	
						}
					}
			}
			
			// EVENTO PARA EXIBIR O MENU4 (BOTÃO OK PARA CARTAS)
			if(evento_mouse == "Menu4"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 340) && (pMouse.y >= 496) && (pMouse.x <= 486) && (pMouse.y <= 542)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_menu4 != 1)
						soundEfx3.play();
						som_menu4 = 1;
						imagePPT = new Image();imagePPT.src = "img/btn_ok_hover.png";DesenharPPT(imagePPT, 340, 498);
					} else {
						som_menu4 = 0;
						imagePPT = new Image();imagePPT.src = "img/btn_ok_hover.png";DesenharPPT(imagePPT, 340, 496);
					}
			}
			
			// EVENTO PARA EXIBIR O MENU5 (ULTIMO MENU) 
			if(evento_mouse == "Menu5"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 601) && (pMouse.y >= 481) && (pMouse.x <= 855) && (pMouse.y <= 526)){
						
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_menu5 != 1)
						soundEfx3.play();
						som_menu5 = 1;
						
						imagePPT = new Image();imagePPT.src = "img/fim_de_jogo_jogar_novamente.png";DesenharPPT(imagePPT, 599, 477);
					} else {
						som_menu5 = 0;
						imagePPT = new Image();imagePPT.src = "img/fim_de_jogo_hover.png";DesenharPPT(imagePPT, 591, 470);
					}
			}
			
			// EVENTO PARA FICAR TROCANDO DE CARTAS CONFORME O MOUSE MUDA
			if(evento_mouse == "Selecionar_Carta"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 773) && (pMouse.y >= 400) && (pMouse.x <= 877) && (pMouse.y <= 560)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_carta != 1)
						soundEfx3.play();
						som_carta = 1;
						Deck_Source(false, false, false, false, false, true);
					}
					if((pMouse.x >= 756) && (pMouse.y >= 400) && (pMouse.x <= 774) && (pMouse.y <= 560)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_carta != 2)
						soundEfx3.play();
						som_carta = 2;
						Deck_Source(false, false, false, false, true, false);
					}
					if((pMouse.x >= 744) && (pMouse.y >= 400) && (pMouse.x <= 755) && (pMouse.y <= 560)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_carta != 3)
						soundEfx3.play();
						som_carta = 3;
						Deck_Source(false, false, false, true, false, false);
					}
					if((pMouse.x >= 734) && (pMouse.y >= 400) && (pMouse.x <= 743) && (pMouse.y <= 560)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_carta != 4)
						soundEfx3.play();
						som_carta = 4;
						Deck_Source(false, false, true, false, false, false);
					}
					if((pMouse.x >= 721) && (pMouse.y >= 400) && (pMouse.x <= 733) && (pMouse.y <= 560)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_carta != 5)
						soundEfx3.play();
						som_carta = 5;
						Deck_Source(false, true, false, false, false, false);
					}
					if((pMouse.x >= 707) && (pMouse.y >= 400) && (pMouse.x <= 720) && (pMouse.y <= 560)){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_carta != 6)
						soundEfx3.play();
						som_carta = 6;
						Deck_Source(true, false, false, false, false, false);
					}
				}
				
			// EVENTO QUE MOSTRA A OPÇÃO CONFIRMAR PARA JOGAR CACRTA
			if(evento_mouse == "Confirm_Cancel"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 738) && (pMouse.y >= 364) && (pMouse.x <= 788) && (pMouse.y <= 390)){
						confirmar();
					}
					if((pMouse.x >= 804) && (pMouse.y >= 364) && (pMouse.x <= 858) && (pMouse.y <= 390)){
						cancelar();
					}
				}
				
			// EVENTO QUE MOSTRA AS POSIÇÕES POSIVEIS PARA JOGAR A CARTA
			if(evento_mouse_posicao_jogar == "Selecionar_Posicao"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if(((pMouse.x >= 197) && (pMouse.y >= 77) && (pMouse.x <= 319) && (pMouse.y <= 243)) != 
					  ((pMouse.x >= 731) && (pMouse.y >= 190) && (pMouse.x <= 765) && (pMouse.y <= 232))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 1)
						soundEfx3.play();
						som_posicao = 1;
						
						pick = 1;
						if(pick_atual != 1)
						desenhar_position();
						pick_atual = 1;
					}
					if(((pMouse.x >= 323) && (pMouse.y >= 77) && (pMouse.x <= 445) && (pMouse.y <= 243)) != 
					  ((pMouse.x >= 765) && (pMouse.y >= 190) && (pMouse.x <= 800) && (pMouse.y <= 232))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 2)
						soundEfx3.play();
						som_posicao = 2;
						
						pick = 2;
						if(pick_atual != 2)
						desenhar_position();
						pick_atual = 2;
					}
					if(((pMouse.x >= 447) && (pMouse.y >= 77) && (pMouse.x <= 570) && (pMouse.y <= 243)) != 
					  ((pMouse.x >= 801) && (pMouse.y >= 190) && (pMouse.x <= 834) && (pMouse.y <= 232))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 3)
						soundEfx3.play();
						som_posicao = 3;
						
						pick = 3;
						if(pick_atual != 3)
						desenhar_position();
						pick_atual = 3;
					}
					if(((pMouse.x >= 572) && (pMouse.y >= 77) && (pMouse.x <= 695) && (pMouse.y <= 243)) != 
					  ((pMouse.x >= 834) && (pMouse.y >= 190) && (pMouse.x <= 868) && (pMouse.y <= 232))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 4)
						soundEfx3.play();
						som_posicao = 4;
						
						pick = 4;
						if(pick_atual != 4)
						desenhar_position();
						pick_atual = 4;
					}
					if(((pMouse.x >= 197) && (pMouse.y >= 246) && (pMouse.x <= 319) && (pMouse.y <= 410))  != 
					  ((pMouse.x >= 731) && (pMouse.y >= 233) && (pMouse.x <= 765) && (pMouse.y <= 277))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 5)
						soundEfx3.play();
						som_posicao = 5;
						
						pick = 5;
						if(pick_atual != 5)
						desenhar_position();
						pick_atual = 5;
					}
					if(((pMouse.x >= 323) && (pMouse.y >= 246) && (pMouse.x <= 445) && (pMouse.y <= 410))  != 
					  ((pMouse.x >= 765) && (pMouse.y >= 233) && (pMouse.x <= 800) && (pMouse.y <= 277))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 6)
						soundEfx3.play();
						som_posicao = 6;
						
						pick = 6;
						if(pick_atual != 6)
						desenhar_position();
						pick_atual = 6;
					}
					if(((pMouse.x >= 447) && (pMouse.y >= 246) && (pMouse.x <= 570) && (pMouse.y <= 410))  != 
					  ((pMouse.x >= 800) && (pMouse.y >= 233) && (pMouse.x <= 834) && (pMouse.y <= 277))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 7)
						soundEfx3.play();
						som_posicao = 7;
						
						pick = 7;
						if(pick_atual != 7)
						desenhar_position();
						pick_atual = 7;
					}
					if(((pMouse.x >= 572) && (pMouse.y >= 246) && (pMouse.x <= 695) && (pMouse.y <= 410))  != 
					  ((pMouse.x >= 834) && (pMouse.y >= 233) && (pMouse.x <= 868) && (pMouse.y <= 277))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 8)
						soundEfx3.play();
						som_posicao = 8;
						
						pick = 8;
						if(pick_atual != 8)
						desenhar_position();
						pick_atual = 8;
					}
					if(((pMouse.x >= 197) && (pMouse.y >= 412) && (pMouse.x <= 319) && (pMouse.y <= 580))  != 
					  ((pMouse.x >= 731) && (pMouse.y >= 279) && (pMouse.x <= 765) && (pMouse.y <= 323))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 9)
						soundEfx3.play();
						som_posicao = 9;
						
						pick = 9;
						if(pick_atual != 9)
						desenhar_position();
						pick_atual = 9;
					}
					if(((pMouse.x >= 323) && (pMouse.y >= 412) && (pMouse.x <= 445) && (pMouse.y <= 580))  != 
					  ((pMouse.x >= 765) && (pMouse.y >= 279) && (pMouse.x <= 800) && (pMouse.y <= 323))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 10)
						soundEfx3.play();
						som_posicao = 10;
						
						pick = 10;
						if(pick_atual != 10)
						desenhar_position();
						pick_atual = 10;
					}
					if(((pMouse.x >= 447) && (pMouse.y >= 412) && (pMouse.x <= 570) && (pMouse.y <= 580))  != 
					  ((pMouse.x >= 800) && (pMouse.y >= 279) && (pMouse.x <= 834) && (pMouse.y <= 323))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 11)
						soundEfx3.play();
						som_posicao = 11;
						
						pick = 11;
						if(pick_atual != 11)
						desenhar_position();
						pick_atual = 11;
					}
					if(((pMouse.x >= 572) && (pMouse.y >= 412) && (pMouse.x <= 695) && (pMouse.y <= 580))  != 
					  ((pMouse.x >= 834) && (pMouse.y >= 279) && (pMouse.x <= 868) && (pMouse.y <= 323))){
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_posicao != 12)
						soundEfx3.play();
						som_posicao = 12;
						
						pick = 12;
						if(pick_atual != 12)
						desenhar_position();
						pick_atual = 12;
					}
				}
				
				if(evento_mouse_tutorial == "tutorial"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					
					if((pMouse.x >= 565) && (pMouse.y >= 499) && (pMouse.x <= 831) && (pMouse.y <= 561)){
						
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_tutorial != 1)
						soundEfx3.play();
						som_tutorial = 1;
						
					}  else {
						som_tutorial = 0;
						
					}
			}
			
			
				if(evento_mouse_salas_online == "online"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					
					if((pMouse.x >= 565) && (pMouse.y >= 499) && (pMouse.x <= 831) && (pMouse.y <= 561)){
						
						soundEfx3 = document.getElementById("soundEfx3");
						if(som_tutorial != 1)
						soundEfx3.play();
						som_tutorial = 1;
						
					}  else {
						som_tutorial = 0;
						
					}
			}
			
			
			}
			
			// EVENTOS CLIQUE DE MOUSE
			canvasMouse.onmousedown = function(e) {
			
			// EVENTO DO MENU 1
			if(evento_mouse == "Menu1"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 587) && (pMouse.y >= 334) && (pMouse.x <= 860) && (pMouse.y <= 398)){
						clearInterval(animacao_menu);
				 		clearInterval(intervalo_menu);
						GameLoop();
				 		indiceMenu1 = false;
						evento_mouse = "";
					}
					if((pMouse.x >= 603) && (pMouse.y >= 426) && (pMouse.x <= 847) && (pMouse.y <= 480)){
						clearInterval(animacao_menu);
				 		clearInterval(intervalo_menu);
						GameLoop();
				 		indiceMenu1 = false;
						evento_mouse = "";
					}
					if((pMouse.x >= 604) && (pMouse.y >= 511) && (pMouse.x <= 847) && (pMouse.y <= 566)){
						clearInterval(animacao_menu);
				 		clearInterval(intervalo_menu);
						GameLoop();
				 		indiceMenu1 = false;
						evento_mouse = "";
					}
					if((pMouse.x >= 65) && (pMouse.y >= 34) && (pMouse.x <= 334) && (pMouse.y <= 117)){
						clearInterval(animacao_menu);
				 		clearInterval(intervalo_menu);
						GameLoop();
				 		indiceMenu1 = false;
						evento_mouse = "";
					}
				}
				
			// EVENTO DO MENU 2
			if(evento_mouse == "Menu2"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 148) && (pMouse.y >= 128) && (pMouse.x <= 434) && (pMouse.y <= 556)){
						if(IndMenu == 1)
						bg_fundo = CriarImagem('img/Oponentes/Novatos/OpVoltar.jpg', Fundo);
						else if(IndMenu == 2)
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpEVoltar.jpg', Fundo);
						evento_mouse = "";
						window.setTimeout(function(){
						evento_mouse = "Menu3";
						}, 500);
						SplashTry4();
					}
					if((pMouse.x >= 456) && (pMouse.y >= 128) && (pMouse.x <= 741) && (pMouse.y <= 556)){
						if(IndMenu == 1)
						bg_fundo = CriarImagem('img/Oponentes/Novatos/OpVoltar.jpg', Fundo);
						else if(IndMenu == 2)
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpEVoltar.jpg', Fundo);
						evento_mouse = "";
						window.setTimeout(function(){
						evento_mouse = "Menu3";
						}, 500);
						SplashTry4();
					}
					if((pMouse.x >= 688) && (pMouse.y >= 34) && (pMouse.x <= 842) && (pMouse.y <= 87)){
						Voltar1();
					}
			}	
			
			// EVENTO DO MENU 3
			if(evento_mouse == "Menu3"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
					if((pMouse.x >= 116) && (pMouse.y >= 124) && (pMouse.x <= 197) && (pMouse.y <= 196)){
						IOponente = 1;
						IOponenteE = 1;
						if(IndMenu == 1){
						EscolherNovato(IOponente);
							NA_Atual = 1;
							if(NAcesso >= 1){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}else if(IndMenu == 2){
								NA_Atual = 9;
						EscolherElite(IOponenteE);
							if(NAcesso >= 9){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						btn_combater = true;
					} else
					if((pMouse.x >= 198) && (pMouse.y >= 124) && (pMouse.x <= 284) && (pMouse.y <= 196)){
						IOponente = 2;
						IOponenteE = 2;
						if(IndMenu == 1){
								NA_Atual = 2;
						EscolherNovato(IOponente);
						if(NAcesso >= 2){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						else if(IndMenu == 2){
								NA_Atual = 10;
						EscolherElite(IOponenteE);
						if(NAcesso >= 10){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						btn_combater = true;
					} else
					if((pMouse.x >= 285) && (pMouse.y >= 124) && (pMouse.x <= 370) && (pMouse.y <= 196)){
						IOponente = 3;
						IOponenteE = 3;
						if(IndMenu == 1){
								NA_Atual = 3;
						EscolherNovato(IOponente);
						if(NAcesso >= 3){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						else if(IndMenu == 2){
								NA_Atual = 11;
						EscolherElite(IOponenteE);
						if(NAcesso >= 11){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						btn_combater = true;
					} else
					if((pMouse.x >= 371) && (pMouse.y >= 124) && (pMouse.x <= 457) && (pMouse.y <= 196)){
						IOponente = 4;
						IOponenteE = 4;
						if(IndMenu == 1){
								NA_Atual = 4;
						EscolherNovato(IOponente);
						if(NAcesso >= 4){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						else if(IndMenu == 2){
								NA_Atual = 12;
						EscolherElite(IOponenteE);
						if(NAcesso >= 12){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						btn_combater = true;
					} else
					if((pMouse.x >= 458) && (pMouse.y >= 124) && (pMouse.x <= 544) && (pMouse.y <= 196)){
						IOponente = 5;
						IOponenteE = 5;
						if(IndMenu == 1){
								NA_Atual = 5;
						EscolherNovato(IOponente);
						if(NAcesso >= 5){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						else if(IndMenu == 2){
								NA_Atual = 13;
						EscolherElite(IOponenteE);
						if(NAcesso >= 13){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						btn_combater = true;
					} else
					if((pMouse.x >= 545) && (pMouse.y >= 124) && (pMouse.x <= 631) && (pMouse.y <= 196)){
						IOponente = 6;
						IOponenteE = 6;
						if(IndMenu == 1){
								NA_Atual = 6;
						EscolherNovato(IOponente);
						if(NAcesso >= 6){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						else if(IndMenu == 2){
								NA_Atual = 14;
						EscolherElite(IOponenteE);
						if(NAcesso >= 14){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						btn_combater = true;
					} else
					if((pMouse.x >= 632) && (pMouse.y >= 124) && (pMouse.x <= 711) && (pMouse.y <= 196)){
						IOponente = 7;
						IOponenteE = 7;
						if(IndMenu == 1){
								NA_Atual = 7;
						EscolherNovato(IOponente);
						if(NAcesso >= 7){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						
						}
						else if(IndMenu == 2){
								NA_Atual = 15;
						EscolherElite(IOponenteE);
						if(NAcesso >= 15){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						btn_combater = true;
					} else
					if((pMouse.x >= 712) && (pMouse.y >= 124) && (pMouse.x <= 802) && (pMouse.y <= 196)){
						IOponente = 8;
						IOponenteE = 8;
						if(IndMenu == 1){
								NA_Atual = 8;
						EscolherNovato(IOponente);
						if(NAcesso >= 8){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						else if(IndMenu == 2){
								NA_Atual = 16;
						EscolherElite(IOponenteE);
						if(NAcesso >= 16){
								oponente_desbloq = true;
							} else {
								oponente_desbloq = false;
							}
						}
						btn_combater = true;
					} else
					if((pMouse.x >= 75) && (pMouse.y >= 32) && (pMouse.x <= 229) && (pMouse.y <= 84)){
						EscolherNada();
						evento_mouse = "Menu2";
					}
			}
			
			// EVENTO DE CLICAR NO BOTÃO COMBATER
			if(btn_combater == true){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
					if((pMouse.x >= 327) && (pMouse.y >= 495) && (pMouse.x <= 521) && (pMouse.y <= 549) && (oponente_desbloq == true)){
						if(IndMenu == 1)
						ComecarPartida(IOponente, 'novato', regiao);
						else if(IndMenu == 2)
						ComecarPartida(IOponente, 'elite', regiao);
						evento_mouse = "";
						btn_combater = false;
					}
			}
			
			// EVENTO DO MENU 4
			if(evento_mouse == "Menu4"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
					if((pMouse.x >= 339) && (pMouse.y >= 501) && (pMouse.x <= 492) && (pMouse.y <= 543)){
						if(funcao_jogador=="atacar")
						vez_de_jogar = "jogador";
						else
						vez_de_jogar = "oponente";
						
						click_enter_now = false;
						
						soundEfx = document.getElementById("soundEfx");
				soundEfx.pause();
				soundEfx2 = document.getElementById("soundEfx2");
				soundEfx2.play();
						
						init();
						evento_mouse = "";
					}
			}
			
			// EVENTO DO MENU 5
			if(evento_mouse == "Menu5"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 601) && (pMouse.y >= 481) && (pMouse.x <= 855) && (pMouse.y <= 526)){
						location.href="application.php?relog=validate&xp="+xp_ganho+"&cristais="+cristais_ganho+"&sf="+resultado_final_do_jogo+"&elo="+elo_totais+"&NAtual="+NA_Atual;
					}
			}
			
			// EVENTO DE CLICAR NA CARTA
			if(evento_mouse_clique == "Clicar_Carta"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if((pMouse.x >= 773) && (pMouse.y >= 400) && (pMouse.x <= 877) && (pMouse.y <= 560)){
						indice_carta = 1;
						evento_mouse_clique = "";
						confirmar();
						evento_mouse = "Confirm_Cancel";
					}
					if((pMouse.x >= 756) && (pMouse.y >= 400) && (pMouse.x <= 774) && (pMouse.y <= 560)){
						if(qtd_cartas_disponiveis < 5){
						indice_carta = 2;
						evento_mouse_clique = "";
						confirmar();
						evento_mouse = "Confirm_Cancel";
						}
					}
					if((pMouse.x >= 744) && (pMouse.y >= 400) && (pMouse.x <= 755) && (pMouse.y <= 560)){
						if(qtd_cartas_disponiveis < 4){
						indice_carta = 3;
						evento_mouse_clique = "";
						confirmar();
						evento_mouse = "Confirm_Cancel";
						}
					}
					if((pMouse.x >= 734) && (pMouse.y >= 400) && (pMouse.x <= 743) && (pMouse.y <= 560)){
						if(qtd_cartas_disponiveis < 3){
						indice_carta = 4;
						evento_mouse_clique = "";
						confirmar();
						evento_mouse = "Confirm_Cancel";
						}
					}
					if((pMouse.x >= 721) && (pMouse.y >= 400) && (pMouse.x <= 733) && (pMouse.y <= 560)){
						if(qtd_cartas_disponiveis < 2){
						indice_carta = 5;
						evento_mouse_clique = "";
						confirmar();
						evento_mouse = "Confirm_Cancel";
						}
					}
					if((pMouse.x >= 707) && (pMouse.y >= 400) && (pMouse.x <= 720) && (pMouse.y <= 560)){
						if(qtd_cartas_disponiveis < 1){
						indice_carta = 6;
						evento_mouse_clique = "";
						confirmar();
						evento_mouse = "Confirm_Cancel";
						}
					}
				}
				
			// EVENTO DE CONFIRMAR CARTA PARA JOGAR
			if(evento_mouse == "Confirm_Cancel"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					
					if((pMouse.x >= 738) && (pMouse.y >= 364) && (pMouse.x <= 788) && (pMouse.y <= 390)){
					
					if(vez_de_jogar == "jogador")
					vez_de_jogar = "oponente";
					
					window.setTimeout(drawImageSeq(), 10);
					
					qtd_cartas_disponiveis++;
					
					evento_mouse_posicao_jogar = "Selecionar_Posicao";
					
					}
					
					
					if((pMouse.x >= 804) && (pMouse.y >= 364) && (pMouse.x <= 858) && (pMouse.y <= 390)){
					if(finish_round > 0)
					finish_round--;
					drawImageSeq();
					Dialogo_Jogador(true,false,false);
					evento_mouse_clique = "Clicar_Carta";
					evento_mouse_posicao_jogar = "";
					}
				}
				
			// EVENTO DE SELECIONAR POSIÇÃO PARA JOGAR
			if(evento_mouse_posicao_jogar == "Selecionar_Posicao"){
					var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					if(((pMouse.x >= 197) && (pMouse.y >= 77) && (pMouse.x <= 319) && (pMouse.y <= 243)) != 
					  ((pMouse.x >= 731) && (pMouse.y >= 190) && (pMouse.x <= 765) && (pMouse.y <= 232))){
					finalizar_jogada();
					}
					if(((pMouse.x >= 323) && (pMouse.y >= 77) && (pMouse.x <= 445) && (pMouse.y <= 243)) != 
					  ((pMouse.x >= 765) && (pMouse.y >= 190) && (pMouse.x <= 800) && (pMouse.y <= 232))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 447) && (pMouse.y >= 77) && (pMouse.x <= 570) && (pMouse.y <= 243)) != 
					  ((pMouse.x >= 801) && (pMouse.y >= 190) && (pMouse.x <= 834) && (pMouse.y <= 232))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 572) && (pMouse.y >= 77) && (pMouse.x <= 695) && (pMouse.y <= 243)) != 
					  ((pMouse.x >= 834) && (pMouse.y >= 190) && (pMouse.x <= 868) && (pMouse.y <= 232))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 197) && (pMouse.y >= 246) && (pMouse.x <= 319) && (pMouse.y <= 410))  != 
					  ((pMouse.x >= 731) && (pMouse.y >= 233) && (pMouse.x <= 765) && (pMouse.y <= 277))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 323) && (pMouse.y >= 246) && (pMouse.x <= 445) && (pMouse.y <= 410))  != 
					  ((pMouse.x >= 765) && (pMouse.y >= 233) && (pMouse.x <= 800) && (pMouse.y <= 277))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 447) && (pMouse.y >= 246) && (pMouse.x <= 570) && (pMouse.y <= 410))  != 
					  ((pMouse.x >= 800) && (pMouse.y >= 233) && (pMouse.x <= 834) && (pMouse.y <= 277))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 572) && (pMouse.y >= 246) && (pMouse.x <= 695) && (pMouse.y <= 410))  != 
					  ((pMouse.x >= 834) && (pMouse.y >= 233) && (pMouse.x <= 868) && (pMouse.y <= 277))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 197) && (pMouse.y >= 412) && (pMouse.x <= 319) && (pMouse.y <= 580))  != 
					  ((pMouse.x >= 731) && (pMouse.y >= 279) && (pMouse.x <= 765) && (pMouse.y <= 323))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 323) && (pMouse.y >= 412) && (pMouse.x <= 445) && (pMouse.y <= 580))  != 
					  ((pMouse.x >= 765) && (pMouse.y >= 279) && (pMouse.x <= 800) && (pMouse.y <= 323))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 447) && (pMouse.y >= 412) && (pMouse.x <= 570) && (pMouse.y <= 580))  != 
					  ((pMouse.x >= 800) && (pMouse.y >= 279) && (pMouse.x <= 834) && (pMouse.y <= 323))){
						finalizar_jogada();
					}
					if(((pMouse.x >= 572) && (pMouse.y >= 412) && (pMouse.x <= 695) && (pMouse.y <= 580))  != 
					  ((pMouse.x >= 834) && (pMouse.y >= 279) && (pMouse.x <= 868) && (pMouse.y <= 323))){
						finalizar_jogada();
					}
				}
				
				if(evento_mouse_tutorial == "tutorial"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
					if((pMouse.x >= 565) && (pMouse.y >= 499) && (pMouse.x <= 831) && (pMouse.y <= 561)&&(tutorial_next==true)){
						if(tutorial_i > 7){
						Voltar1();
						tutorial_i = 1;	
						evento_mouse_tutorial = "";
						} else {
						tutorial_i++;
						tutorial_partes(tutorial_i);
						}
						
					} 
			}
			
			if(evento_mouse_salas_online == "online"){
                    var pMouse = windowToCanvas(canvasMouse, e.clientX, e.clientY);
   					
					if((pMouse.x >= 565) && (pMouse.y >= 499) && (pMouse.x <= 831) && (pMouse.y <= 561)){
						
						Voltar1();
						evento_mouse_salas_online = "";
						
						
					}
			}
				
			}
}