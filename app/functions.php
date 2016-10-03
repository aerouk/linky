<?php
/**
 * linky 1.0 functions - by aerouk
 * painless and simple url shortening
 * © aerouk 2014
 */

function generateRandomURI()
{
    global $connection;

    $an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $uri = "";

    for ($i = 0; $i < 5; $i++) {
        $uri .= substr($an, rand(0, strlen($an)), 1);
    }

    $query = $connection->query("SELECT * FROM linky_urls WHERE uri = '$uri'");

    if ($query->num_rows > 0) {
         generateRandomURI();
         die();
    } else {
        return $uri;
    }
}

function redirect($url)
{
    header('Location: ' . $url, true, 301);
    die();
}
