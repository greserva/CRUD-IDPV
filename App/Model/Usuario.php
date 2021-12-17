<?php
namespace App\Model;

class Usuario
{
    private $id, $nome, $email, $data_de_nascimento, $cpf, $cargo_id, $departamento_id, $senha;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getDataDeNascimento()
    {
        return $this->data_de_nascimento;
    }

    public function setDataDeNascimento($data_de_nascimento)
    {
        $this->data_de_nascimento = $data_de_nascimento;
    }

    public function getCPF()
    {
        return $this->cpf;
    }

    public function setCPF($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCargoId()
    {
        return $this->cargo_id;
    }

    public function setCargoId($cargo_id)
    {
        $this->cargo_id = $cargo_id;
    }

    public function getDepartamentoId()
    {
        return $this->departamento_id;
    }

    public function setDepartamentoId($departamento_id)
    {
        $this->departamento_id = $departamento_id;
    }
    
}