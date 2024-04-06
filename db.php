<?php

// // $hostname = "phpmyadmin2.thestagingurl.com"; // Replace with the domain name you want to resolve

// // $ip = gethostbyname($hostname);

// // if ($ip != $hostname) {
// //     echo "The IP address of $hostname is: $ip";
// // } else {
// //     echo "Failed to resolve the IP address of $hostname";
// // }

// $db_host = '127.0.0.1';
// $db_user = 'root';
// $db_pass = '';
// $db_name = 'INTERVIEWTASK';
// $db_port = '3306';

// $conn = new mysqli($db_host, $db_user, $db_pass, $db_name,$db_port);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// //echo "Connected successfully";

class DB
{
    public $db;


    function __construct()
    {
    }

    // Create connection
    public function createConnection()
    {
        $db_host = '127.0.0.1';
        $db_user = 'root';
        $db_pass = '';
        $db_name = 'INTERVIEWTASK';
        $db_port = '3306';
        $this->db = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);
        // Check connection
        if ($this->db->connect_error) {
            die("Connection failed: " .  $this->db->connect_error);
        }
    }

    //function to execute the SQL commands
    public function executeQuery($sql)
    {


        $this->createConnection();

        $result = $this->db->query($sql);
        $this->db->close();
        return $result;
    }
}
