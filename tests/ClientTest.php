<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once "src/Client.php";
    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ClientTest extends PHPUnit_Framework_TestCase
    {

    function testGetClientName()
    {
        $client_name = "Burmie";
        $test_client = new Client($client_name);
        // $test_client->save();

        $result = $test_client->getClientName();

        $this->assertEquals($client_name, $result);
    }

    function testSetClientName()
    {
        $client_name = "Yannni";
        $test_client = new Client($client_name);
        $new_name = "Yawhni";

        $test_client->setClientName($new_name);
        $result = $test_client->getClientName();

        $this->assertEquals($new_name, $result);
    }

    function testGetId()
    {
        //Arrange
        $client_name = "Drewberrz";
        $test_client = new Client($client_name);
        $test_client->save();

        //Act
        $result = $test_client->getId();

        //assert
        $this->assertEquals(true, is_numeric($result));
    }

    function testSave()
    {
        $client_name = "jarjarbinks";
        $test_client = new Client($client_name);

        $executed = $test_client->save();

        $this->assertTrue($executed, "I'd rather not save your testSave");

    }


    }
?>
