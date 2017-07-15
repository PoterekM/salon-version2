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

        function testSave()
        {
            $stylist = "Lucy";
            $test_stylist = new Stylist($stylist);

            $executed = $test_stylist->save();

            $this->assertTrue($executed, "This stylist wasn't saved, bro.");
        }

        function testGetAll()
        {
            $stylist = "Jimi";
            $test_stylist = new Stylist($stylist);
            $test_stylist->save();

            $stylist2 = "Alpert";
            $test_stylist2 = new Stylist($stylist2);
            $test_stylist2->save();

            $result = Stylist::getAll();

            $this->assertEquals([$test_stylist, $test_stylist2], $result);
        }

        function testFind()
        {
            $stylist = "Jimmmi";
            $test_stylist = new Stylist($stylist);
            $test_stylist->save();

            $stylist2 = "Alpbpbert";
            $test_stylist2 = new Stylist($stylist2);
            $test_stylist2->save();

            $result = Stylist::find($test_stylist2->getId());

            $this->assertEquals($test_stylist2, $result);
        }





        function testDeleteAll()
        {
            $stylist = "Bobbo";
            $stylist2 = "Rudy";
            $test_stylist = new Stylist($stylist);
            $test_stylist->save();
            $test_stylist2 = new Stylist($stylist2);
            $test_stylist2->save();

            Stylist::deleteAll();
            $result = Stylist::getAll();

            $this->assertEquals([], $result);

        }





    }

?>
