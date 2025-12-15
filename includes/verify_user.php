<?php

    class verify_user {
        
        public static function isLoggued(){
            if(!isset($_SESSION['logueado']) || $_SESSION['logueado'] !== true){
                header('Location: ../index.php');
                exit();
            }
        }

        public static function getUserLoggin(){
            return $_SESSION['usuario'] ?? null;
        }

        public static function closeSession(){
            session_unset();
            session_abort();
            session_destroy();
            header('Location: /');
            exit();
        }
    }

?>