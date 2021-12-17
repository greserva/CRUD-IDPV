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
    $cdao = new CargoDAO();
    if($cdao->delete($c->getId())){
        echo json_encode(['error' => false, 'msg' => 'Cargo deletado!']);
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
    $udao = new UsuarioDAO();
    if($udao->delete($u->getId())){
        echo json_encode(['error' => false, 'msg' => 'Usuario deletado!']);
        return;
    }else{
        echo json_encode(['error' => true, 'msg_error' => 'Usuario não deletado, erro de conexão!']);
        return;
    }
    
}

if($_POST['type'] == 'departamento')
{
    $u = new Departamento();
    $u->setId($_POST['id']);
    $udao = new DepartamentoDAO();
    if($udao->delete($u->getId())){
        echo json_encode(['error' => false, 'msg' => 'Usuario deletado!']);
        return;
    }else{
        echo json_encode(['error' => true, 'msg_error' => 'Usuario não deletado, erro de conexão!']);
        return;
    }
    
}

if($_POST['type'] == 'centro_de_custo')
{
    $c = new CentroDeCusto();
    $c->setId($_POST['id']);
    $cdao = new CentroDeCustoDAO();
    if($cdao->delete($c->getId())){
        echo json_encode(['error' => false, 'msg' => 'Centro de custo deletado!']);
        return;
    }else{
        echo json_encode(['error' => true, 'msg_error' => 'Centro de custo não deletado, erro de conexão!']);
        return;
    }
    
}