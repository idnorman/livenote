<?php

namespace App\Repositories;

abstract class BaseRepository{
    abstract public function create(array $attibutes);
    abstract public function update($model, array $attibutes);
    abstract public function delete($model);

}