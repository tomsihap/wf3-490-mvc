<?php
namespace App\Controller;

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\Loader\FilesystemLoader;

class AnimalController {

    public $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../views');
        $twig = new Environment($loader);

        $this->twig = $twig;
    }

    public static function index() {
        echo self::$twig->render('animal/index.html');
    }

    public static function show($id) {
        echo self::$twig->render('animal/show.html', [
            'idanimal' => $id
        ]);
    }

    public static function create() {

    }

    public static function new() {

    }

    public static function edit($id) {

    }

    public static function update() {

    }

    public static function delete($id) {

    }
}