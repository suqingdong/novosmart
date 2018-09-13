<?php

function connect($dbname)
{
    if ( ! file_exists($dbname) )
    {
        echo '[error] database not exists: ' . $dbname;
        exit(1);
    }
    
    $db = new SQLite3($dbname);
    
    return $db;
}
?>