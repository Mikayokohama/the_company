<?php

    include "../classes/User.php";

    $user = new User;

    $user->update($_POST, $_FILES);
    /**
     * NOTE:
     * 
     * $_POST - holds the first_name, last_name and username from the form
     * $_FILES - holds the photo/image uploaded in the form
     */