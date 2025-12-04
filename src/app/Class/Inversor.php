<?php

namespace App\Class;

use DateTime;
use JsonSerializable;




class Inversor implements JsonSerializable
{
  private string $email;
  private string $nombre;
  private string $dni;
  private DateTime $fecha_nac;

  /**
   * @param string $email
   * @param string $nombre
   * @param string $dni
   * @param DateTime $fecha_nac
   */
  public function __construct(string $email, string $nombre, string $dni, DateTime $fecha_nac)
  {
    $this->email = $email;
    $this->nombre = $nombre;
    $this->dni = $dni;
    $this->fecha_nac = $fecha_nac;
  }


  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): Inversor
  {
    $this->email = $email;
    return $this;
  }

  public function getNombre(): string
  {
    return $this->nombre;
  }

  public function setNombre(string $nombre): Inversor
  {
    $this->nombre = $nombre;
    return $this;
  }

  public function getDni(): string
  {
    return $this->dni;
  }

  public function setDni(string $dni): Inversor
  {
    $this->dni = $dni;
    return $this;
  }

  public function getFechaNac(): DateTime
  {
    return $this->fecha_nac;
  }

  public function setFechaNac(DateTime $fecha_nac): Inversor
  {
    $this->fecha_nac = $fecha_nac;
    return $this;
  }


	public function jsonSerialize():mixed
	{
		return [
			"Email" => $this->getEmail(),
			"Nombre" => $this->getNombre(),
			"DNI" => $this->getDni(),
			"Fecha Nacimiento" => $this->getFechaNac()->format('d-m-Y')
		];
	}

	public static function createFromArray(array $data):?Inversor{

		$valido = true;

		if (!isset($data['nombre']) || !is_string($data['nombre'])) $valido = false;
		if (!isset($data['email']) || !is_string($data['email'])) $valido = false;
		if (!isset($data['fecha_nac']) || !DateTime::createFromFormat('Y-m-d', $data['fecha_nac'])) $valido = false;
		if (!isset($data['dni']) || !is_string($data['dni'])) $valido = false;

		if ($valido){
			return new Inversor($data['email'], $data['nombre'], $data['dni'], DateTime::createFromFormat('Y-m-d', $data['fecha_nac']));
		} else {
			return null;
		}




	}

	public static function editFromArray(array $data, Inversor $inversor):?Inversor{
		$editado = false;

		if (isset($data['nombre']) && is_string($data['nombre'])){
			$inversor->setNombre($data['nombre']);
			$editado = true;
		}
		if (isset($data['fecha_nac']) && DateTime::createFromFormat('Y-m-d',$data['fecha_nac'])){
			$inversor->setFechaNac(DateTime::createFromFormat('Y-m-d', $data['fecha_nac']));
			$editado = true;
		}
		if (isset($data['dni']) && is_string($data['dni'])){
			$inversor->setDni($data['dni']);
			$editado = true;
		}

		if ($editado){
			return $inversor;
		} else {
			return null;
		}
	}
}