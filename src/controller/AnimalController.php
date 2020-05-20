<?php
namespace App\Controller;

use App\Model\Animal;

class AnimalController extends AbstractController {

    public static function index() {
        $animaux = Animal::findAll();

        echo self::getTwig()->render('animal/index.html', [
            'animaux' => $animaux
        ]);
    }

    public static function show($id) {
        echo self::getTwig()->render('animal/show.html', [
            'idanimal' => $id
        ]);
    }

    public static function create() {
        echo self::getTwig()->render('animal/create.html');
    }

    public static function new() {
        $animal = new Animal;
        $animal->setCountry($_POST['country']);
        $animal->setSpecies($_POST['species']);
        $animal->store();

        self::index();
    }

    public static function edit($id) {

    }

    public static function update() {

    }

    public static function delete($id) {

    }
}