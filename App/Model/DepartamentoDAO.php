<?php
namespace App\Model;

class DepartamentoDAO
{
    public function create(Departamento $c)
    {
        $sql = "INSERT INTO departamento (nome, centro_de_custo_id) VALUES (?, ?)";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->bindValue(1, $c->getNome());
        $stmt->bindValue(2, $c->getCentroDeCustoId());
        $return = $stmt->execute();
        if($return){
            return true;
        }else{
            return false;
        }
    }

    public function read()
    {
        $sql = "SELECT d.id, d.nome, c.nome as centro_de_custo_nome
            FROM departamento d
            INNER JOIN centro_de_custo c ON d.centro_de_custo_id = c.id
            ORDER BY d.id ASC";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $return;
        }else{
            return false;
        }

    }

    public function edit($id)
    {
        $sql = "SELECT * FROM departamento WHERE id = $id";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $return;
        }else{
            return false;
        }
    }

    public function update(Departamento $c)
    {

        if(!is_null($c->getNome()))
        {
            $sql = "UPDATE departamento SET nome = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getNome());
            $stmt->bindValue(2, $c->getId());
            $return = $stmt->execute();
            if(!$return){
                return false;
            }
        }

        if(!is_null($c->getCentroDeCustoId()))
        {
            $sql = "UPDATE departamento SET centro_de_custo_id = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getCentroDeCustoId());
            $stmt->bindValue(2, $c->getId());
            $stmt->execute();
            if(!$return){
                return false;
            }
            
        }
        return true;
        
    }

    public function delete($id)
    {
        $sql = "DELETE FROM departamento WHERE id = ?";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->bindValue(1, $id);
        $return = $stmt->execute();
        if($return){
            return $return;
        }else{
            return $return;
        }
    }
}