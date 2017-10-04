<?php

namespace App\Repositories\Contracts;

interface RecipeRepositoryContract
{
    public function create($request, $user);

    public function getAll($userId);

    public function delete($recipe);
}
