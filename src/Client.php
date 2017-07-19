<?php
    class Client
    {
        private $client_name;
        private $stylist_id;
        private $id;

        function __construct($client_name, $stylist_id, $id = null)
        {
            $this->client_name = $client_name;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }
//good
        function getClientName()
        {
            return $this->client_name;
        }
//good
        function setClientName($new_name)
        {
            $this->client_name = (string)$new_name;
        }
//gppd
        function getId()
        {
            return $this->id;
        }
//good
        function getStylistId()
        {
            return $this->stylist_id;
        }
//should be good
        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO clients (name, stylist_id) VALUES ('{$this->getClientName()}', {$this->getStylistId()})");
            if ($executed) {
                $this->id= $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }
//should be good
        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach ($returned_clients as $client) {
                $client_name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client ($client_name, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

//should be good
        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM clients;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }
//should be good
        static function find($search_id)
        {
            $found_client = null;
            $returned_clients = $GLOBALS['DB']->prepare("SELECT * FROM clients WHERE id = :id");
            $returned_clients->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_clients->execute();
            foreach($returned_clients as $client) {
                $client_name = $client['name'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                if ($id == $search_id) {
                    $found_client = new Client($client_name, $stylist_id, $id);
                }
            }
            return $found_client;
        }

        function update($new_name)
        {
            $executed = $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
            if ($executed) {
                $this->setClientName($new_name);
                return true;
            } else {
                return false;
            }
        }

        function delete()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }





    }
?>
