<?php

namespace App\Controller;

use App\Class\Inversor;
use App\Interface\ControllerInterface;
use App\Model\InversorModel;

class InversorController implements ControllerInterface
{

  function index()
  {
    $inversores = InversorModel::getAllInversores();
		if ($inversores){
			return json_encode($inversores);
		}
  }

  function show($email)
  {
    $inversor = InversorModel::getInversorByEmail($email);
		if ($inversor){
			return json_encode($inversor);
		}
  }

  function create()
  {
    // Redirigir con include_once al formulario de creacion.
  }

  function store()
  {
    $inversor = Inversor::createFromArray($_POST);
		if ($inversor){
			if (InversorModel::saveInversor($inversor)){
				http_response_code(200);
				return json_encode([
					"error" => false,
					"message" => "Inversor guardado con exito.",
					"code" => 200
				]);
			} else {
				http_response_code(400);
				return json_encode([
					"error" => true,
					"message" => "No se pudo guardar en la BBDD.",
					"code" => 400
				]);
			}
		} else {
			http_response_code(401);
			return json_encode([
				"error" => true,
				"message" => "Los datos introducidos no son correctos.",
				"code" => 400
			]);
		}
  }

  function edit($email)
  {
	  $inversor = InversorModel::getInversorByEmail($email);
		// include_once a vista de edicion
  }

  function update($email)
  {
		$editData = json_decode(file_get_contents("php://input"),true);
    $inversor = InversorModel::getInversorByEmail($email);
	  $inversorEditado = Inversor::editFromArray($editData, $inversor);

	  if (!$inversor) {
			http_response_code(400);
			return json_encode([
				"error" => true,
				"message" => "No se ha encontrado al inversor en la base de datos.",
				"code" => 400
			]);
		}
		if ($inversorEditado===null){
			http_response_code(400);
			return json_encode([
				"error" => true,
				"message" => "Error al editar el usuario.",
				"code" => 400
			]);
		}
		if (InversorModel::updateInversor($inversorEditado)){
			http_response_code(200);
			return json_encode([
				"error" => false,
				"message" => "Inversor actualizado correctamente.",
				"code" => 200
			]);
		}else{
			http_response_code(401);
			return json_encode([
				"error" => true,
				"message" => "Error al guardar los cambios en la BBDD.",
				"code" => 401
			]);
		}

  }

  function destroy($email)
  {
    if (InversorModel::deleteInversorByEmail($email)){
			http_response_code(200);
			return json_encode([
				"error" => false,
				"message" => "Inversor borrado con exito.",
				"code" => 200
			]);
    } else {
			http_response_code(401);
			return json_encode([
				"error" => true,
				"message" => "No se pudo borrar al usuario de la base de datos.",
				"code" => 401
			]);
    }
  }
}