<?php

namespace App\Repositories\Contracts;

/**
 * Interface: RecipeRepositoryContract
 */
interface RecipeRepositoryContract
{
    public function create($request, $user);

    public function getAll($userId);

    public function delete($recipe);
}
