<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StylistTest extends PHPUnit_Framework_TestCase
    {
        function testGetStylist()
        {
            //Arrange
            $stylist = "Nancy";
            $test_stylist = new Stylist($stylist);

            //Act
            $result = $test_stylist->getStylist();
            //Assert
            $this->assertEquals($stylist, $result);
        }

        function testSetStylist()
        {
            $stylist = "Yani";
            $test_stylist = new Stylist($stylist);
            $new_stylist = "Yawni";

            $test_stylist->setStylist($new_stylist);
            $result = $test_stylist->getStylist();

            $this->assertEquals($new_stylist, $result);
        }

        function testGetId()
        {
            //Arrange
            $stylist = "Drew";
            $test_stylist = new Stylist($stylist);
            $test_stylist->save();

            //Act
            $result = $test_stylist->getId();

            //assert
            $this->assertTrue(is_numeric($result));
        }




    }

?>
