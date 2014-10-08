function carregaImagem() {
				bg_fundo = CriarImagem('img/MenuTry0/SoloBG.png', Fundo);
				
				if(indice == 1){
					bg_fundo = CriarImagem('img/MenuTry0/SoloBG.png', Fundo);
				}
				if(indice == 2){
					bg_fundo = CriarImagem('img/MenuTry0/SoloBG1.png', Fundo);
				}
				if(indice == 3){
					bg_fundo = CriarImagem('img/MenuTry0/SoloBG2.png', Fundo);
				}
				if(indice == 4){
					bg_fundo = CriarImagem('img/MenuTry0/SoloBG3.png', Fundo)
				}
            }
			
			
			function Voltar1(){
			evento_mouse = "Menu1";
						indiceMenu1 = true;
						indice = 1;
						estado = true;
						carregaImagem();
						voltar1 = false;
						window.setTimeout(function() {imagePPT1 = new Image();imagePPT1.src = "img/animation_menu/SoloBG.jpg";DesenharPPT(imagePPT1, 0, 201);}, 1);
						animacao_menu_init();
						animacao_menu = window.setInterval(function() {
						animacao_menu_init();
				}, 2300);	
			}
			
			
			function EscolherAdversario1(){
				IndMenu = 1;
				bg_fundo = CriarImagem('img/select/select_novatos.jpg', Fundo);
			}
			
			function EscolherAdversario2(){
				IndMenu = 2;
				bg_fundo = CriarImagem('img/select/select_elite.jpg', Fundo);
			}
			
			function EscolherVoltar(){
				bg_fundo = CriarImagem('img/select/select_back.jpg', Fundo);
			}
			
			function EscolherNada(){
				bg_fundo = CriarImagem('img/select/select_none.jpg', Fundo);
			}
			
			function SplashTry4(){
				
			if(IndMenu == 1){
				bg_fundo = CriarImagem('img/Oponentes/Novatos/Opnone.jpg', Fundo);
			}
			if(IndMenu == 2){
				bg_fundo = CriarImagem('img/Oponentes/Elites/OpEnone.jpg', Fundo);
			}
		
			}
			
			
			function EscolherNovato(IA){
				if(IA == 1){
						regiao = "espirito";
						oponente_name = "Kana";
						bg_fundo = CriarImagem('img/Oponentes/Novatos/Op1.jpg', Fundo);
				}
				if(IA == 2){
						regiao = "terra";
						oponente_name = "Kimura";
						bg_fundo = CriarImagem('img/Oponentes/Novatos/Op2.jpg', Fundo);
				}
				if(IA == 3){
						regiao = "agua";
						oponente_name = "Masaki";
						bg_fundo = CriarImagem('img/Oponentes/Novatos/Op3.jpg', Fundo);
				}
				if(IA == 4){
						regiao = "ar";
						oponente_name = "Nick";
						bg_fundo = CriarImagem('img/Oponentes/Novatos/Op4.jpg', Fundo);
				}
				if(IA == 5){
						regiao = "fogo";
						oponente_name = "Osaki";
						bg_fundo = CriarImagem('img/Oponentes/Novatos/Op5.jpg', Fundo);
				}
				if(IA == 6){
						regiao = "terra";
						oponente_name = "Sanzo";
						bg_fundo = CriarImagem('img/Oponentes/Novatos/Op6.jpg', Fundo);
				}
				if(IA == 7){
						regiao = "ar";
						oponente_name = "Yuka";
						bg_fundo = CriarImagem('img/Oponentes/Novatos/Op7.jpg', Fundo);
				}				
				if(IA == 8){
						regiao = "fogo";
						oponente_name = "Takaya";
						bg_fundo = CriarImagem('img/Oponentes/Novatos/Op8.jpg', Fundo);
				}
			}
			
			function EscolherElite(IAE){
				if(voltar2 == true){
					window.setTimeout(function() {imagePPT = new Image();imagePPT.src = "img/select/back_.png";DesenharPPT(imagePPT, 0, 0);}, 1);	
					tela_negra = true;
				} else {
				if((IAE == 1)&&(elite1==true)){
						regiao = "fogo";
						oponente_name = "Namae";
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpE1.jpg', Fundo);
				}
				if((IAE == 2)&&(elite2==true)){
						regiao = "espirito";
						oponente_name = "Haru";
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpE2.jpg', Fundo);
				}
				if((IAE == 3)&&(elite3==true)){
						regiao = "agua";
						oponente_name = "Nana";
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpE3.jpg', Fundo);
				}
				if((IAE == 4)&&(elite4==true)){
						regiao = "ar";
						oponente_name = "Shin";
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpE4.jpg', Fundo);
				}
				if((IAE == 5)&&(elite5==true)){
						regiao = "espirito";
						oponente_name = "Akemi";
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpE5.jpg', Fundo);
				}
				if((IAE == 6)&&(elite6==true)){
						regiao = "terra";
						oponente_name = "Satoshi";
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpE6.jpg', Fundo);
				}
				if((IAE == 7)&&(elite7==true)){
						regiao = "fogo";
						oponente_name = "Ryu";
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpE7.jpg', Fundo);
				}				
				if((IAE == 8)&&(elite8==true)){
						regiao = "ar";
						oponente_name = "Takeshi";
						bg_fundo = CriarImagem('img/Oponentes/Elites/OpE8.jpg', Fundo);
				}
				}
			}
			
			
			function Selecionar_Desenhar(){
						
						if(vez_de_jogar == "jogador"){
						imagePPT = new Image();
						imagePPT.src = "img/escolher/primeiro_re.png"; 
						DesenharPPT(imagePPT, 240, 250);
						}
						if(vez_de_jogar == "oponente"){
						imagePPT2 = new Image();
						imagePPT2.src = "img/escolher/segundo_re.png"; 
						DesenharPPT(imagePPT2, 240, 250);
						}
		}
		
		
				function mostrar_cartas(){
			
						window.setTimeout(function() {
							bg_fundo = CriarImagem('img/back_ground_game_show_cards_template.jpg', Fundo);
						}, 1);
				window.setTimeout(function() {
				Carta_drawn = new Image();
				 var url_img = cartas_usuario[0].nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(cartas_usuario[0].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(cartas_usuario[0].nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }	
				Carta_drawn.src = "img/ddl_cartas/"+url_img+".png"; 
				DesenharCarta_tabuleiro(Carta_drawn, cartas_usuario[0].burst, cartas_usuario[0].rage, cartas_usuario[0].ataque, cartas_usuario[0].defesa, 254, 126, 305, 172, 305, 286, 260, 228, 351, 228);
			}, 100);
			window.setTimeout(function() {
				Carta_drawn = new Image();
				var url_img = cartas_usuario[1].nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(cartas_usuario[1].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(cartas_usuario[1].nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }	
				Carta_drawn.src = "img/ddl_cartas/"+url_img+".png"; 
				DesenharCarta_tabuleiro(Carta_drawn, cartas_usuario[1].burst, cartas_usuario[1].rage, cartas_usuario[1].ataque, cartas_usuario[1].defesa, 378, 126, 429, 172, 429, 286, 384, 228, 475, 228);
			}, 100);
			window.setTimeout(function() {
				Carta_drawn = new Image();
				var url_img = cartas_usuario[2].nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(cartas_usuario[2].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(cartas_usuario[2].nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }	
				Carta_drawn.src = "img/ddl_cartas/"+url_img+".png"; 
				DesenharCarta_tabuleiro(Carta_drawn, cartas_usuario[2].burst, cartas_usuario[2].rage, cartas_usuario[2].ataque, cartas_usuario[2].defesa, 502, 126, 553, 172, 553, 286, 508, 228, 599, 228);
			}, 100);
			window.setTimeout(function() {
				Carta_drawn = new Image();
				var url_img = cartas_usuario[3].nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(cartas_usuario[3].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(cartas_usuario[3].nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn.src = "img/ddl_cartas/"+url_img+".png"; 
				DesenharCarta_tabuleiro(Carta_drawn, cartas_usuario[3].burst, cartas_usuario[3].rage, cartas_usuario[3].ataque, cartas_usuario[3].defesa, 254, 294, 304, 340, 304, 454, 259, 396, 350, 396);
			}, 100);
			window.setTimeout(function() {
				Carta_drawn = new Image();
				var url_img = cartas_usuario[4].nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(cartas_usuario[4].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(cartas_usuario[4].nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn.src = "img/ddl_cartas/"+url_img+".png"; 
				DesenharCarta_tabuleiro(Carta_drawn, cartas_usuario[4].burst, cartas_usuario[4].rage, cartas_usuario[4].ataque, cartas_usuario[4].defesa, 378, 294, 429, 340, 429, 454, 384, 396, 475, 396);
			}, 100);
			window.setTimeout(function() {
				Carta_drawn = new Image();
				var url_img = cartas_usuario[5].nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(cartas_usuario[5].nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(cartas_usuario[5].nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn.src = "img/ddl_cartas/"+url_img+".png"; 
				DesenharCarta_tabuleiro(Carta_drawn, cartas_usuario[5].burst, cartas_usuario[5].rage, cartas_usuario[5].ataque, cartas_usuario[5].defesa, 502, 294, 553, 340, 553, 454, 508, 396, 599, 396);
			}, 100);
		
			evento_mouse = "Menu4";
		}


		function desenhar_pontuacao(){
			window.setTimeout(function(){
			if(lacaios_jogador < 10){
						str_pontos_jogador = "0"+lacaios_jogador;
					} else {
						str_pontos_jogador = lacaios_jogador;
					}
					if(lacaios_oponente < 10){
						str_pontos_oponente = "0"+lacaios_oponente;
					} else {
						str_pontos_oponente = lacaios_oponente;
					}
					
					if(funcao_jogador_rend=="defense")
					des_pontuacao(str_pontos_jogador, str_pontos_oponente, oponente_name, jogador_name, funcao_jogador);
					else 
					des_pontuacao(str_pontos_oponente, str_pontos_jogador, oponente_name, jogador_name, funcao_jogador);	
			
			},1);
		}
		

			function CentralizarCarta(){
			window.setTimeout(function() {
			Carta_drawn = new Image()
			Carta_drawn.src = "img/ddl_cartas/"+cartas_usuario[mid_lane].nome.toLowerCase()+".png"; 
			  DesenharCarta_tabuleiro(Carta_drawn, cartas_usuario[mid_lane].burst, cartas_usuario[mid_lane].rage, cartas_usuario[mid_lane].ataque, cartas_usuario[mid_lane].defesa, 744, 160, 795, 205, 795, 318, 753, 261, 840, 261);
			 }, 50);
			}
			
			
			function desenhar_position(){
				
				if(pick == 1){
			
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar1.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				}
				
				if(pick == 2){
					
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar2.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				
				}
				if(pick == 3){
					
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar3.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				
				}
				if(pick == 4){
					
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar4.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				
				}
				if(pick == 5){
					
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar5.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
					
				}
				if(pick == 6){
					
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar6.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				
				}
				if(pick == 7){
				
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar7.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				
				}
				
				if(pick == 8){
				
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar8.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				
				}
				if(pick == 9){
				
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar9.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				
				}
				
				if(pick == 10){
				
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar10.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				
				}
				
				
				if(pick == 11){
				
				
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar11.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
				
				}
				
			if(pick == 12){
					
				window.setTimeout(function(){
				imagePPT = new Image();
				imagePPT.src = "img/game_selecionar12.jpg"; 
				DesenharPPT(imagePPT, 700, 112);
				}, 1);
			}
			}
			
			
			function desenhar_carta_position(carta, posicao, estado){
				
			if(posicao == 1){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 78, 250, 124, 250, 238, 204, 180, 295, 180);
				}, 1);
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 78, 250, 124, 250, 238, 204, 180, 295, 180);
				}, 1);
				}
			}
			
			if(posicao == 2){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 78, 375, 124, 375, 238, 329, 180, 420, 180);
				}, 1);
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 78, 375, 124, 375, 238, 329, 180, 420, 180);
				}, 1);
				}
			}
			
			if(posicao == 3){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 78, 500, 124, 500, 238, 454, 180, 545, 180);
			}, 1);	
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 78, 500, 124, 500, 238, 454, 180, 545, 180);
			}, 1);	
				}
			}
			
			if(posicao == 4){
				if(estado=="atack"){	
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 78, 625, 124, 625, 238, 579, 180, 670, 180);
			}, 1);	
				} else
				if(estado=="defense"){	
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 78, 625, 124, 625, 238, 579, 180, 670, 180);
			}, 1);	
				}
			}
			
			if(posicao == 5){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 246, 250, 292, 250, 406, 204, 348, 295, 348);
			}, 1);	
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 246, 250, 292, 250, 406, 204, 348, 295, 348);
			}, 1);	
				}
			}
			
			
			if(posicao == 6){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 246, 375, 292, 375, 406, 329, 348, 420, 348);
			}, 1);	
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 246, 375, 292, 375, 406, 329, 348, 420, 348);
			}, 1);	
				}
			}
			
			
			if(posicao == 7){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 246, 500, 292, 500, 406, 454, 348, 545, 348);
			}, 1);	
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 246, 500, 292, 500, 406, 454, 348, 545, 348);
			}, 1);	
				}
			}
			
			
			if(posicao == 8){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 246, 625, 292, 625, 406, 579, 348, 670, 348);
			}, 1);	
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 246, 625, 292, 625, 406, 579, 348, 670, 348);
			}, 1);	
				}
			}
			
			if(posicao == 9){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 412, 250, 458, 250, 572, 204, 514, 295, 514);
			}, 1);	
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 199, 412, 250, 458, 250, 572, 204, 514, 295, 514);
			}, 1);	
				}
			}
			
			
			if(posicao == 10){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 412, 375, 458, 375, 572, 329, 514, 420, 514);
			}, 1);	
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 324, 412, 375, 458, 375, 572, 329, 514, 420, 514);
			}, 1);	
				}
			}
			
			if(posicao == 11){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 412, 500, 458, 500, 572, 454, 514, 545, 514);
			}, 1);	
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 449, 412, 500, 458, 500, 572, 454, 514, 545, 514);
			}, 1);	
				}
			}
			
			if(posicao == 12){	
				if(estado=="atack"){
				window.setTimeout(function() {
				Carta_drawn_atack = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_atack.src = "img/ddl_cartas/"+url_img+"_atack.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_atack, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 412, 625, 458, 625, 572, 579, 514, 670, 514);
			}, 1);
				} else
				if(estado=="defense"){
				window.setTimeout(function() {
				Carta_drawn_defense = new Image();
				var url_img = carta.nome.toLowerCase();
				 url_img = url_img.replace(" ","_");
				 if(carta.nome.toLowerCase() == "fate - e"){
				 url_img = "fate-e";
				 } else
				 if(carta.nome.toLowerCase() == "fate - k"){
				  url_img = "fate-k";
				 }
				Carta_drawn_defense.src = "img/ddl_cartas/"+url_img+"_defense.png"; 
				DesenharCarta_tabuleiro(Carta_drawn_defense, carta.burst, carta.rage, carta.ataque, carta.defesa, 574, 412, 625, 458, 625, 572, 579, 514, 670, 514);
			}, 1);
				}
			}
			
					renderizar_cartas = true;
					round_animation();
				
				
			}
			
			
		function confirmar(){
			window.setTimeout(function() {imgLight = new Image();imgLight.src = "img/btn_in_game/confirmar.png";DesenhaP(imgLight, 705, 311);}, 1);
		}
		
		function cancelar(){
			window.setTimeout(function() {imgLight = new Image();imgLight.src = "img/btn_in_game/voltar.png";DesenhaP(imgLight, 705, 311);}, 1);
		}
		
		function tutorial_partes(parte){
			tutorial_next = false;
			if(parte == 1){
				bg_fundo = CriarImagem('img/tutorial/tutorial_1.jpg', Fundo);
			} else 
			if(parte == 2){
				bg_fundo = CriarImagem('img/tutorial/tutorial_2.jpg', Fundo);
			} else 
			if(parte == 3){
				bg_fundo = CriarImagem('img/tutorial/tutorial_3.jpg', Fundo);
			} else 
			if(parte == 4){
				bg_fundo = CriarImagem('img/tutorial/tutorial_4.jpg', Fundo);
			} else 
			if(parte == 5){
				bg_fundo = CriarImagem('img/tutorial/tutorial_5.jpg', Fundo);
			} else 
			if(parte == 6){
				bg_fundo = CriarImagem('img/tutorial/tutorial_6.jpg', Fundo);
			} else 
			if(parte == 7){
				bg_fundo = CriarImagem('img/tutorial/tutorial_7.jpg', Fundo);
			}
			window.setTimeout(function(){
				tutorial_next = true;
			}, 3000);
		}
		
		
		function salas_online(){
			bg_fundo = CriarImagem('img/tutorial/desenvolvimento.jpg', Fundo);
		}