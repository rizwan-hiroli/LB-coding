<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Route;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Collection;
use DB;
use Log;

class Helper {
    
    
    /* function to send mail*/
    public static function sendEmail($email_to, $details, $view_data, $attachments = null)
    {
  
        try {

            $view_data = $view_data['data'];
            $html = \View::make($details['view'],compact('view_data'))->render();

            $html = (string)$html;
            if(!isset($details['fromName'])){
                $fromName = 'LabelBlind';
            }

            
            $Username = 'rizwanhiroli@gmail.com';
            $Password = '.rizwantopiwala.';
            

            $mail = new PHPMailer;
            $from = 'rizwanhiroli@gmail.com';
            $mail->isSMTP();    // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = $Username;    // SMTP username
            $mail->Password = $Password;    // SMTP password
            $mail->SMTPSecure = 'tls';     
            $mail->Sender = $Username; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;  //995;//465   // TCP port to connect to

            $mail->setFrom($from, 'LabelBlind');    //$from);
            $mail->addAddress($email_to,'LabelBlind');  // Add a recipient
            $mail->addReplyTo($from, 'LabelBlind');
            $mail->Subject = $details['subject'];
            $mail->isHTML(true);    // Set email format to HTML
            $mail->MsgHTML($html);
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $data['email_id'] = $email_to;
            $data['subject'] = $details['subject'];

            if($mail->send()) {
                $data['mail_sent'] = 1;
                $data['error_message'] = null;
                return true;

            } else {
                $data['mail_sent'] = 0;
                $data['error_message'] = $mail->ErrorInfo;
                return false;
            }
            
        }catch (Exception $e) {
            $data['mail_sent'] = 0;
            $data['error_message'] = $e->getMessage();
            return false;
        }
    }   
    
}
?>