<?php
/**
 * Generate a low-rent CAPTCHA based on the first-gen Pokemon
 *
 * @author Bill Israel <bill.israel@gmail.com>
 */

session_start();
$pokemon = require_once __DIR__ . '/pokemon.cache.php';

if (isset($_POST['pokemon'])) {
    if (strcasecmp($_SESSION['pokemon'][1], trim($_POST['pokemon'])) === 0) {
        $message = "You're a human!";
        unset($_SESSION['pokemon']);
    } else {
        $message = "You're a bot!";
    }
}

if (!isset($_SESSION['pokemon']) || isset($_GET['new'])) {
    $rand = mt_rand(1, 151);
    $_SESSION['pokemon'] = array($rand, $pokemon[$rand]);
}
?>

<html>
<head>

</head>
<body>
    <form action="" method="post">
        <img src="images/<?php echo $_SESSION['pokemon'][0] ?>.png"/> <br/>
        <input type="text" name="pokemon" placeholder="Name this Pokemon..."/>
        <input type="submit" value="Go!"/>
        <a href="?new">Get another Pokemon</a>
    </form>

    <?php if (isset($message)): ?>
    <p class="message"><?php echo $message ?></p>
    <?php endif ?>

    <p class="copyright">Pokemon belong to <a href="http://nintendo.com/">Nintendo</a>, not to me. They just make for a fun CAPTCHA.</p>
</body>
</html>

