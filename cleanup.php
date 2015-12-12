<?php

    include "xmlapi.php.inc";
    include "config.php.inc";

    $xmlapi = new xmlapi($server);
    $xmlapi->password_auth($account, $password);
    $xmlapi->set_port(2083);
    $xmlapi->set_debug(0);

     $args = array(
        'checkleaf'     => '1',
        'dir'           => $backup_folder,
        'filelist'      => '0',
        'filepath-*'    => '',
        'needmime'      => '0',
        'showdotfiles'  => '0',
        'types'         => 'file',
       );

      $list = $xmlapi->api2_query($account, 'Fileman', 'listfiles', $args);

      $files = array();

      

        foreach ($list->data as $item) {
             $files[] = array($item->file, $item->mtime, $item->ctime, $item->fullpath, $item->humansize);
         }

        foreach ($files as $file) {
             if ($file[1] < $retention) {

                $files = $backup_folder . '/' . $file[0];

              $args = array(
                'op'                => 'unlink',
                'sourcefiles'       => $files,
                'destfiles'         => $backup_folder,
                'doubledecode'      => '0',
                );

                $xmlapi = new xmlapi($server);
                $xmlapi->password_auth($account, $password);
                $xmlapi->set_port(2083);

                return $xmlapi->api2_query($account, 'Fileman', 'fileop', $args);

           }
         }

?>
