<?php
        //session_start();
        session_destroy();
        //$_SESSION['username'] = NULL;
        unset($_SESSION['username']);
        header('location:index.html');
        exit;
        
?>