<?php

namespace App\Interface;

interface ControllerInterface
{

  function index();
  function show($id);

  function create();
  function store();
  function edit($id);
  function update($id);
  function destroy($id);
}