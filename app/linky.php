<?php
/**
 * linky 1.0 application - by aerouk
 * painless and simple url shortening
 * © aerouk 2014
 */

require_once('config.php');
require_once('functions.php');

if ( ! isset($_GET['action']))
{
    redirect(APPLICATION_URL);
    die();
}

if ($_GET['action'] == "redirect")
{
    if ( ! isset($_GET['uri']))
    {
        redirect(APPLICATION_URL);
        die();
    }

    $uri = $_GET['uri'];

    if ($statement = mysqli_prepare($connection, "SELECT url FROM linky_urls WHERE uri = ?"))
    {
        mysqli_stmt_bind_param($statement, "s", $uri);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $url);
        mysqli_stmt_fetch($statement);
        mysqli_stmt_close($statement);
        redirect($url != "" ? $url : APPLICATION_URL);
    }

    mysqli_close($connection);
    die();
}
elseif ($_GET['action'] == "create")
{
    // to-do
}
else
{
    redirect(APPLICATION_URL);
    die();
}
