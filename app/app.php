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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
       return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/", function() use ($app) {
        $name = $_POST['stylist'];
        $stylist = new Stylist($name);
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });

       $app->get("/stylists/{id}", function($id) use ($app) {
           $stylist = Stylist::find($id);
           return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' =>
           $stylist->getClients()));
       });
       ////changed this to render at stylists instead of index

       $app->post("/stylists/{id}", function() use ($app) {
           $stylist = new Stylist($_POST['stylist']);
           $stylist->save();
           return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
       });
       //////not sure why adding this doesn't change the route to stylists .html

       $app->post("/delete_all_stylists", function() use ($app) {
           Stylist::deleteAll();
           return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
       });


       $app->post('/clients', function() use ($app) {
           $name = $_POST['client'];
           $stylist_id = $_POST['stylist_id'];
           $client = new Client($name, $stylist_id, $id = null);
           $client->save();
           $stylist = Stylist::find($stylist_id);
           return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' =>
           $stylist->getClients()));
       });

       $app->post("/delete_all_clients", function() use ($app) {
           Client::deleteAll();
           return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
       });

       $app->get('/stylists/{id}/edit', function ($id) use ($app) {
           $stylist = Stylist::find($id);
           return $app['twig']->render('stylists_edit.html.twig', array('stylist' => $stylist));
       });

       $app->patch("/stylists/{id}", function($id) use ($app) {
           $name = $_POST['name'];
           $stylist = Stylist::find($id);
           $stylist->update($name);
           return $app['twig']->render('stylists.html.twig', array('stylist' => $stylist, 'clients' => $stylist->getClients()));
       });

       $app->delete('/stylists/{id}', function ($id) use ($app) {
           $stylist = Stylist::find($id);
           $stylist->delete();
           return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });




        $app->get('/clients/{id}/edit', function ($id) use ($app) {
            $client = Client::find($id);
            return $app['twig']->render('clients_edit.html.twig', array('client' => $client));
        });

        $app->patch("/clients/{id}", function($id) use ($app) {
            $name = $_POST['name'];
            $client = Client::find($id);
            $client->update($name);
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
        });

        $app->delete('/clients/{id}', function ($id) use ($app) {
            $client = Client::find($id);
            $client->delete();
            return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
         });


       return $app;
   ?>
