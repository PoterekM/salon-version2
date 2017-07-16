<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            // Stylist::deleteAll();
        }

        function testSave()
        {
            $stylist = "Lucy";
            $test_stylist = new Stylist($stylist);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = "jarjarbinks";

            $test_client = new Client($client_name, $stylist_id);

            $test_client->save();

            $executed = $test_client->save();

            $this->assertTrue($executed, "Better luck next time");
        }
//should be alright
    function testGetClientName()
    {
        $stylist = "Lucy";
        $test_stylist = new Stylist($stylist);
        $test_stylist->save();
        $stylist_id = $test_stylist->getId();

        $client_name = "BurrGurr";
        $test_client = new Client($client_name, $stylist_id);
        $test_client->save();

        $result = $test_client->getClientName();

        $this->assertEquals($client_name, $result);
    }

//fixed
    function testSetClientName()
    {
        $stylist = "jamba";
        $test_stylist = new Stylist($stylist);
        $test_stylist->save();
        $stylist_id = $test_stylist->getId();

        $client_name = "Yannni";
        $test_client = new Client($client_name, $stylist_id);
        $test_client->save();
        $new_name = "Yawhni";

        $test_client->setClientName($new_name);
        $result = $test_client->getClientName();

        $this->assertEquals($new_name, $result);
    }
////should be ok?
    function testGetId()
    {
        //Arrange
        $stylist = "Hunny";
        $test_stylist = new Stylist($stylist);
        $test_stylist->save();
        $stylist_id = $test_stylist->getId();

        $client_name = "Drewberrz";
        $test_client = new Client($client_name, $stylist_id);
        $test_client->save();

        //Act
        $result = $test_client->getId();

        //assert
        $this->assertEquals(true, is_numeric($result));
    }


    /////wowoowowowoowow should be okay

    function testGetStylistId()
    {
        $stylist = "Lola";
        $test_stylist = new Stylist($stylist);
        $test_stylist->save();
        $stylist_id = $test_stylist->getId();

        $client_name = "Gertrude";
        $test_client = new Client($client_name, $stylist_id);
        $test_client->save();

        $client_name2 = "Gertrude";
        $test_client2 = new Client($client_name2, $stylist_id);
        $test_client->save();

        $result = $test_client->getStylistId();

        $this->assertEquals($stylist_id, $result);
    }

//again, everything looks okay
    function testGetAll()
    {
        $stylist = "rick james";
        $test_stylist = new Stylist($stylist);
        $test_stylist->save();
        $stylist_id = $test_stylist->getId();

        $client_name = "JimiInGetAll";
        $test_client = new Client($client_name, $stylist_id);
        $test_client->save();


        $client_name2 = "AlpertInGetAll";
        $test_client2 = new Client($client_name2, $stylist_id);
        $test_client2->save();

        $result = Client::getAll();

        $this->assertEquals([$test_client, $test_client2], $result);
    }

    function testDeleteAll()
    {
        $stylist = "rickkik james";
        $test_stylist = new Stylist($stylist);
        $test_stylist->save();
        $stylist_id = $test_stylist->getId();

        $client_name = "juniper";
        $test_client = new Client($client_name, $stylist_id);
        $test_client->save();

        $client_name2 = "juniper";
        $test_client2 = new Client($client_name2, $stylist_id);
        $test_client2->save();


        Client::deleteAll();
        $result = Client::getAll();

        $this->assertEquals([], $result);
    }

    function testFind()
    {
        $stylist = "Mona";
        $test_stylist = new Stylist($stylist);
        $test_stylist->save();
        $stylist_id = $test_stylist->getId();

        $client_name = "Jimmmi";
        $test_client = new Client($client_name, $stylist_id);
        $test_client->save();


        $client_name2 = "Alpbpbert";
        $test_client2 = new Client($client_name2, $stylist_id);
        $test_client2->save();

        $result = Client::find($test_client2->getId());

        $this->assertEquals($test_client2, $result);
    }





    }
?>
