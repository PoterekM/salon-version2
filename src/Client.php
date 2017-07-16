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

        function setClientName()
        {
            $this->stylist = (string) $new_name;
        }

        function getId()
        {
            return $this->id;
        }




    }
?>
