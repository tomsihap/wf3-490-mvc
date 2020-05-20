<?php

namespace App\Model;

use PDO;

class Animal extends AbstractModel {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $species;

    /**
     * @var string
     */
    private $country;

    /**
     * Nom de la table en BDD
     * On le met en public car il n'a pas besoin d'avoir de Getter (en effet la donnée est écrite en "dur")
     * 
     * @var string
     */
    public $tableName = "Animal";

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSpecies() : string
    {
        return $this->species;
    }

    /**
     * @param string $species
     * @return self
     */
    public function setSpecies(string $species)
    {
        $this->species = $species;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }

    /**
     * @param string $country description du paramètre
     * @return self
     */
    public function setCountry(string $country) : self
    {
        $this->country = $country;
        return $this;
    }

    public static function findAll() {
        $pdo = self::getPdo();

        $query = 'select * from animal';

        $response = $pdo->prepare($query);
        $response->execute();

        $data = $response->fetchAll();

        // On prépare le tableau qui contiendra nos animaux en format Object
        $dataAsObjects = [];

        // On fait un foreach de $data (données de la bdd) pour transformer chaque data en un object
        // puis on met l'object dans le tableau $dataAsObjects
        foreach($data as $d) {
            $dataAsObjects[] = self::toObject($d);
        }

        return $dataAsObjects;
    }

    /**
     * Transforme un array de données de la table Animal en un objet Animal
     */
    public static function toObject($array) {

        $animal = new Animal;
        $animal->setId($array['id']);
        $animal->setSpecies($array['species']);
        $animal->setCountry($array['country']);

        return $animal;
    }

    /**
     * Enregistre l'objet lui-même en base de données
     */
    public function store() {

        $pdo = self::getPdo();

        $query = 'INSERT INTO animal(species, country) VALUES (:species, :country)';

        $response = $pdo->prepare($query);
        $response->execute([
            'species' => $this->getSpecies(),
            'country' => $this->getCountry()
        ]);

        return true;
    }
}