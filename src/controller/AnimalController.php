<?php
namespace App\Controller;

use App\Model\Animal;

class AnimalController extends AbstractController {

    public static function index() {
        echo self::getTwig()->render('animal/index.html');
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
        var_dump($_POST);
    }

    public static function edit($id) {

    }

    public static function update() {

    }

    public static function delete($id) {

    }
}