<?php
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
     'resetPasswordByToken' => function ($token) use ($user) {
        $user->resetPasswordByToken($token);
     },

     //task routes
     '' => function () use ($task) {
         $task->index();
     },
     'task/create' => function () use ($task) {
        $task->create();
     },
     'task/show' => function ($id) use ($task) {
        $task->show($id);
     },
     'task/remove' => function () use ($task) {
        $task->remove();
     },
     'task/update' => function ($id) use ($task) {
        $task->update($id);
     },

     // category routes
     'category/create' => function () use ($category) {
        $category->create();
     },
     'category/remove' => function () use ($category) {
        $category->remove();
     },
     'category/update' => function ($id) use ($category) {
        $category->update($id);
     },
     'category/show' => function () use ($category) {
            $category->index();
     },
 ];