<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";


    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    // use Symfony\Componenet\Debug\Debug;
    // Debug::enable();


    $app = new Silex\Application();
    // $app['debug'] = true;
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig', array(Stylist::getAll()));
    });

    $app->post("/", function() use ($app) {
        $stylist = $_POST['stylist'];
        $new_stylist = new Stylist($stylist);

        $new_stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get('/delete_all_stylists', function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function() use ($app) {
        $category = new Stylist($_POST['stylist']);
        $category->save();
        return $app['twig']->render('index.html.twig', array('categories' => Stylist::getAll()));
    });

    return $app;

?>
