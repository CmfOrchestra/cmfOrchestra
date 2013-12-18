<?php
    if (isset($_GET['expire']) && !empty($_GET['expire'])) {
        $expire = time()+$_GET['expire'];
    } else {
        $expire = time()+84600;
    }
    
    if (
            isset($_GET['user']) && !empty($_GET['user'])
            &&
            isset($_GET['application']) && !empty($_GET['application'])
            &&
            isset($_GET['key']) && !empty($_GET['key'])
    ) {
        setcookie('orchestra-ws-user-id',$_GET['user'],$expire,'/');
        setcookie('orchestra-ws-application-id',$_GET['application'],$expire,'/');
        setcookie('orchestra-ws-key',$_GET['key'],$expire,'/');
    }
?>