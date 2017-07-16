<?php
    class Client
    {
        private $client_name;
        private $id;
        private $stylist_id;

        function __construct($client_name, $id = null, $stylist_id)
        {
            $this->client_name = $client_name;
            $this->id = $id;
            $this->stylist_id = $stylist_id;
        }

        function getClientName()
        {
            return $this->client_name;
        }

        function setClientName($new_name)
        {
            $this->client_name = (string)$new_name;
        }

        function getId()
        {
            return $this->id;
        }

        function getStylistId()
        {
            return $stylist_id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO clients (name) VALUES ('{$this->getClientName()}', {$this->getStylistId()})");
            if ($executed) {
                $this->id= $GLOBALS['DB']->lastInsertId();
                return true;
            } else {
                return false;
            }
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients_array = array();
            foreach ($returned_clients as $client) {
                $client_name = $client['name'];
                $id = $client['id'];
                $new_client = new Client($client_name, $id);
                array_push($clients_array, $new_client);
            }
            return $clients_array;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM clients;");
            if ($executed) {
                return true;
            } else {
                return false;
            }
        }

        static function find($search_id)
        {
            $found_client = null;
            $returned_clients = $GLOBALS['DB']->prepare("SELECT * FROM clients WHERE id = :id");
            $returned_clients->bindParam(':id', $search_id, PDO::PARAM_STR);
            $returned_clients->execute();
            foreach($returned_clients as $client) {
                $client_name = $client['name'];
                $id = $client['id'];
                if ($id == $search_id) {
                    $found_client = new Client($client_name, $id);
                }
            }
            return $found_client;
        }






    }
?>
