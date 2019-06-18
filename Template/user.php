<?php
include('config.php');
?>
<? 
 require "../callback/discord.php";
 require "../callback/functions.php";
/* DISCORD OAUTH */

            $extention = is_animated($_SESSION['user_avatar']);

            echo "<img src=" . "'https://cdn.discordapp.com/avatars/" . $_SESSION['user_id'] . "/" . $_SESSION['user_avatar'] . $extention . "'" . "></a></p>";


?>