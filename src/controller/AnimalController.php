# Examen PHP-MVC HB-CDA 06-2020

> Vous venez d'intégrer une équipe de développeurs au sein d'une agence digitale. L'équipe dans laquelle vous allez travailler a conçu une base de projet MVC réutilisable en interne et le chef de projet vous propose de l'utiliser pour votre nouveau projet.

> **Le projet :** une agence immobilière, *HbImmo*, aurait besoin d'une interface de gestion de biens : elle aimerait pouvoir gérer le suivi des contacts avec de potentiels acheteurs sur les biens qu'elle enregistre.

Voici les outils qui vous sont fournis par l'agence :

1. Le projet de base à partir duquel démarrer le projet : https://github.com/tomsihap/simple-mvc-base-project/. Pour l'utiliser :
   1. Allez sur le lien et cliquez sur "Clone or download" puis "Download Zip"
   2. Mettez ce dossier dans `www`
   3. Ouvrez un terminal dans le dossier projet et saisissez `composer install`


2. La documentation du MVC interne à l'agence : https://github.com/tomsihap/allcourses/blob/master/POO/03-mvc.md

3. Un exemple de projet réalisé par l'agence avec ce MVC : https://github.com/tomsihap/wf3-490-mvc

Les fonctionnalités requises sont :

- Une page d'affichage de tous les biens enregistrés
- Un formulaire d'ajout de bien immobilier
- La liste des personnes qui ont contacté pour le bien immobilier
- Un formulaire de contact

## 1. Base de données (3 points)

Voici le modèle de base de données requis par le client. Vous devez **respecter** le nom des tables et des champs proposés. Le type de champ est vous est libre.

```
NOM DE LA BASE DE DONNÉES : HBIMMO_VOTRE_PRENOM

TABLES :

ASSET       # Table des biens immobiliers
--------
id
title       # nom du bien proposé
value       # valeur du bien à la vente
area        # surface en m2 du bien
rooms       # nombre de pièces
zipcode     # code postal
city        # ville


CONTACT     # Liste des contacts pour ce bien
--------
id
firstname   # prénom du contact
lastname    # nom du contact
email       # email du contact
message     # message laissé par le contact
id_asset    # Asset (bien immo) auquel est rattaché le contact
```

## 2. Pages attendues

Les pages attendues sont les suivantes :

1. Formulaire d'ajout d'un bien immobilier (5 points)
2. Affichage de la liste des biens immobiliers (4 points)
3. Page du détail d'un bien immobilier (2 points)
4. Sur la page d'un bien immobilier, ajouter un formulaire de contact (2 points)
5. Sur la page d'un bien immobilier, afficher les contacts reçus (2 points)

## 3. Propreté du code (2 points)

Vous livrerez un code :
- parfaitement indenté
- commenté et documenté (PHPDoc utilisé dans les classes)
- sans erreur dans l'éditeur de code


---

# Déroulé de l'examen

## Setup

1. Téléchargez le projet de base et mettez-le dans un dossier de `www`
2. Créez la base de données comme demandée
3. Modifiez `config/config.php` comme suit :
   1. BASE_PATH doit correspondre au chemin du navigateur vers le projet
   2. Les constantes de base de données doivent correspondre à votre configuration locale


## Déclaration des routes

1. Liste des routes utiles au projet :

Route | Controller@method | Détail
---------|----------|---------
 `GET /` | `AppController@index` | Page d'accueil de l'application
 `GET /assets` | `AssetsController@index` | Affichage de la liste des biens immobiliers
 `GET /assets/create` | `AssetsController@create` | Formulaire de création d'un bien immobilier
 `POST /assets` | `AssetsController@new` | Traitement du formulaire (action) de création d'un bien immo
 `GET /assets/(\d+)` | `AssetsController@show` | Page d'affichage d'un bien immobilier
 `POST /contact` | `ContactController@new` | Traitement du formulaire (action) de contact

