<?php

namespace App\Class;

use DateTime;





class Inversor
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



}