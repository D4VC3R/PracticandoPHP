<?php

namespace App\Model;

use App\Class\Empresa;
use PDO;
use PDOException;

class EmpresaModel
{

	public static function getEmpresaById(string $id):?Empresa {
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return null;
		}

		$sql = "SELECT * FROM empresa WHERE id=:id";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue("id", $id);
		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($resultado){
			return Empresa::createFromArray($resultado);
		}else {
			return null;
		}
	}

	public static function getAllEmpresas():?array{
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e){
			return null;
		}

		$sql = "SELECT * FROM empresa";

		$stmt = $conexion->prepare($sql);
		$stmt->execute();
		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (count($resultado)>0){
			$empresas = [];
			foreach ($resultado as $empresa){
				$empresas[] = Empresa::createFromArray($empresa);
			}
			return $empresas;
		} else{
			return null;
		}
	}

	public static function getNextId():?int{
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return false;
		}

		$sql = "SELECT MAX(id) AS max_id FROM empresa";

		$stmt = $conexion->prepare($sql);
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($resultado){
			return $resultado['max_id'] + 1;
		}else {
			return false;
		}
	}

	public static function saveEmpresa(Empresa $empresa):bool{
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return false;
		}

		$sql = "INSERT INTO empresa (id, nombre, rentabilidad) VALUES (:id, :nombre, :rentabilidad)";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue("id", $empresa->getId());
		$stmt->bindValue("nombre", $empresa->getNombre());
		$stmt->bindValue("rentabilidad", $empresa->getRentabilidad());
		$stmt->execute();

		if ($stmt->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}

	public static function updateEmpresa(Empresa $empresa):bool{
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return false;
		}

		var_dump($empresa);

		$sql = "UPDATE empresa SET nombre=:nombre, rentabilidad=:rentabilidad WHERE id=:id";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue("nombre", $empresa->getNombre());
		$stmt->bindValue("rentabilidad", $empresa->getRentabilidad());
		$stmt->bindValue("id", $empresa->getId());

		$stmt->execute();

		if ($stmt->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}

	public static function deleteEmpresaById(string $id): bool{
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return false;
		}

		$sql = "DELETE FROM empresa WHERE id=:id";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue("id", $id);
		$stmt->execute();

		if ($stmt->rowCount()>0){
			return true;
		} else {
			return false;
		}
	}
}