2. Déclarez dans `routes.php` les routes ci-dessus. Un exemple se trouve ici (https://github.com/tomsihap/wf3-490-mvc/blob/master/config/routes.php)
   > **Attention :** Soyez vigileants sur l'usage de `->get()` ou de `->post()` quand il y en a besoin.

3. Créez les controllers et les méthodes appelés par les routes. Écrivez simplement les signatures des méthodes, pas besoin de les implémenter pour le moment ( = faites des méthodes vides, elles seront remplies plus tard). Un exemple de  controller complet est ici : https://github.com/tomsihap/wf3-490-mvc/blob/master/src/controller/AnimalController.php.
   > **Attention :** Regardez dans l'exemple la manière dont la route avec paramètres (pour nous, `GET /assets/(d+\)) est déclarée dans le contrôleur : il y a un paramètre dans la méthode correspondante à rajouter !

## Création des Models

- Créez les fichiers `model/Asset.php` et `model/Contact.php`. Ils contiendront les models correspondant à nos tables, en ayant en attribut privés les champs de la table, ainsi que des getters et setters. Voici un exemple de Model (plus complet que notre besoin pour l'instant : https://github.com/tomsihap/wf3-490-mvc/blob/master/src/model/Zoo.php)

## Création des vues

1. Créez les fichiers suivants :
- `views/app/index.html`
- `views/assets/index.html`
- `views/assets/form.html`
- `views/assets/show.html`

Ils utiliseront tous Twig et importeront `base.html.twig`. Ils contiendront donc au minimum tous le code suivant :

```twig
{% extends 'base.html' %}

{% block content %}

   Code HTML de la page

{% endblock %}
```

- Remplissez ces pages avec le contenu que vous souhaitez.

Exemple de page formulaire : https://github.com/tomsihap/wf3-490-mvc/blob/master/views/animal/create.html


1. Importer les vues dans les controllers

Dans les routes suivantes :
- `GET /`
- `GET /assets`
- `GET /assets/create`
- `GET /assets/(\d+)`

Dans les méthodes correspondantes, appelez les vues correspondantes grâce au moteur de template Twig. Exemple :

```php
class ArticlesController extends AbstractController {
   public function index() {
      echo self::getTwig()->render('articles/index.html');
   }
}
```

> **Note** : cette méthode statique  `getTwig()` vient du parent `AbstractController`.

## Récupérer les données en base de données et les afficher

Maintenant que les vues sont prêtes, il nous reste à :
1. Faire en sorte que les Models récupèrent les data en base de données
2. Depuis le controller, demander les données au Model
3. Depuis le controller, envoyer les données à la vue
4. Dans la vue, afficher les données


### Faire en sorte que les Models s'occupent des données

Sur l'exemple du fichier suivant https://github.com/tomsihap/wf3-490-mvc/blob/master/src/model/Animal.php , implémentez les fonctions suivantes :
- `findAll()` (récupère toutes les données de la table)
- `findOne($id)` (récupère un élément de la table par son ID)
- `toObject($array)` (transforme les résultats de BDD en objets du Model)
- `store()` (créée un élément dans la table)

> **IMPORTANT** Si ça n'était pas le cas, vérifiez que vos modèles héritent bien de `AbstractModel`.

### Depuis le controller, demander les données au Model et envoyer les données à la vue
Ces méthodes nous permettent en fait de récupérer les données au sein du controller.

Modifiez les méthodes nécessaires pour récupérer les données. Par exemple, pour `AnimalController@index` :

```php
public static function index() {
   $animaux = Animal::findAll();

   echo self::getTwig()->render('animal/index.html', [
      'animaux' => $animaux
   ]);
}
```

- `$animaux = Animal::findAll();` : on appelle le Model et sa méthode statique findAll() qui devrait nous retourner toutes les données. N'hésitez pas à faire un var_dump() ici pour vérifier que les données sont bien récupérées (mettez des fausses données en BDD).

- `['animaux' => $animaux]` : on envoie à la vue `animal/index.html` la variable `$animaux` qui contient nos données

> **IMPORTANT** vérifiez que `use App\Model\Asset` apparaît bien en haut du fichier, comme c'est le cas dans le fichier `AnimalController` d'exemple.

### Dans la vue, afficher les données

Notre vue `animal/index.html` peut maintenant afficher les données. Voici un exemple : https://github.com/tomsihap/wf3-490-mvc/blob/master/views/animal/index.html

> **IMPORTANT** Vous remarquerez dans la boucle du HTML de animal/index.html que nous créons des liens à chaque ligne. Ils vont vers la page `show` d'un animal. Adaptez le lien à votre cas !

## Afficher la page d'UN asset

Sur le modèle de ce que vous venez de voir et sur les exemples du projet d'exemple, affichez les données d'un seul asset (voir les fichiers `AnimalController.php` et `views/animal/show.html` dans le projet d'exemple : https://github.com/tomsihap/wf3-490-mvc).

## Gérer le formulaire de création d'un asset

1. L'action du formulaire que vous avez créé dans `assets/form.html` doit pointer vers votre route POST de taitement de formulaire. Voici comment créer l'action vers `POST /assets` :

```html
<form action="{{ base_path ~ '/assets'}}" method="post">
```

2. Dans la méthode correspondant à `POST /assets` (`AssetController::new()`),  faites un `var_dump()` de `$_POST` pour vérifier que votre formulaire s'envoie correctement.
3. Comme dans l'exemple de ce controller (méthode `new()`), vous allez créer un objet `Asset` en utilisant ses setters et les données de `$_POST`, puis rediriger vers la page index de assets : https://github.com/tomsihap/wf3-490-mvc/blob/master/src/controller/AnimalController.php
4. Vérifiez si l'asset est bien créé en base de données

## En autonomie: faire un formulaire de contact et afficher les éléments de contact

La partie Assets est terminée !

1. Vous allez maintenant ajouter dans le HTML de la page `show()` d'un Asset un formulaire qui ira vers la route `POST /contact` (`ContactController::new()`). Le fonctionnement du traitement est identique à ce qu'on a pu voir pour assets.

2. Vous allez afficher tous les éléments de contact d'un asset dans la page d'un asset. Pour cela, dans `AssetController::show()`, vous devrez récupérer les éléments de contact pour l'asset demandé. Il vous faudra peut être créer une méthode dédiée dans un Model, sur le même schéma que `findAll()` ou `findOne()` (par exemple : `Asset::findContacts($idAsset)` qui ferait un `SELECT * FROM contact WHERE asset_id = :asset_id`).
