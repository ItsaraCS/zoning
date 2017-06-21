<?php
    $user = $_POST['username'];
    $pwd = $_POST['password'];
    
    if ($user != '' && $pwd != '') {
        header( "refresh: 0; url=/zoning-test/map.php" ); exit(0);
        
    } else { header( "refresh: 0; url=/zoning-test/login.php" ); exit(0); }
?>