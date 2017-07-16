<?php
    class Client
    {
        private $client_name;
        private $id;

        function __construct($client_name, $id = null)
        {
            $this->client_name = $client_name;
            $this->id = $id;
        }

        function getClientName()
        {
            return $this->client_name;
        }

        function setClientName($new_name)
        {
            $this->client_name = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }


        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO clients (name) VALUES ('{$this->getClientName()}');");
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
                $id = $client['client_id'];
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




    }
?>
