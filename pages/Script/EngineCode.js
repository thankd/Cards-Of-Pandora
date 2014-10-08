function retirar_carta_deck(){
				var id_carta_colocar = indice_carta - 1;
				cartas_renderizar[qtd_cartas_renderizar] = cartas_usuario[id_carta_colocar];
				local_tabuleiro[qtd_cartas_renderizar] = pick;
				estado_carta[qtd_cartas_renderizar] = funcao_jogador_rend;
				lacaios_jogador++;
				mudar_estado(qtd_cartas_renderizar, funcao_jogador_rend);
				qtd_cartas_renderizar++;
				qtd_cartas_jogadas++;
				
				// CONCERTAR ALGORITMO A BAIXO DE FILA, TIRAR CARTA E SOBREPOR - PESQUISAR IBI
				
				for(i = 0; i <= qtd_cartas_deck; i++){
					if((i>=id_carta_colocar)&&(i<=qtd_cartas_deck)){
						var aux_renderizar = i + 1;
						cartas_usuario[i] = cartas_usuario[aux_renderizar];
					}
					if(i==qtd_cartas_deck){
						cartas_usuario[i] = null;
					}
					
				}
				qtd_cartas_deck--;
			}


function resultado_final_jogo_para_pontos(lacaios_jogador, lacaios_oponente){
	if(lacaios_jogador > lacaios_oponente){
		resultado_final_do_jogo = "vitoria";
	} else if(lacaios_oponente > lacaios_jogador){
		resultado_final_do_jogo = "derrota";
		
	} else {
		resultado_final_do_jogo = "empate";
	}
}

			
function fim_do_jogo(){
			
			if(funcao_jogador_rend=="defense")
			resultado_final_jogo_para_pontos(str_pontos_jogador, str_pontos_oponente);
			else 
			resultado_final_jogo_para_pontos(str_pontos_oponente, str_pontos_jogador);

			
			if(resultado_final_do_jogo == "vitoria"){
			xp_ganho = random(200,250);
			cristais_ganho = random(200,250);
			elo_totais = random(70,100);
			} else if(resultado_final_do_jogo == "empate"){
			xp_ganho = random(150,200);
			cristais_ganho = random(150,200);
			elo_totais = random(50,70);
			} else if(resultado_final_do_jogo == "derrota"){
			xp_ganho = random(100,150);
			cristais_ganho = random(100,150);
			elo_totais = random(30,50);
			} 
			
		window.setTimeout(function(){
			window.setTimeout(desenhar_margem(),1);
			}, 2000);
		window.setTimeout(function(){
			window.setTimeout(placar_final(),1);
			}, 7000);
		window.setTimeout(function(){
					
					
					window.setTimeout(function(){
					
					if(funcao_jogador_rend=="defense")
					window.setTimeout(resultado_final(str_pontos_oponente, str_pontos_jogador), 1);
					else 
					window.setTimeout(resultado_final(str_pontos_jogador, str_pontos_oponente), 1);
					
			window.setTimeout(xp_cristais(xp_ganho, cristais_ganho, elo_totais), 1);
					}, 1000);
			
			}, 9000);
		window.setTimeout(function(){
				evento_mouse = "Menu5";
			}, 10000);
			
		}
		
