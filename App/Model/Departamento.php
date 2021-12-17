<?php
namespace App\Model;

class Departamento
{
    private $id, $nome, $centro_de_custo_id;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    
    public function getCentroDeCustoId()
    {
        return $this->centro_de_custo_id;
    }

    public function setCentroDeCustoId($centro_de_custo_id)
    {
        $this->centro_de_custo_id = $centro_de_custo_id;
    }
}