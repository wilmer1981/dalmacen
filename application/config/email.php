<?php defined('BASEPATH') OR exit('No direct script access allowed');



    $ajuste = getAjustes('config');

    $smtp_engine	= $ajuste['config_mail_engine'];
    $smtp_parameter	= $ajuste['config_mail_parameter'];
    $smtp_hostname  = $ajuste['config_mail_smtp_hostname'];
    $smtp_username  = $ajuste['config_mail_smtp_username'];
    $smtp_password  = $ajuste['config_mail_smtp_password'];
    $smtp_port      = $ajuste['config_mail_smtp_port'];
    $smtp_timeout   = $ajuste['config_mail_smtp_timeout'];

	$config = array(
		'protocol'  => $smtp_engine, // 'mail', 'sendmail', or 'smtp'
		'smtp_host' => $smtp_hostname, // Example: mail.example.com
		'smtp_port' => $smtp_port, // '465', '25' or '587'.
		'smtp_user' => $smtp_username, // Example: user@example.com
		'smtp_pass' => $smtp_password,
		'smtp_crypto' => 'security', //can be 'ssl' or 'tls' for example
		'mailtype' => 'html', //plaintext 'text' mails or 'html'
		'smtp_timeout' => $smtp_timeout, //in seconds
		//'charset' => 'iso-8859-1',
		'charset' => 'UTF-8',
		'wordwrap' => TRUE,
		'newline' => "\r\n"
	);


/*
$config = array(
    'protocol' => 'ssmtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'ssl://ssmtp.googlemail.com',
    'smtp_port' => '465',
    'smtp_user' => 'wilmer1981@gmail.com',
    'smtp_pass' => '1981wso110381wso',
    'smtp_crypto' => 'security', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'

    'smtp_timeout' => '4', //in seconds

    //'charset' => 'iso-8859-1',

	'charset' => 'UTF-8',

    'wordwrap' => TRUE,

    'newline' => "\r\n" 

);



$config = array( 

	'protocol' => 'mail',

   	'smtp_host' => 'smtp.office365.com',

    'smtp_port' => '465',  

	'smtp_user' =>  'sapimsaperu.soporte@sapimsa.com',

	'smtp_pass' => 'Sopsap2019$',

    'smtp_crypto' => 'security', //can be 'ssl' or 'tls' for example

    'mailtype' => 'html', //plaintext 'text' mails or 'html'

    'smtp_timeout' => '4', //in seconds

	'charset' => 'UTF-8',

    'wordwrap' => TRUE,

    'newline' => "\r\n"          

);

*/



/*   

smtp_host = smtp.office365.com

smtp_user = sapimsaperu.soporte@sapimsa.com

smtp_pass = Sopsap2019$

        

$config['protocol'] = 'mail';       

$config['smtp_host'] = 'gator4131.hostgator.com'; // change this to yours

$config['smtp_port'] = '465';

$config['smtp_user'] = 'ventas@maniobrasarequipa.com'; // change this to yours

$config['smtp_pass'] = 'PERU2015'; // change this to yours

$config['mailtype'] = 'html';

$config['charset'] = 'iso-8859-1';

$config['wordwrap'] = TRUE;

$config['newline'] = "\r\n"; //use double quotes  

*/ 



