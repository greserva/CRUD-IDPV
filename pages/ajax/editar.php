<?php
require_once dirname(__DIR__, 2).'/includes.php';

use App\Model\CentroDeCusto;
use App\Model\CentroDeCustoDAO;
use App\Model\Cargo;
use App\Model\CargoDAO;
use App\Model\Departamento;
use App\Model\DepartamentoDAO;
use App\Model\Usuario;
use App\Model\UsuarioDAO;

if($_POST['type'] == 'cargo')
{
    $c = new Cargo();
    $c->setId($_POST['id']);
    $c->setNome($_POST['nome']);
    $c->setDescricao($_POST['desc']);
    $cdao = new CargoDAO();
    if($cdao->update($c)){
        echo json_encode(['error' => false, 'msg' => 'Cargo editado!']);
        return;
    }else{
        echo json_encode(['error' => true, 'msg_error' => 'Cargo não deletado, erro de conexão!']);
        return;
    }
}

if($_POST['type'] == 'usuario')
{
    $u = new Usuario();
    $u->setId($_POST['id']);
    $u->setNome($_POST['nome']);
    $u->setEmail($_POST['email']);
    $u->setDataDeNascimento($_POST['data_de_nascimento']);
    $u->setCPF($_POST['cpf']);
    $u->setCargoId($_POST['cargo_id']);
    $u->setDepartamentoId($_POST['departamento_id']);
    $udao = new UsuarioDAO();
    if($udao->update($u)){
        echo json_encode(['error' => false, 'msg' => 'Usuário editado!']);
        return;
    }else{
        echo json_encode(['error' => true, 'msg_error' => 'Usuário não deletado, erro de conexão!']);
        return;
    }
}

if($_POST['type'] == 'departamento')
{
    $d = new Departamento();
    $d->setId($_POST['id']);
    $d->setNome($_POST['nome']);
    $d->setCentroDeCustoId($_POST['centro_de_custo_id']);
    $ddao = new DepartamentoDAO();
    if($ddao->update($d)){
        echo json_encode(['error' => false, 'msg' => 'Departamento editado!']);
        return;
    }else{
        echo json_encode(['error' => true, 'msg_error' => 'Departamento não deletado, erro de conexão!']);
        return;
    }
}

if($_POST['type'] == 'centro_de_custo')
{
    $c = new CentroDeCusto();
    $c->setId($_POST['id']);
    $c->setNome($_POST['nome']);
    $cdao = new CentroDeCustoDAO();
    if($cdao->update($c)){
        echo json_encode(['error' => false, 'msg' => 'Centro de custo editado!']);
        return;
    }else{
        echo json_encode(['error' => true, 'msg_error' => 'Centro de custo não deletado, erro de conexão!']);
        return;
    }
}