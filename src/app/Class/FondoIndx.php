<?php

namespace App\Class;

class FondoIndx
{
  private string $nombre;
  private string $pais;
  private float $gastos;

  /**
   * @param string $nombre
   * @param string $pais
   * @param float $gastos
   */
  public function __construct(string $nombre, string $pais, float $gastos)
  {
    $this->nombre = $nombre;
    $this->pais = $pais;
    $this->gastos = $gastos;
  }

  public function getNombre(): string
  {
    return $this->nombre;
  }

  public function setNombre(string $nombre): FondoIndx
  {
    $this->nombre = $nombre;
    return $this;
  }

  public function getPais(): string
  {
    return $this->pais;
  }

  public function setPais(string $pais): FondoIndx
  {
    $this->pais = $pais;
    return $this;
  }

  public function getGastos(): float
  {
    return $this->gastos;
  }

  public function setGastos(float $gastos): FondoIndx
  {
    $this->gastos = $gastos;
    return $this;
  }




}