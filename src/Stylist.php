<?php
    class Stylist
    {
        private $stylist;
        private $id;

        function __construct($stylist, $id = null)
        {
            $this->stylist = $stylist;
            $this->id = $id;
        }

        function getStylist()
        {
            return $this->stylist;
        }

        function setStylist($new_stylist)
        {
            $this->stylist = (string) $new_stylist;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO stylists (stylist) VALUES ('{$this->getStylist()}');");
            if ($executed) {
                $this->id = $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        // static function find($search_id)
        // {
        //     $found_stylist = null;
        //     $returned_stylists = $GLOBALS['DB']->prepare("SELECT * FROM stylists WHERE id = :id");
        //     $returned_stylists->bindParam(':id', $search_id, PDO::PARAM_STR);
        //     $returned_stylists->execute();
        //     foreach($returned_stylists as $stylist) {
        //         $stylist = $stylist['stylist'];
        //         $id = $stylist['id'];
        //         if ($id == $search_id) {
        //             $found_stylist = new Stylist($stylist, $id);
        //         }
        //     }
        //     return $found_stylist;
        // }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists_array = array();
            foreach ($returned_stylists as $stylist) {
                $id = $stylist['id'];
                $stylist = $stylist['stylist'];
                $new_stylist = new Stylist($stylist, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists_array;
        }



        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM stylists;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }


    }

?>
