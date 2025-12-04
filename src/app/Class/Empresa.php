<?php

namespace App\Class;
use App\Model\EmpresaModel;
use JsonSerializable;

class Empresa implements JsonSerializable
{
  private int $id;
  private string $nombre;
  private float $rentabilidad;

  /**
   * @param int $id
   * @param string $nombre
   * @param float $rentabilidad
   */
  public function __construct(int $id, string $nombre, float $rentabilidad)
  {
    $this->id = $id;
    $this->nombre = $nombre;
    $this->rentabilidad = $rentabilidad;
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function setId(int $id): Empresa
  {
    $this->id = $id;
    return $this;
  }

  public function getNombre(): string
  {
    return $this->nombre;
  }

  public function setNombre(string $nombre): Empresa
  {
    $this->nombre = $nombre;
    return $this;
  }

  public function getRentabilidad(): float
  {
    return $this->rentabilidad;
  }

  public function setRentabilidad(float $rentabilidad): Empresa
  {
    $this->rentabilidad = $rentabilidad;
    return $this;
  }


	public function jsonSerialize(): array
	{
		return [
			"id"=>$this->id,
			"nombre"=>$this->nombre,
			"rentabilidad"=>$this->rentabilidad
		];
	}

	public static function createFromArray(array $data):?Empresa{
		if (!isset($data['id'])){
			$data['id'] = EmpresaModel::getNextId();
		}
		if (isset($data['id']) && isset($data['nombre']) && isset($data['rentabilidad'])){
			return new Empresa($data['id'], $data['nombre'], $data['rentabilidad']);
		}else{
			return null;
		}
	}
	public static function editFromArray(array $data, Empresa $datosAnteriores):?Empresa{
		$editado = false;

		if (isset($data['nombre'])){
			$datosAnteriores->setNombre($data['nombre']);
			$editado = true;
		}
		if (isset($data['rentabilidad']) && is_float($data['rentabilidad'])){
			$datosAnteriores->setRentabilidad($data['rentabilidad']);
			$editado = true;
		}
		if ($editado){
			return $datosAnteriores;
		}else{
			return null;
		}
	}
}