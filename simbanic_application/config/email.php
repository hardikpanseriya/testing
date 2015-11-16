<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	/*EMAIL CONFIG*/
	$config['protocol'] = 'smtp';
	$config['smtp_host'] = 'ssl://smtp.googlemail.com';
	$config['smtp_user'] = 'test@whitelotuscorporation.com';
	$config['smtp_pass'] = 'Test@123';
	$config['smtp_port'] = '465';
	$config['mailtype'] = 'html';
	$config['charset'] = 'iso-8859-1';
	$config['wordwrap'] = TRUE;
	$config['fromname'] = 'Tag2M';
	$config['emailfrom'] = 'test@whitelotuscorporation.com';
	$config['help_email']      = "help@tag2m.com";
	$config['inquiries_email'] = "inquiries@tag2m.com";
	$config['support_email']   = "support@tag2m.com";

?>