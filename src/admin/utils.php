<?php
    function redirect($url){
        $string = '<script type="text/javascript">';
        $string .= 'window.location = "' . $url . '"';
        $string .= '</script>';
        echo $string;
    }
    function test_input($data, $type="") {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      if ($type == "username"){
        echo "<script>console.log(' result: " . $type . "' );</script>";
      }
      return $data;
    }
?>
