<?php
    require_once('../../app/config.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo APPLICATION_NAME; ?> &middot; home</title>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    </head>

    <body>
        <div class="container">
            <h1 class="page-header">
                <?php echo APPLICATION_NAME; ?>
                <small>url shortener</small>
            </h1>

            <div class="col-md-6">
                <?php
                    if (isset($_GET['url']) && $_GET['uri'])
                    {
                        $url = $_GET['url'];
                        $uri = APPLICATION_URL . $_GET['uri'];

                        ?>
                        <div class="alert alert-success">
                            <a href="/" class="close">&times;</a>
                            <b>Link created!</b><br><a class="alert-link" href="<?php echo $url; ?>"><?php echo $url; ?></a> was shortened to <a class="alert-link" href="<?php echo $uri; ?>"><?php echo $uri; ?></a>!
                        </div>
                        <?php
                    }

                    if (isset($_GET['e']))
                    {
                        switch ($_GET['e'])
                        {
                            case 'na': $ex = "linky didn't receive an action to run"; break;
                            case 'nouri': $ex = "linky didn't receive a URI to redirect to"; break;
                            case 'unf': $ex = "linky didn't find that URI in its database, so it can't redirect you"; break;
                            case 'url': $ex = "linky didn't receive a URL to add to its database"; break;
                            case 'nq': $ex = "linky didn't find support for that query in its code"; break;
                            
                            default: $ex = "linky doesn't know how to handle that error!"; break;
                        }

                        ?>
                        <div class="alert alert-danger">
                            <a href="/" class="close">&times;</a>
                            <?php echo $ex; ?>
                        </div>
                        <?php
                    }
                ?>

                <form action="/create" method="post">
                    <input type="text" name="url" class="form-control" placeholder="URL">
                    <p></p>
                    <input type="text" name="uri" class="form-control" placeholder="URI (leave blank to generate a random one)">
                    <p></p>
                    <button type="submit" class="btn btn-primary btn-xs btn-block">Create Short URL</button>
                </form>
            </div>
        </div>
    </body>
</html>
