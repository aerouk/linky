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
    redirect(APPLICATION_URL . "?e=na");
}

if ($_GET['action'] == "redirect")
{
    if ( ! isset($_GET['uri']))
    {
        redirect(APPLICATION_URL . "?e=nouri");
    }

    $uri = $_GET['uri'];

    if ($statement = mysqli_prepare($connection, "SELECT url FROM linky_urls WHERE uri = ?"))
    {
        mysqli_stmt_bind_param($statement, "s", $uri);
        mysqli_stmt_execute($statement);
        mysqli_stmt_bind_result($statement, $url);
        mysqli_stmt_fetch($statement);
        mysqli_stmt_close($statement);
        redirect($url != "" ? $url : APPLICATION_URL . "?e=unf");
    }

    mysqli_close($connection);
    die();
}
elseif ($_GET['action'] == "create")
{
    if ( ! isset($_POST['url']) || $_POST['url'] == "")
    {
        redirect(APPLICATION_URL . "?e=url");
    }

    $url = preg_match("@^https?://@", $_POST['url']) ? $_POST['url'] : "http://" . $_POST['url'];
    $uri = (isset($_POST['uri']) && $_POST['uri'] != "") ? $_POST['uri'] : generateRandomURI();

    if ($statement = mysqli_prepare($connection, "INSERT INTO linky_urls (url,uri) VALUES (?, ?)"))
    {
        mysqli_stmt_bind_param($statement, "ss", $url, $uri);
        mysqli_stmt_execute($statement);
        mysqli_stmt_fetch($statement);
        mysqli_stmt_close($statement);
        redirect(APPLICATION_URL . "?url=$url&uri=$uri");
    }

    mysqli_close($connection);
    die();
}
else
{
    redirect(APPLICATION_URL . "?e=nq");
}
