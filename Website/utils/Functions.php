<?php

namespace utils;

include_once ("model/Database.php");
use model\Database;

class Functions
{
    public static function redir($location)
    {
        echo "<script>location.href='".$location."';</script>";
    }
}

?>