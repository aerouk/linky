<?php
/**
 * linky 1.0 application - by aerouk
 * painless and simple url shortening
 * © aerouk 2014
 */

require_once('config.php');
require_once('functions.php');

if ( ! isset($_GET['action'])) {
    redirect(APPLICATION_URL . "?e=na");
}

if ($_GET['action'] == "redirect") {
    if ( ! isset($_GET['uri'])) {
        redirect(APPLICATION_URL . "?e=nouri");
    }

    $uri = $_GET['uri'];

    if ($statement = $connection->prepare("SELECT url FROM linky_urls WHERE uri = ?")) {
        $statement->bind_param("s", $uri);
        $statement->execute();
        $statement->bind_result($url);
        $statement->fetch();
        $statement->close();
        redirect($url != "" ? $url : APPLICATION_URL . "?e=unf");
    }

    $connection->close();
    die();
} elseif ($_GET['action'] == "create") {
    if ( ! isset($_POST['url']) || $_POST['url'] == "") {
        redirect(APPLICATION_URL . "?e=url");
    }

    $url = preg_match("@^https?://@", $_POST['url']) ? $_POST['url'] : "http://" . $_POST['url'];
    $uri = (isset($_POST['uri']) && $_POST['uri'] != "" && ALLOW_CUSTOM_URI && ctype_alnum($_POST['uri'])) ? $_POST['uri'] : generateRandomURI();

    if ($statement = $connection->prepare("INSERT INTO linky_urls (url,uri) VALUES (?, ?)")) {
        $statement->bind_param("ss", $url, $uri);
        $statement->execute();
        $statement->fetch();
        $statement->close();

        if (isset($_POST['api'])) {
            die($url);
        } else {
            redirect(APPLICATION_URL . "?url=$url&uri=$uri");
        }
    }

    $connection->close();
    die();
} else {
    redirect(APPLICATION_URL . "?e=nq");
}
