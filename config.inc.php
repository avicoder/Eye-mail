<?php


define( 'DB_HOST', 'localhost' ); // set database host
define( 'DB_USER', 'hackerhe_wrdp1' ); // set database user
define( 'DB_PASS', '7Viv4KJKkPYQHVGJ' ); // set database password
define( 'DB_NAME', 'hackerhe_a' ); // set database name
define( 'SEND_ERRORS_TO', 'avinash.mankoo@gmail.com' ); //set email notification email address
define( 'DISPLAY_DEBUG', true ); //display db errors?
define( 'MESSAGE_SENDER', 'avinash.mankoo@gmail.com' );

//Assign a constant to the location of THESE files to use
define( 'THIS_WEBSITE_URI', 'http://' . $_SERVER['HTTP_HOST'] . dirname( $_SERVER['REQUEST_URI'] ) );
define( 'THIS_ABSOLUTE_PATH', dirname( __FILE__ ) );