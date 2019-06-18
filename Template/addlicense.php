<?php
$success = false;
if (isset($_POST['license'])) {
    $license = $_POST['license'];
    $base = __DIR__;
    $textfile = fopen($base."/license.txt", "w") or die("Unable to open file!");
    $contents = $license."\n";
    fwrite($textfile, $contents);
    fclose($textfile);
    $success = true;
}
?>
<html>
<head>
    <title>License Test</title>
</head>
<body>
<div class="wrapper">
    <div class="form">
        <?php
        if ($success) {
            ?>
            <p>License added!</p>
            <?php
        } else {
        ?>
        <form method="post" action="">
            Enter your license <input name="license">
            <input type="submit" value="Add">
        </form>
        <?php } ?>
    </div>
</div>
</body>
</html>