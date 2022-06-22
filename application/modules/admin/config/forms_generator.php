<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Every form has own config file


//------
//First need to create a table 
    /*
    CREATE TABLE `forms` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `product_id` int(11) NOT NULL,
      `code` varchar(50) COLLATE utf8_bin NOT NULL,
      `lang` text COLLATE utf8_bin NOT NULL,
      `title` text COLLATE utf8_bin NOT NULL,
      `fields` text COLLATE utf8_bin NOT NULL,
      `uploads` text COLLATE utf8_bin NOT NULL,
      `welcome` text COLLATE utf8_bin NOT NULL,
      `success` text COLLATE utf8_bin NOT NULL,
      `success_title` text COLLATE utf8_bin NOT NULL,
      PRIMARY KEY (`id`)
    )
    */
//------


	// Setup the default config 

    //table is which the form storage in 
    $config['table'] = 'forms';
    //foreign key is the key related to which table
    $config['foreign_key'] = 'event_id';

    //Eg. 
    /*
        if you have a events table, create an event_forms table and use a foreign key event_id related to events
    */

//--- Default Value
    //Default Form Language
    $config['lang'] = array("zh","en");

    // key must be the language value defined by lang
    //Default Form Title
    $config['title'] = array("zh"=>"標題","en"=>"Title");

    // Default Welcome Message
    $config['welcome'] = array();

    $config['success'] = array("zh"=>"完成","en"=>"Success");

    $config['success_title'] = array();

//---