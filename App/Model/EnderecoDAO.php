<?php
namespace App\Model;

class EnderecoDAO
{
    public function create(Endereco $c)
    {
        $sql = "INSERT INTO endereco (cep, endereco, numero, bairro, uf, cidade, complemento, departamento_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->bindValue(1, $c->getCep());
        $stmt->bindValue(2, $c->getEndereco());
        $stmt->bindValue(3, $c->getNumero());
        $stmt->bindValue(4, $c->getBairro());
        $stmt->bindValue(5, $c->getUF());
        $stmt->bindValue(6, $c->getCidade());
        $stmt->bindValue(7, $c->getComplemento());
        $stmt->bindValue(8, $c->getDepartamentoId());
        $return = $stmt->execute();
        if($return){
            return "Inserido com sucesso";
        }else{
            return "Erro de execução";
        }
    }

    public function read()
    {
        $sql = "SELECT * FROM endereco";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $return = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $return;
        }else{
            return "Não existem registros";
        }

    }

    public function update(Endereco $c)
    {

        if(!is_null($c->getCep()))
        {
            $sql = "UPDATE endereco SET cep = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getCep());
            $stmt->bindValue(2, $c->getId());
            $return = $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
        }

        if(!is_null($c->getEndereco()))
        {
            $sql = "UPDATE endereco SET endereco = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getEndereco());
            $stmt->bindValue(2, $c->getId());
            $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
            
        }

        if(!is_null($c->getNumero()))
        {
            $sql = "UPDATE endereco SET numero = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getNumero());
            $stmt->bindValue(2, $c->getId());
            $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
            
        }

        if(!is_null($c->getBairro()))
        {
            $sql = "UPDATE endereco SET bairro = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getBairro());
            $stmt->bindValue(2, $c->getId());
            $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
            
        }

        if(!is_null($c->getUF()))
        {
            $sql = "UPDATE endereco SET uf = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getUF());
            $stmt->bindValue(2, $c->getId());
            $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
            
        }

        if(!is_null($c->getCidade()))
        {
            $sql = "UPDATE endereco SET cidade = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getCidade());
            $stmt->bindValue(2, $c->getId());
            $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
            
        }

        if(!is_null($c->getComplemento()))
        {
            $sql = "UPDATE endereco SET complemento = ? WHERE id = ?";
            $stmt = Conexao::getConnection()->prepare($sql);
            $stmt->bindValue(1, $c->getBairro());
            $stmt->bindValue(2, $c->getId());
            $stmt->execute();
            if(!$return){
                return "Erro ao atualizar";
            }
            
        }
        return "Atualizado com sucesso";
        
    }

    public function delete($id)
    {
        $sql = "DELETE FROM endereco WHERE id = ?";
        $stmt = Conexao::getConnection()->prepare($sql);
        $stmt->bindValue(1, $id);
        $return = $stmt->execute();
        if($return){
            return "Deletado com sucesso";
        }else{
            return "Erro ao deletar";
        }
    }
}