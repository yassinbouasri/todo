<?php
declare(strict_types=1);

use App\Controllers\CategoryController;
use App\Controllers\TaskController;
use App\Controllers\UserController;

$user = new UserController();
$task = new TaskController();
$category = new CategoryController();

/**
 * @var object $user
 * @var object $task
 * @var object $category
 */
 return [
     //user routes
     'login' => function () use ($user) {
         $user->login();
     },
     'register' => function () use ($user) {
        $user->register();
     },
     'logout' => function () use ($user) {
        $user->logout();
     },
     'changePassword' => function () use ($user) {
        $user->changePassword();
     },
     'resetPassword' => function () use ($user) {
        $user->resetPassword();
     },
     'user/resetPasswordByToken' => function ($token) use ($user) {
        $user->resetPasswordByToken($token);
     },

     //task routes
     '' => function () use ($task) {
         $task->index();
     },
     'task/create' => function () use ($task) {
        $task->create();
     },
     'task/show' => function (string $id) use ($task) {
        $task->show((int) $id);
     },
     'task/remove' => function () use ($task) {
        $task->remove();
     },
     'task/update' => function (string $id) use ($task) {
        $task->update((int) $id);
     },

     // category routes
     'category/create' => function () use ($category) {
        $category->create();
     },
     'category/remove' => function () use ($category) {
        $category->remove();
     },
     'category/update' => function (string $id) use ($category) {
        $category->update((int) $id);
     },
     'category/show' => function () use ($category) {
            $category->index();
     },
 ];