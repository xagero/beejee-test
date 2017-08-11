<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 10.08.2017 12:08
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    include __DIR__ . '/../head.php';
    ?>

    <style type="text/css"></style>

</head>
<body>
    <div class="container">
        <div class="card card-container">
            <?php
                if (isset($this->content['message'])) {
                    print "<div class='alert alert-danger'>{$this->content['message']}</div>";
                }
            ?>
            <form class="form-login" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" name="identity" value="<?php print $this->content['identity']; ?>" id="identity" class="form-control" placeholder="Login" required autofocus>
                <input type="password" name="credential" id="credential" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-login" type="submit">Sign in</button>
            </form>
        </div>
    </div>
</body>
</html>
