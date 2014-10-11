![](http://i.imgur.com/oBORJaY.png)

## Cards Of Pandora — online game in html5 and js

**Cards of Pandora** é um projeto implementado durante 20 semanas pelo aluno thales r. onde fazendo o uso do html 5, propôs o desenvolvimento de um jogo utilizando essa nova tecnologia.o projeto foi implementado para ser o seu tcc (trabalho de conclusão de curso).

## Especificações

- **Mecanica Principal**

Em Cards of Pandora teremos dois personagens que jogaram um contra o outro, o jogador que está utilizando o sistema será um desses personagens, enquanto o outro será o adversário que é chamado de NPC (non-player character). O jogador para combater contra o adversário (NPC) terá que possuir um baralho com 8 cartas, onde dessas oito apenas seis serão sorteadas aleatoriamente para participarem do combate.

- **Combates**

Um combate de Cards of Pandora tem seis turnos, onde em cada turno cada jogador posiciona uma de suas seis cartas no tabuleiro, quando a carta é posicionada o jogador não pode mover nem retirar a carta do tabuleiro. Cada participante do combate terá uma função, que pode ser atacar ou defender, e que também será atribuída de forma aleatória logo no inicio do combate, quem for atacar começará jogando, enquanto quem ficar com a função de defesa será o segundo a jogar, esse fluxo permanecerá durante os seis turnos, onde no final da última jogada do cesto turno é dado o resultado final do combate.

- **Tabuleiro e Cartas**


Em Cards Of Pandora cada posição do tabuleiro é a representação de um território e a carta que estiver sobre determinada posição, terá aquele território. Cada carta possui 4 atributos, onde cada atributo é chamado com um nome especifico, que são: Burst, Rage, Ataque e Defesa.
Ao jogar uma carta você ganhará um território, é poderá pegar territórios inimigos, mas isso só será possível se o atributo da carta jogada for maior do que o atributo que estiver do lado da sua carta.

> Documento completo [updating]  

## Implementação

- **Game Loop - Principais funções**

**Initialize** – É a função que define os valores de todas as variáveis no início do jogo.

**LoadContent** – Essa função é encarregada de carregar todas as mídias necessárias para a execução do jogo.

**Update** – Executa a lógica do jogo, como por exemplo, calcular a posição atual de um objeto, colisões, coletar informações inseridas e tocar áudio.

**Draw** – Desenha o estado atual do jogo, em que cada objeto pode assumir uma nova posição, também é encarregada de desenhar o background.

**UnloadContent** – Descarrega tudo que foi usado.

![](http://i.imgur.com/yZst6ih.jpg)

## Implementação - Info ##
> O jogo conta com um sistema php para autenticação de usuário e armazenamento de seus dados em um banco de dados mysql.

> O Canvas principal onde o jogo é renderizado e armazenado no cache do navegador se encontra no arquivo : [pages/application.php](https://github.com/thankd/Cards-Of-Pandora/blob/master/pages/application.php). 

> Os arquivos (js) do jogo estão comentados e podem ser vistos na pasta: [pages/script](https://github.com/thankd/Cards-Of-Pandora/tree/master/pages/Script). 

## Screenshots

- **Menu**

>![](http://i.imgur.com/ONdEtlp.jpg)

- **Seleção de oponente**

![](http://i.imgur.com/LPWwdMC.jpg)

- **Combate**

![](http://i.imgur.com/3JzmiME.jpg)

- **Fim de jogo**

![](http://i.imgur.com/cbgmxcd.jpg)
