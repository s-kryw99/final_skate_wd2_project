<?php
/*
 * Name:Alex Fleming
 * Title: authenticate.php
 * Description: This file has code given to us by the assignment to authenticate certain parts of the webpage.
 *
 */

define('ADMIN_LOGIN','q');
define('ADMIN_PASSWORD','q');
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])
|| ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN)
|| ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) {
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="Our Blog"');
$link = "<a href='index.php' target='_blank'>Click here to visit the Read-Only Pages</a>";

exit("Access Denied: Username and password required. $link");
}
?>
