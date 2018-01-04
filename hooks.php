<?php

use Dredd\Hooks;

$stash = [];

Hooks::after("Login/Register > /api/v1/login > Login to the site > 200", function(&$transaction) use (&$stash) {

    $stash["token"] = json_decode($transaction->real->body);

});

Hooks::beforeEach(function(&$transaction) use (&$stash) {

    if ($stash["token"]) {
        $transaction->request->headers->{'Authorization'} = "Bearer {$stash['token']}";
    }

});

Hooks::after("Recipes > /api/v1/recipe > Create a new recipe > 201", function(&$transaction) use (&$stash) {

    $responseBody = json_decode($transaction->real->body);

    $stash["recipeId"] = $responseBody->recipe->id;

});

Hooks::before("Recipes > /api/v1/recipe/{recipe} > Update a recipe > 200", function(&$transaction) use (&$stash) {

    $transaction->request->uri = preg_replace('/1$/', $stash["recipeId"], $transaction->request->uri);
    $transaction->fullPath = preg_replace('/1$/', $stash["recipeId"], $transaction->fullPath);

});

Hooks::before("Recipes > /api/v1/recipe/{recipe} > Delete a recipe > 204", function(&$transaction) use (&$stash) {

    $transaction->request->uri = preg_replace('/1$/', $stash["recipeId"], $transaction->request->uri);
    $transaction->fullPath = preg_replace('/1$/', $stash["recipeId"], $transaction->fullPath);

});
