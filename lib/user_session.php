<?php
    class User_Session{
        public static function init(){
           if (version_compare(phpversion(), '5.4.0', '<')) {
                 if (session_id() == '') {
                     session_start();
                 }
             } else {
                 if (session_status() == PHP_SESSION_NONE) {
                     session_start();
                 }
             }
          }
         
          public static function set($key, $val){
             $_SESSION[$key] = $val;
          }
         
          public static function get($key){
             if (isset($_SESSION[$key])) {
              return $_SESSION[$key];
             } else {
              return false;
             }
          }
         
          public static function checkSession(){
             self::init();
             if (self::get("user_login") == false) {
              return false;
             }
             return true;
          }
         
          public static function checkLogin(){
            self::init();
            if (self::get("user_login")== true) {
               if(isset($_GET['action'])){
                  $action = $_GET['action'];
                  header("Location:'.$action.'.php");
               }else{
                  header("Location:index.php");
               }
            }
          }
         
          public static function destroy(){
            session_unset();
            session_destroy();
            header("Location:login.php");
          }
         }
?>