<?php


interface Mediator {
    public function enviarMensagem($mensagem, $jogador);
}


class Arbitro implements Mediator {
    private $jogador1;
    private $jogador2;

    
    public function registrarJogadorA($jogador) {
        $this->jogador1 = $jogador;
    }

    public function registrarJogadorB($jogador) {
        $this->jogador2 = $jogador;
    }

   
    public function enviarMensagem($mensagem, $jogador) {
        if ($jogador === $this->jogador1) {
            echo "Árbitro fala para o jogador 2: $mensagem<br>";
            $this->jogador2->receberMensagem($mensagem);
        } elseif ($jogador === $this->jogador2) {
            echo "Árbitro fala para o jogador 1: $mensagem<br>";
            $this->jogador1->receberMensagem($mensagem);
        }
    }
}


class Jogador {
    private $nome;
    private $mediador;

    public function __construct($nome, $mediador) {
        $this->nome = $nome;
        $this->mediador = $mediador;
    }

    public function enviarMensagem($mensagem) {
        echo "$this->nome fala pro juiz: $mensagem<br>";
        $this->mediador->enviarMensagem($mensagem, $this);
    }

    public function receberMensagem($mensagem) {
        echo "$this->nome recebeu: $mensagem<br>";
    }
}

function realizarTestes() { 
    $arbitro = new Arbitro();
    $jogador1 = new Jogador("Jogador 1", $arbitro);
    $jogador2 = new Jogador("Jogador 2", $arbitro);
    $arbitro->registrarJogadorA($jogador1);
    $arbitro->registrarJogadorB($jogador2);

    $jogador1->enviarMensagem("toca a bola");
    $jogador2->enviarMensagem("nao da pra tocar agora");
}

realizarTestes();

?>
