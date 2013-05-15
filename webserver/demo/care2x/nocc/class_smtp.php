<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/nocc/class_smtp.php,v 1.1 2006/01/13 13:42:51 irroal Exp $
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * Class based on a work from Unk <rgroesb_garbage@triple-it_garbage.nl>  
 */

class smtp
{
	var $smtp_server;
	var $port;
	var $from;
	var $to;
	var $cc;
	var $bcc;
	var $subject;
	var $data;
		
	// This function is the constructor don't forget this one
	function smtp()
	{
		$this->smtp_server = '';
		$this->port = '';
		$this->from = '';
		$this->to = Array();
		$this->cc = Array();
		$this->bcc = Array();
		$this->subject = '';
		$this->data = '';
	}

	function smtp_open() 
	{ 
        global $SMTP_GLOBAL_STATUS; 

        $smtp = fsockopen($this->smtp_server, $this->port); 
        if ($smtp < 0) return 0; 
        $line = fgets($smtp, 1024);
        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] = substr($line, 0, 1); 
        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULTTXT'] = substr($line, 0, 1024); 

        if ($SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] !=  '2') return 0; 
		
        return $smtp; 
	} 
	
	function smtp_helo($smtp) 
	{ 
        global $SMTP_GLOBAL_STATUS; 

         /* 'localhost' always works [Unk] */ 
        fputs($smtp, "helo localhost\r\n"); 
        $line = fgets($smtp, 1024); 

        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] = substr($line, 0, 1); 
        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULTTXT'] = substr($line, 0, 1024); 

        if ($SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] !=  '2') return 0; 
		
        return 1;
	} 
  
	function smtp_ehlo($smtp) 
	{ 
        global $SMTP_GLOBAL_STATUS; 

        /* Well, let's use "helo" for now.. Until we need the 
          extra func's   [Unk] 
        */ 
        fputs($smtp, "ehlo localhost\r\n"); 
        $line = fgets($smtp, 1024);
        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] = substr($line, 0, 1); 
        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULTTXT'] = substr($line, 0, 1024); 

        if ($SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] <>  '2') return 0; 

        return 1; 
	} 


	function smtp_mail_from($smtp) 
	{ 
        global $SMTP_GLOBAL_STATUS; 
        fputs($smtp, "MAIL FROM:$this->from\r\n"); 
        $line = fgets($smtp, 1024);

		$SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] = substr($line, 0, 1); 
        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULTTXT'] = substr($line, 0, 1024); 

        if ($SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] <>  '2') return 0; 
		
        return 1; 
	} 
  
	function smtp_rcpt_to($smtp) 
	{ 
        global $SMTP_GLOBAL_STATUS; 
		// Modified by nicocha to use to, cc and bcc field
		while ($tmp = array_shift($this->to))
		{
			fputs($smtp, "RCPT TO:$tmp\r\n");
			$line = fgets($smtp, 1024);

			$SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] = substr($line, 0, 1); 
			$SMTP_GLOBAL_STATUS[$smtp]['LASTRESULTTXT'] = substr($line, 0, 1024); 
			if ($SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] !=  '2') return 0;
		}
		while ($tmp = array_shift($this->cc))
		{
			fputs($smtp, "RCPT TO:$tmp\r\n");
			$line = fgets($smtp, 1024);
		    $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] = substr($line, 0, 1); 
			$SMTP_GLOBAL_STATUS[$smtp]['LASTRESULTTXT'] = substr($line, 0, 1024); 

			if ($SMTP_GLOBAL_STATUS[$smtp]["LASTRESULT"] !=  "2") return 0;
		}
		while ($tmp = array_shift($this->bcc))
		{
			fputs($smtp, "RCPT TO:$tmp\r\n"); 
			$line = fgets($smtp, 1024);
		    $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] = substr($line, 0, 1); 
			$SMTP_GLOBAL_STATUS[$smtp]['LASTRESULTTXT'] = substr($line, 0, 1024); 

			if ($SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] !=  '2') return 0;
		}
        return 1; 
	} 

	function smtp_data($smtp) 
	{ 
        global $SMTP_GLOBAL_STATUS; 

        fputs($smtp, "DATA\r\n"); 
        $line = fgets($smtp, 1024);

        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] = substr($line, 0, 1); 
        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULTTXT'] = substr($line, 0, 1024); 

        if ($SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] !=  '3') return 0; 
		
		fputs($smtp, "$this->data"); 
        fputs($smtp, "\r\n.\r\n"); 
        $line = fgets($smtp, 1024); 
        if (substr($line, 0, 1) !=  '2')
			return 0;  

        return 1; 
	} 
  
	function smtp_quit($smtp) 
	{ 
        global $SMTP_GLOBAL_STATUS; 

        fputs($smtp,  "QUIT\r\n"); 
        $line = fgets($smtp, 1024);

        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] = substr($line, 0, 1); 
        $SMTP_GLOBAL_STATUS[$smtp]['LASTRESULTTXT'] = substr($line, 0, 1024); 

        if ($SMTP_GLOBAL_STATUS[$smtp]['LASTRESULT'] !=  '2') return 0; 

        return 1; 
	} 

	function send()
	{
		$err = $smtp = $this->smtp_open();
		$err = $this->smtp_helo($smtp);
		$err = $this->smtp_mail_from($smtp);
		$err = $this->smtp_rcpt_to($smtp);
		$err = $this->smtp_data($smtp);
		$err = $this->smtp_quit($smtp);
	}
}
?>