<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Email Settings
| -------------------------------------------------------------------
| Configuration of outgoing mail server.
| */

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'mail.ipm.edu.mo';
$config['smtp_port'] = '25';
$config['smtp_timeout'] = '30';
$config['smtp_user'] = 'josechan@ipm.edu.mo';
$config['smtp_pass'] = '';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'text';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";

// Email Content
$config['sender'] = 'sender';
$config['from'] = 'josechan@ipm.edu.mo';
$config['subject'] = '<No Subject>';

$config['content'] = 
['MANAGER' => 
'Dear Sir
Hello World! {content}
{sender}'];

