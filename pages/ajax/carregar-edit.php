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
    $cargo = new Cargo();
    $cargo->setId($_POST['id_aux']);
    $cargoDao = new CargoDAO();
    echo json_encode($cargoDao->edit($cargo->getId()));
}

if($_POST['type'] == 'usuario')
{
    $usuario = new Usuario();
    $usuario->setId($_POST['id_aux']);
    $usuarioDao = new UsuarioDAO();
    echo json_encode($usuarioDao->edit($usuario->getId()));
}

if($_POST['type'] == 'departamento')
{
    $departamento = new Departamento();
    $departamento->setId($_POST['id_aux']);
    $departamentoDao = new DepartamentoDAO();
    echo json_encode($departamentoDao->edit($departamento->getId()));
}

if($_POST['type'] == 'centro_de_custo')
{
    $centro_de_custo = new CentroDeCusto();
    $centro_de_custo->setId($_POST['id_aux']);
    $centro_de_custoDao = new CentroDeCustoDAO();
    echo json_encode($centro_de_custoDao->edit($centro_de_custo->getId()));
}