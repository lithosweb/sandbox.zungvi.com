<?php

declare(strict_types=1);

namespace sandbox\controller;

class Controller
{
    public function __construct()
    {
    }

    public function index(): void
    {
        echo '<h1> Welcome to the SandBox</h1>';
    }
}