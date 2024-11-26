<?php


interface Observer {
    public function notificar($mensagem);
}


class Placar {
    private $observar = []; // Lista de observadores
    private $placarAtual;

  
    public function registrarObserver(Observer $observer) {
        $this->observar[] = $observer;
    }

    public function cancelarRegistroObserver(Observer $observer) {
        $this->observar = array_filter($this->observar, function($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    public function notificarObservers() {
        foreach ($this->observar as $observer) {
            $observer->notificar($this->placarAtual);
        }
    }

    
    public function atualizarPlacar($placar) {
        $this->placarAtual = $placar;
        $this->notificarObservers();
    }
}


class Torcedor implements Observer {
    private $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function notificar($mensagem) {
        echo "O Torcedor {$this->nome} foi notificado da atualização: {$mensagem}<br>";
    }
}


class Comentarista implements Observer {
    private $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function notificar($mensagem) {
        echo "O Comentarista {$this->nome} foi notificado da atualização: {$mensagem}<br>";
    }
}

function realizarTestes() {
   
    $placar = new Placar();


    $torcedor1 = new Torcedor("João");
    $torcedor2 = new Torcedor("Pedro");
    $comentarista1 = new Comentarista("Gustavo Vilani");
    $placar->registrarObserver($torcedor1);
    $placar->registrarObserver($torcedor2);
    $placar->registrarObserver($comentarista1);


    echo "<strong>Na primeira atualização do placar:</strong><br>";
    $placar->atualizarPlacar("Real Madrid 1 x 0 Barcelona");

    $placar->cancelarRegistroObserver($torcedor2);


    echo "<br><strong>Na segunda atualização do placar:</strong><br>";
    $placar->atualizarPlacar("Real Madrid 4 x 0 Barcelona");
}


realizarTestes();

?>

