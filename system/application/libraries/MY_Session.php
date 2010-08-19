<?php
if (! defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Session extends CI_Session
{

	function sess_update()
	{
	   // skip the session update if this is an AJAX call!
	   if ( !IS_AJAX )
	   {
	       parent::sess_update();
	   }
	} 
    
} 