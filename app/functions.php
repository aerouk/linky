<?php
/**
 * linky 1.0 functions - by aerouk
 * painless and simple url shortening
 * © aerouk 2014
 */

function redirect($url)
{
    header('Location: ' . $url, true, 301);
    die();
}