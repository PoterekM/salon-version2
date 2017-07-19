<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    // use Symfony\Componenet\Debug\Debug;
    // Debug::enable();



    // $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));


// index shit
    $app->get("/", function() use($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
///good
    $app->post("/", function() use ($app) {
        $stylist = $_POST['stylist'];
        $new_stylist = new Stylist($stylist);
        $new_stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    $app->post("/stylists", function() use ($app) {
        $stylist = new Stylist($_POST['stylist']);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
/// good
    $app->get('/delete_all_stylists', function() use ($app) {
        Stylist::deleteAll();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

////chunk together

    $app->get("/stylists/{id}", function($id) use ($app) {
        $stylist = Stylist::find($id);
        $clients = $stylist->getClients();
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $clients));
    });

    $app->post("/stylists", function() use ($app) {
        $stylist = $_POST['stylist'];
        $client = $_POST['client'];
        $new_client = new Stylist($client);
        $new_client->save();
        return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => Client::getAll()));
    });

    //// this render may have to change

    // $app->get("/stylists", function() use ($app) {
    //     return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    // });


    $app->get("/clients", function() use ($app) {
        return $app['twig']->render('stylists.html.twig', array('clients' => Client::getAll()));
    });


    ///this needs to change
    $app->post("/clients", function() use ($app) {
        $client = $_POST['client_name'];
        $stylist_id = $_POST['stylist_id'];
        $client = new Client($client, $stylist_id);
        $client->save();

        $stylist = Stylist::find($stylist_id);

        return $app['twig']->render('stylists.html.twig', array('stylist_id' => $stylist_id, 'client_name' => $client));
    });



    return $app;

?>
