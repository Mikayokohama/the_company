<?php

    include "../classes/User.php";

    # Create an object
    $user = new User;

    # Call the store function
    $user->store($_POST);
    /**
     *  $_POST = [first_name, last_name, username, password]
     */