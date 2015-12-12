<?php

    include "xmlapi.php.inc";
    include "config.php.inc";

    $ftpserver = $server;
    $type = "passiveftp";
    $ftpacct = $account; 
    $ftppass = $password;
    $email_notify = $email;
    $ftp_port = 21;
    $path = $backup_folder;

    $xmlapi = new xmlapi($server);
    $xmlapi->password_auth($account,$password);
    $xmlapi->set_port(2083);
    $xmlapi->set_debug(0);

    $args = array($type, $server, $account, $password, $email_notify, $ftp_port, $path);

    return $xmlapi->api1_query($account,'Fileman','fullbackup',$args);

?>