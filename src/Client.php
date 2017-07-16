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




    }
?>
