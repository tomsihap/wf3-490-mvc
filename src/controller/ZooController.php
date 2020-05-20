<?php

namespace App\Controller;

class ZooController extends AbstractController {
    public static function index()
    {
        echo self::getTwig()->render('zoo/index.html');
    }

    public static function show($id)
    {
    }

    public static function create()
    {
        echo self::getTwig()->render('zoo/create.html');
    }

    public static function new()
    {
        var_dump($_POST);
    }

    public static function edit($id)
    {
    }

    public static function update()
    {
    }

    public static function delete($id)
    {
    }
}