<?php

namespace App\Model;

class Zoo extends AbstractModel {
    public $id;
    public $name;
    public $city;
    
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getCity() {
        return $this->city;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public static function findAll() {
        $pdo = self::getPdo();
        $query = "SELECT * FROM zoo";
        $response = $pdo->prepare($query);
        $response->execute();

        $data = $response->fetchAll();

        // On prépare le tableau qui contiendra nos animaux en format Object
        $dataAsObjects = [];

        // On fait un foreach de $data (données de la bdd) pour transformer chaque data en un object
        // puis on met l'object dans le tableau $dataAsObjects
        foreach ($data as $d) {
            $dataAsObjects[] = self::toObject($d);
        }

        return $dataAsObjects;
    }

    /**
     * Transforme un array de données de la table Animal en un objet Animal
     */
    public static function toObject($array)
    {

        $zoo = new Zoo;
        $zoo->setId($array['id']);
        $zoo->setCity($array['city']);
        $zoo->setName($array['name']);

        return $zoo;
    }

    public function store() {
        $pdo = self::getPdo();

        $query = 'INSERT INTO zoo(name, city) VALUES (:name, :city)';

        $response = $pdo->prepare($query);
        $response->execute([
            'name' => $this->getName(),
            'city' => $this->getCity()
        ]);

        return true;
    }

}