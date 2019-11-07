<?php
    session_start();
    session_destroy();
    // Redirects you to the landing page:
    header('Location: index.html');
?>