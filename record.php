<?php
/**
 * record.php
 * Handles email logging to database as requested by email clients to load 'blank.gif'
 * Plain text emails cannot be tracked in the same way
 * This example uses my MySQLI db class, however, (obviously) use whatever you'd like for databases
 * Link to db class: http://www.phpdevtips.com/2013/06/updated-mysqli-database-class/
 * Documenation on this particular implementation at: http://www.phpdevtips.com/2013/06/email-open-tracking-with-php-and-mysql
 *
 * @author Bennett Stone
 * @version 1.0
 * @date 07-Jun-2013
 * @website www.phpdevtips.com
 * @package Email Open Tracker
 **/

 
 
    function realip(){

        $ip = $_SERVER['REMOTE_ADDR'];     
        if($ip){
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            return $ip;
        }
        // There might not be any data
        return false;
    }
$ipaddress=$_SERVER['HTTP_USER_AGENT'];

 
//Only initiate ANYTHING if the request has the correct params from our sent email
if( !empty( $_GET['log'] ) && $_GET['log'] == 'true' && !empty( $_GET['user'] ) && !empty( $_GET['subject'] ) )
{
    
    //Include the configuration file with the db creds and file locations
    require( 'config.inc.php' );

    //Include the database class
    require( 'class.db.php' );
    
    //Initiate the database class
    $database = new DB();
    
    //Begin the header output
    header( 'Content-Type: image/gif' );
    
    //Assign the user and message to sanitized variables
    $user = $database->filter( $_GET['user'] );
    $subject = $database->filter( $_GET['subject'] );

    //Make sure we aren't duplicating the insertion
    $exist_count = $database->num_rows( "SELECT user FROM email_log WHERE user = '$user' AND subject = '$subject'" );

    //No prior record of this message open exists
    if( $exist_count == 0 )
    {
        
        //Make an array of columns => data
        $insert_record = array(
            'user' => $user, 
            'subject' => $subject,
			'ip'=>$ipaddress
        );
        //Insert the information into the email_log table
        $database->insert( 'email_log',  $insert_record );
        
    }
    
    //Get the http URI to the image
    $graphic_http = THIS_WEBSITE_URI .'/blank.gif';
    
    //Get the filesize of the image for headers
    $filesize = filesize( THIS_ABSOLUTE_PATH . '/blank.gif' );
    
    //Now actually output the image requested, while disregarding if the database was affected
    header( 'Pragma: public' );
    header( 'Expires: 0' );
    header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
    header( 'Cache-Control: private',false );
    header( 'Content-Disposition: attachment; filename="blank.gif"' );
    header( 'Content-Transfer-Encoding: binary' );
    header( 'Content-Length: '.$filesize );
    readfile( $graphic_http );
    
    //All done, get out!
    exit;
}