var nomesImg = ["assets/img/LuffyGordo.jpg", "assets/img/Dolly.jpg", "assets/img/Ximbinha.jpg", "assets/img/xaropinho.png", "assets/img/LuffyGordo.jpg", "assets/img/Dolly.jpg", "assets/img/Ximbinha.jpg", "assets/img/xaropinho.png"];
var cartaYugi = "assets/img/CostasYugi.jpeg";
var nomesAtuais = [];
var target = [];
var pont = 0;
var cont = 0;
var contwin = 0;

window.onload = function(){
    let pontContador = document.querySelector("#pontCont");
    let nomesImgTemp = nomesImg;

    var img = document.querySelectorAll("img");
    for(let i = nomesImg.length-1; i>=0; i--){
        let aleatorio = Math.floor(Math.random() * i);
        let nome = nomesImgTemp[aleatorio];
        nomesImgTemp.splice(nomesImgTemp.indexOf(nome),1);
        nomesAtuais.push(nome);
    }
    

    var imagens = document.getElementsByClassName("imagem");
    for (let i = 0; i < imagens.length; i++) {
        imagens[i].addEventListener("click", function() {
            if(contwin != 4){
                if(target.length >= 2){
                    imagens[target[0]].setAttribute('src', cartaYugi);
                    imagens[target[1]].setAttribute('src', cartaYugi);
                    target = [];
                }
                if(cont < 2){
                    this.setAttribute('src', nomesAtuais[i]);
                    target.push(i);
                    if(target[0] === target[1]){
                        target.pop();
                    }else{
                        cont++;
                    }
                }
                if(cont >= 2){
                    if(nomesAtuais[target[0]] === nomesAtuais[target[1]]){
                        contwin++;
                        pont+=15;
                        target = [];
                    }
                    pont-=5;
                    let s = "Pontuação do Jogador: " + pont;
                    pontContador.innerText = s;
                    cont = 0;
                    if(contwin >= 4){
                        const jogo = document.querySelector(".jogo");
                        let msgWin = document.createElement("p");
                        msgWin.textContent = "Parabéns você ganhou o jogo";
                        jogo.appendChild(msgWin);
                    }
                }    
            }
        });
    }
    var botaoReload = document.querySelector(".reload");
    botaoReload.addEventListener("click", function() {
        location.reload();
    });
}







