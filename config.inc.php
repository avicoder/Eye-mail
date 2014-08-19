<?php


define( 'DB_HOST', 'localhost' ); // set database host
define( 'DB_USER', '' ); // set database user
define( 'DB_PASS', '' ); // set database password
define( 'DB_NAME', '' ); // set database name
define( 'SEND_ERRORS_TO', '' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?
define( 'MESSAGE_SENDER', '' ); //set  your  email

//Assign a constant to the location of THESE files to use
define( 'THIS_WEBSITE_URI', 'http://' . $_SERVER['HTTP_HOST'] . dirname( $_SERVER['REQUEST_URI'] ) );
define( 'THIS_ABSOLUTE_PATH', dirname( __FILE__ ) );