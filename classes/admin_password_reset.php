<?php
include($_SERVER['DOCUMENT_ROOT'] . "/lib/database.php");
include($_SERVER['DOCUMENT_ROOT'] . "/helpers/format.php");

?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class admin_reset_pass
{
    private $db;
    private $fm;
    public $mail = new PHPMailer(true);

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function send_password_reset($get_name, $get_email, $Token)
    {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'user@example.com';                     //SMTP username
        $mail->Password   = 'secret';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('from@example.com', $get_name);
        $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    }

    public function reset_pass($Email)
    {
        $Email = $this->fm->validation($Email);
        $Token = md5(rand());

        $Email = mysqli_real_escape_string($this->db->link, $Email);

        if (empty($Email)) {
            $alert = "Email can't be empty";
            return $alert;
        } else {
            $query = "SELECT * FROM admin WHERE Email = '$Email' LIMIT 1";
            $result = $this->db->select($query);
        }

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            $get_name = $row['Username'];
            $get_email = $row['Email'];

            $update_token = "UPDATE admin SET verify_token='$Token' WHERE email='$get_email' LIMIT 1";
            $update_token_result = $this->db->select($update_token);

            if ($update_token_result) {
                send_password_reset($get_name, $get_email, $Token);
                $_SESSION['status'] = 'We sent you a password reset link';
                header("Location: forgot-password.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "No Email Found";
            header("Location: forgot_password.php");
            exit(0);
        }
    }
}
?>