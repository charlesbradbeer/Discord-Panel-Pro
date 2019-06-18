<?php
include('../Template/config.php');
?>
<?
/* Discord OAuth Check */

/* Home Page
 * @owner : Rijuth Menon A.K.A Markis
 * @copyright : https://rijuthmenon.me | https://markis.pw
 * #MarkisHome ------> CUSTOM CODES <---------
 */
 
 // Let's show errors
 error_reporting(E_ALL);
 ini_set('display_errors', 0);
 
 // Let's include our Oauth script and functions script
 require "../callback/discord.php";
 require "../callback/functions.php";

 if (empty($_SESSION['user_id'])) {
    header("Location: https://discordapp.com/api/oauth2/authorize?client_id=" . $clientID . "&redirect_uri=" . $redirectURI . "&response_type=code&scope=identify%20guilds");
    die();

 }else{
     /* Do Nothing */
 }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
<title><?php echo $brandname; ?> - <? echo $_SESSION['username'];?></title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>