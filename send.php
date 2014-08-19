<?php
require( 'config.inc.php' );
require('FindIP.php');
$success = '';
$error = '';
if( isset( $_POST['send'] ) && $_POST['send'] == 'Send' )
{
    
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $to = $_POST['recipient'];
    $from = MESSAGE_SENDER;
        $tracker = THIS_WEBSITE_URI . '/record.php?log=true&subject=' . urlencode( $subject ) . '&user=' . urlencode( $to );
    
    $message .= '<img border="0" src="'.$tracker.'" width="1" height="1" />';
    
    $headers = "From: $from  <".$from.">\r\n";
    $headers.= "Return-Path: " . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$send = mail( $to, $subject, $message, $headers );
    if( $send )
    {
        $success = 'Message sent with tracking!';
    }
    else
    {
        $error = 'Message send failure!';
    }
}
?>
<html>
    <head>

        <title>Eye-Mail</title>
		<link rel="stylesheet" href="style.css" />

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    </head>
    <body>
    
       
        <?php
        //Output success messages if they exist
        if( !empty( $success ) )
        {
            echo '<div class="success" style="background: green;padding: 15px;">' . $success . '</div>';
        }
        //Output error messages if they exist
        if( !empty( $error ) )
        {
            echo '<div class="error" style="background: red; padding: 15px;">' . $error . '</div>';
        }
        ?>
		<div>
		<center>
		<h1>Eye Mail</h1>

		   <form action="" method="post">
        

            <p>
                <label>To:</label>
                <input type="text" name="recipient" value="" size="57" required/>
            </p>     

	 <p>
                <label>Subject:</label>
                <input type="text" name="subject" value="" size="57" required/>
            </p>
            
            <p>
                <label>Message:</label>
                <textarea name="message" rows="5" cols="54"></textarea>
            </p>
            
  
                <p>
                <input type="submit" name="send" value="Send" class="action"/>
            </p>
            
        </form>
    </center>
	</div>
    </body>
</html>