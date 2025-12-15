<?php

class Usuario{

    private int $matricula;
    private string $nombre_usuario;
    private string $cargo_usuario;

    public function __construct(int $matricula, string $nombre_usuario, string $cargo_usuario) {
        $this->matricula = $matricula;
        $this->nombre_usuario = $nombre_usuario;
        $this->cargo_usuario = $cargo_usuario;
    }

    public function getMatricula():int{
        return $this->matricula;
    }

    public function getNombreUsuario():string{
        return $this->nombre_usuario;
    }

    public function getCargoUsuario():string{
        return $this->cargo_usuario;
    }

    public function setMatricula(int $matricula){
        $this->$matricula = $matricula;
    }
    public function setNombreUsuario(string $nombre_usuario){
        $this->$nombre_usuario = $nombre_usuario;
    }
    public function setCargoUsuario(string $cargo_usuario){
        $this->cargo_usuario = $cargo_usuario;
    }
}

?>