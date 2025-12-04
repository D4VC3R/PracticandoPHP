<?php

namespace App\Model;

use App\Class\Inversor;
use PDO;
use PDOException;

class InversorModel
{

	public static function getInversorByEmail(string $email):?Inversor{
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return null;
		}

		$sql = "SELECT * FROM inversor WHERE email=:email";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue("email", $email);
		$stmt->execute();

		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

		if ($resultado){
			$inversor = Inversor::createFromArray($resultado);
			return $inversor;
		} else {
			return null;
		}
	}

	public static function getAllInversores():?array{
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return null;
		}

		$sql = "SELECT * FROM inversor";

		$stmt = $conexion->prepare($sql);
		$stmt->execute();

		$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (count($resultado)>0){
			$inversores = [];
			foreach ($resultado as $inversor){
				$inversores[] = Inversor::createFromArray($inversor);
			}
			return $inversores;
		} else {
			return null;
		}
	}

	public static function saveInversor(Inversor $inversor):bool{
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return false;
		}

		$sql = "INSERT INTO inversor (nombre, email, fecha_nac, dni) VALUES (:nombre, :email, STR_TO_DATE(:fecha_nac,'%d/%c/%Y'), :dni)";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue("nombre", $inversor->getNombre());
		$stmt->bindValue("email", $inversor->getEmail());
		$stmt->bindValue("fecha_nac", $inversor->getFechaNac()->format('d/m/Y'));
		$stmt->bindValue("dni", $inversor->getDni());
		$stmt->execute();

		if ($stmt->rowCount()>0){
			return true;
		} else {
			return false;
		}
	}

	public static function updateInversor(Inversor $inversor):bool{
		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return false;
		}

		$sql = "UPDATE inversor SET nombre=:nombre, fecha_nac=STR_TO_DATE(:fecha_nac,'%d/%c/%Y'), dni=:dni WHERE email=:email";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue("nombre", $inversor->getNombre());
		$stmt->bindValue("email", $inversor->getEmail());
		$stmt->bindValue("fecha_nac", $inversor->getFechaNac()->format('d/m/Y'));
		$stmt->bindValue("dni", $inversor->getDni());
		$stmt->execute();

		if ($stmt->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}

	public static function deleteInversorByEmail(string $email):bool{

		try {
			$conexion = new PDO("mysql:host=mariadb;dbname=examen","alumno","alumno");
			$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}catch (PDOException $e){
			return false;
		}

		$sql = "DELETE FROM inversor WHERE email=:email";

		$stmt = $conexion->prepare($sql);
		$stmt->bindValue("email",$email);
		$stmt->execute();

		if ($stmt->rowCount()>0){
			return true;
		}else{
			return false;
		}
	}
}