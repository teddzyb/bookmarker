<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta property='og:title' content='Bookmarker by Edwin Bartlett' />
    <meta property='og:description' content='Web Dev 2' />
    <meta property='og:image' content='' />
    <title>Bookmarker</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='icon' href='favicon.ico'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU' crossorigin='anonymous'>
</head>
<style>
    /* div {
        border: 1px solid black;
    } */
</style>
<body class="bg-dark">
    <div>
        <!-- nav bar -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm rounded-2 bg-secondary mt-4 mb-5 pb-1 pt-1">
                    <div class="row">
                        <div class="col-sm-2 text-light btn">
                        <button class="btn btn-secondary"><b>Bookmarker</b></button>
                        </div>
                        <div class="col-sm-2 text-light btn">
                            <button class="btn btn-secondary">Home</button>
                        </div>
                        <div class="col container">
                            <div class="row justify-content-end">
                                <form class="col-sm-3 text-light btn" action="" method="post">
                                    <button class="btn btn-secondary" type="submit" name="clearall" id="clearall">Clear All</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <!-- left column -->
                <div class="col-sm-5 me-5">
                    <form action="" method="POST">
                        <label class="text-light form-label" for="webname">Website Name</label>
                        <input class="form-control mb-3" type="text" name="webname" id="webname">
                        <label class="text-light form-label" for="weburl">Website URL</label>
                        <input class="form-control mb-3" type="text" name="weburl" id="weburl">
                        <button class="btn btn-light mt-2" type="submit" name="submit" id="submit">Bookmark</button>
                    </form>
                </div>

                <!-- right column -->
                <div class="col-sm-4">

                    <?php
                        // deleting all bookmarks
                        if (isset($_POST['clearall'])) {
                            session_destroy();
                            header("Refresh:0");
                        }

                        // deleting bookmark
                        foreach ($_SESSION as $name => $url) {
                            if (isset($_POST[$name])) {
                                unset($_SESSION[$_POST[$name]]);
                                header("Refresh:0");
                            }
                        }

                        // adding bookmark
                        if (isset($_POST['submit']) && $_POST['webname'] != "" && $_POST['weburl'] != "") {
                            $_SESSION[str_replace(" ", "%20", $_POST['webname'])] = $_POST['weburl'];
                            header("Refresh:0");
                        }

                        // displaying bookmarks
                        foreach ($_SESSION as $name => $url) {
                        ?>
                            <div class="card">
                                <div class="card-body row">
                                    <div class="col">
                                        <a href="<?php echo $url ?>" class="link-success text-decoration-none" target="_blank"><?php echo str_replace("%20", " ", $name); ?></a>
                                    </div>
                                    <div class="col">
                                        <div class="row justify-content-end pe-3">
                                            <form class="row justify-content-end" action="" method="post">
                                                <button type="submit" class="btn-close" name="<?php echo $name ?>" value="<?php echo $name ?>" id="<?php echo $name ?>" aria-label="Clear"></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js' integrity='sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ' crossorigin='anonymous'></script>
</body>
</html>