function placar_final(){
				if(funcao_jogador_rend=="defense")
					window.setTimeout(Desenhar_placar(str_pontos_jogador, str_pontos_oponente), 1);
					else 
					window.setTimeout(Desenhar_placar(str_pontos_oponente, str_pontos_jogador), 1);
		}
		
		
		
		
		function mudar_estado(carta_id, modificar){
				var aux_cima = local_tabuleiro[carta_id] - 4;
				var verso = "";
				if(modificar == "atack"){
					verso = "atack";
				} else {
					verso = "defense";	
				}
				atack = 0;
				defense = 0;
				
				if((aux_cima > 0) && (aux_cima < 13)){ // localizador de posição
				  
					for(c = 1; c < local_tabuleiro.length; c++){
						if(local_tabuleiro[c] == aux_cima){
							if(cartas_renderizar[carta_id].burst > cartas_renderizar[c].rage){
								if(estado_carta[c] != modificar){
								estado_carta[c] = verso;
								if(verso=="atack"){
									atack++;
								} else {
									defense++;
								}
								break;}}}}
				  }
				var aux_baixo = local_tabuleiro[carta_id] + 4;
				if((aux_baixo > 0) && (aux_baixo < 13)){ 
					
					for(c = 1; c < local_tabuleiro.length; c++){ // localizador de tabuleiro
						if(local_tabuleiro[c] == aux_baixo){
							if(cartas_renderizar[carta_id].rage > cartas_renderizar[c].burst){
								if(estado_carta[c] != modificar){
								estado_carta[c] = verso;
								if(verso=="atack"){
									atack++;
								} else {
									defense++;
								}
								break;}}}}
				}
				
				var aux_esquerda = local_tabuleiro[carta_id] - 1;
				if((aux_esquerda > 0) && (aux_esquerda < 13) && (local_tabuleiro[carta_id] != 5) && (local_tabuleiro[carta_id] != 9)){ // verifica se a carta pode ter uma a esquerda
					
					for(c = 1; c < local_tabuleiro.length; c++){
						if(local_tabuleiro[c] == aux_esquerda){
							if(cartas_renderizar[carta_id].ataque > cartas_renderizar[c].defesa){
								if(estado_carta[c] != modificar){
								estado_carta[c] = verso;
								if(verso=="atack"){
									atack++;
								} else {
									defense++;
								}
								break;
								}
							}
						}
					}
					
				}
				var aux_direita = local_tabuleiro[carta_id] + 1;
				if((aux_direita > 0) && (aux_direita < 13) && (local_tabuleiro[carta_id] != 4) && (local_tabuleiro[carta_id] != 8)){ // verifica se a carta pode ter uma a direita
				
					
					for(c = 1; c < local_tabuleiro.length; c++){
						if(local_tabuleiro[c] == aux_direita){
							if(cartas_renderizar[carta_id].defesa > cartas_renderizar[c].ataque){
								if(estado_carta[c] != modificar){
								estado_carta[c] = verso;
								if(verso=="atack"){
									atack++;
								} else {
									defense++;
								}
								break;
								}
							}
						}
					}
					
				}
				
				window.setTimeout(function() {
					lacaios_jogador = 0;
					lacaios_oponente = 0;
					
					for(o = 1; o <= estado_carta.length; o++){
						if(estado_carta[o] == "atack"){
							lacaios_jogador++;
						} else if(estado_carta[o] == "defense") {
							lacaios_oponente++;	
						}
					}
					//LimparTela();
					drawImageSeq();
					if((funcao_jogador == "atacar") && (atack > defense)){
						
						// jogador atakando win
						window.setTimeout(Dialogo_Jogador(false, false, true), 1);
						
						
					} else if((funcao_jogador == "atacar") && (defense>atack)) {
						
						// oponente defendendo win
						window.setTimeout(Dialogo_Jogador(false, true, false), 1);
						
						
					} else if((funcao_jogador == "defender") && (defense>atack)) {
						
						// jogador defendendo win
						window.setTimeout(Dialogo_Jogador(false, false, true), 1);
						
						
					} else if((funcao_jogador == "defender") && (atack>defense)) {
						
						// oponente atakando win
						window.setInterval(Dialogo_Jogador(false, true, false), 1);
						 
						
					} else if(defense == atack){
						
					}
					
					}, 30);
				
			}
		
		
		function finalizar_jogada(){
				
					var lugar_vazio = false;
					if(local_tabuleiro.length > 1){
					for(b = 1; b < local_tabuleiro.length; b++){
						if(local_tabuleiro[b] == pick){
							lugar_vazio = false;
							break;
						} else {
							lugar_vazio = true;
						}
					}
					} else {
						lugar_vazio = true;	
					}
					
					
					if(lugar_vazio){
						evento_mouse_posicao_jogar = "";
						retirar_carta_deck();
						window.setTimeout(init(),500);
						pick = 6;
						pick_atual = 0;
						drawImageSeq();	
					} else if(lugar_vazio == false) {
						imageErro = new Image();
						imageErro.src = "img/territorio_ocupado.png"; 
						DesenharPPT(imageErro, 300, 300);
					}
				
			}
			
			
function ComecarPartida(id_oponente, nivel, regiao){
				
				if(nivel == "elite"){
					id_oponente += 8;
				}
				deck_oponente(id_oponente, regiao);
				Animacao_Comecar_Partida();
		}
		
		
function DrawTabuleiro(){
			window.setTimeout(function() {
			window.setTimeout(bg_fundo = CriarImagem('img/back_ground_game_tabuleiro.png', Fundo), 1);
			}, 1);
			
			if(qtd_cartas_renderizar > 1){
				renderizar_tabuleiro();
			}
			}
			
			
function random(par1, par2)
	{
    par1 = parseInt(par1);
    par2 = parseInt(par2);

    return (par1 + (Math.floor(Math.random() * (par2 + 1 - par1))));
	} 
	
function ran(i, f) {
			if (i > f) {numInicial = f;numFinal = i+1;}else{numInicial = i;numFinal = f+1;}
			numRandom = Math.floor((Math.random()*(numFinal-numInicial))+numInicial);
			return numRandom;
			}