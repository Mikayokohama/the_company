<?php

    include "../classes/User.php";

    # create object
    $user = new User;

    # Call the login method
    $user->login($_POST);

    