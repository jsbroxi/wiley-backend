<?php

namespace App\Interfaces;

interface ClothsRepositoryInterface
{
    public function getById($data);

    public function getList($data);

    public function addCloths($data);

    public function deleteCloths($data);

    public function editCloths($data);
}
