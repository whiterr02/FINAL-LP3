<?php
function getDB()
{
    $db = new PDO("mysql:host=localhost;dbname=dbfinal", "root", "wltr6969");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
}
