<?php

 return [
     'login' => function () use ($user) {
         $user->login();
     },
     'register' => function () use ($user) {
        $user->register();
     },
 ];