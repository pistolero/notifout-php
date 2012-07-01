<?php

//check if you have curl loaded
if(!function_exists("curl_init")) die("cURL extension is not installed");

class NotifoutException extends Exception { }

class Notifout {
    function __construct($token, $api_url = 'https://notifout.com') {
        $this->token = $token;
        $this->api_url = $api_url;
    }

    function send($template, $recipient, $data = NULL, $subject=NULL, $sender = NULL) {
        $message = array(
            "template" => $template,
            "recipient" => $recipient,
            "data" => $data,
            "subject" => $subject,
            "sender" => $sender
        );
        $data = array(
            "token" => $this->token, 
            "messages" => array($message));

        $json_url = $this->api_url . '/api/send';
        $json_string = json_encode($data);
        echo $json_string;
        // Initializing curl
        $ch = curl_init( $json_url );

        // Configuring curl options
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json') , //, 'Content-Length'
            CURLOPT_POSTFIELDS => $json_string,
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_CONNECTTIMEOUT => 5
        );

        // Setting curl options
        curl_setopt_array( $ch, $options );
         
        // Getting results
        $result =  curl_exec($ch); // Getting jSON result string

        $result = json_decode($result);

        curl_close($ch);

        if ($result->status == 'error') {
            throw new NotifoutException($result->error);
        }

        return $result;
    }
}

?>