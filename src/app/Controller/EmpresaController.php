<?php

namespace App\Controller;

use App\Class\Empresa;
use App\Interface\ControllerInterface;
use App\Model\EmpresaModel;

class EmpresaController implements ControllerInterface
{

  function index()
  {
    $empresas = EmpresaModel::getAllEmpresas();
		return json_encode($empresas);
  }

  function show($id)
  {
    // TODO: Implement show() method.
  }

  function create()
  {
    include_once "View/backend/crearEmpresa.php";
  }

  function store()
  {
    $empresa = Empresa::createFromArray($_POST);

		if ($empresa!==null){
			if (EmpresaModel::saveEmpresa($empresa)){
				http_response_code(200);
				return json_encode([
					"error" => false,
					"message"=> "Empresa guardada correctamente.",
					"code" => 200
				]);
			} else {
				http_response_code(400);
				return json_encode([
					"error" => true,
					"message" => "No se pudo guardar el usuario.",
					"code" => 400
				]);
			}
		}else {
			include_once "View/backend/crearEmpresa.php";
		}
  }

  function edit($id)
  {
    $empresa = EmpresaModel::getEmpresaById($id);

  }

  function update($id)
  {
		$editData = json_decode(file_get_contents("php://input"), true);

    $empresaPrevia = EmpresaModel::getEmpresaById($id);
		$empresaEditada = Empresa::editFromArray($editData, $empresaPrevia);

		if ($empresaEditada !== null){
			if (EmpresaModel::updateEmpresa($empresaEditada)){
				http_response_code(200);
				return json_encode([
					"error" => false,
					"message" => "Empresa editada con éxito.",
					"code" => 200
				]);
			}else {
				http_response_code(400);
				return json_encode([
					"error" => true,
					"message" => "Hubo un problema al editar la empresa.",
					"code" => 400
				]);
			}
		}else {
			http_response_code(401);
			return json_encode([
				"error" => true,
				"message" => "Error desconocido",
				"code" => 401
			]);
		}
  }

  function destroy($id)
  {
    // TODO: Implement destroy() method.
  }
}