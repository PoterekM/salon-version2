<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    ////the array stylists get all allows the stylists to be viewed on the index page. withing the array, 'stylists' allows us to call to stylists on the page.
    $app->get("/", function() use ($app) {
            return $app['twig']->render('index.html.twig', array( 'stylists' => Stylist::getAll()));
        });





    return $app;

?>
