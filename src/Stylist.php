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


        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach ($returned_stylists as $stylist) {
                $stylist_name = $stylist['stylist'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($stylist_name, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $returned_stylists = $GLOBALS['DB']->prepare("SELECT * FROM stylists WHERE id = :id");
            $returned_stylists->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_stylists->execute();
            foreach($returned_stylists as $stylist) {
                $stylist_name = $stylist['stylist'];
                $stylist_id = $stylist['id'];
                if ($stylist_id == $search_id) {
                    $found_stylist = new Stylist($stylist_name, $stylist_id);
                }
            }
            return $found_stylist;
        }

        function getClients()
        {
            $clients = array();
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
            foreach ($returned_clients as $client) {
                $client_name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client ($client_name, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
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

        function update($new_stylist)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE stylists SET stylist = '{$new_stylist}' WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setStylist($new_stylist);
                return true;
            } else {
                return false;
            }
        }

        function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }


    }

?>
