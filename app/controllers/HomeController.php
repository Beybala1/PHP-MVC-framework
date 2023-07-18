<?php
class HomeController
{
    public function index(): void
    {
        echo "<h1 style='text-align: center;'>Welcome to the home page</h1>";
    }

    public function hi(): void
    {
        echo "Hi world";
    }
}