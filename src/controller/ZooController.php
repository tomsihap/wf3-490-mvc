<?php

namespace App\Controller;

use App\Model\Zoo;

class ZooController extends AbstractController {
    public static function index()
    {
        $zoos = Zoo::findAll();

        echo self::getTwig()->render('zoo/index.html', [
            'zoos' => $zoos
        ]);
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
        $zoo = new Zoo;
        $zoo->setName($_POST['name']);
        $zoo->setCity($_POST['city']);
        $zoo->store();

        // On redirige vers la page d'accueil des zoos en appelant la méthode qui génère cette dite page
        self::index();
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