/************************************************************
  @ Module     : ESP32 OTA basic
                 (checking time of the file in server) source.
  @ Language   : PHP
  @ Affiliated : Sookmook Future Informatics Foundation
  @ Auther     : Young-min Ji (E-Mail : sookmook@sookmook.org)
  @ Made       : 2021/05/19
  @ Modified   : 2021/06/27 (for versatility)
************************************************************/


<?php
$filename = 'YOUR_BINARY_FILE';
if (file_exists($filename)) {
  echo filemtime($filename) ;
}
?>
