<?php
/*
 * $Header: /usr/share/cvs/care2002_tz_mero_vps/modules/nocc/class_send.php,v 1.1 2006/01/13 13:39:03 irroal Exp $
 *
 * Copyright 2001 Nicolas Chalanset <nicocha@free.fr>
 * Copyright 2001 Olivier Cahagne <cahagn_o@epita.fr>
 *
 * See the enclosed file COPYING for license information (GPL).  If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 */

class mime_mail 
{
	var $parts;
	var $to;
	var $cc;
	var $bcc;
	var $from;
	var $headers;
	var $subject;
	var $body;
	var $smtp_server;
	var $smtp_port;
	var $charset;
	var $crlf;

  /*
  *     void mime_mail()
  *     class constructor
  */         
	function mime_mail()
	{
		$this->parts = Array();
		$this->to =  Array();
		$this->cc = Array();
		$this->bcc = Array();
		$this->from =  '';
		$this->subject =  '';
		$this->body =  '';
		$this->headers =  '';
		$this->crlf = '';
	}

  /*
  *     void add_attachment(string message, [string name], [string ctype], [string encoding], [string charset])
  *     Add an attachment to the mail object
  */ 
	function add_attachment($message, $name, $ctype, $encoding, $charset)
	{
	$this->parts[] = array	(
					'ctype' => $ctype,
                    'message' => $message,
                    'encoding' => $encoding,
					'charset' => $charset,
                    'name' => $name
					);
	}

/*
 *      void build_message(array part)
 *      Build message parts of a multipart mail
 */ 
	function build_message($part)
	{
		$message = $part['message'];
		$encoding = $part['encoding'];
		$charset = $part['charset'];
		switch($encoding)
		{
			case 'base64':
				$message = chunk_split(base64_encode($message));
				break;
			case 'quoted-printable':
				$message = imap_8bit($message);
				break;
			default:
				break;
		}
		$val = 'Content-Type: ' . $part['ctype'] . ';';
		$val .= ($part['charset'] ? ' charset=' . $part['charset'] : '');
		$val .= ($part['name'] ? $this->crlf . "\tname=\"" . $part['name'] . '"' : '');
		$val .= $this->crlf . 'Content-Transfer-Encoding: ' . $encoding;
		$val .= ($part['name'] ? $this->crlf . 'Content-Disposition: attachment;' . $this->crlf . "\tfilename=\"" . $part['name'] . "\"" : '');
		$val .= $this->crlf . $this->crlf . $message . $this->crlf;
		return($val);
	}

/*
 *      void build_multipart()
 *      Build a multipart mail
 */ 
	function build_multipart() 
	{
		$boundary = 'NextPart'.md5(uniqid(time()));
		$multipart = 'Content-Type: multipart/mixed;' . $this->crlf . "\tboundary = $boundary" . $this->crlf . $this->crlf . 'This is a MIME encoded message.' . $this->crlf . $this->crlf . '--' . $boundary;
		
		for($i = sizeof($this->parts) - 1; $i >= 0; $i--) 
			$multipart .= $this->crlf . $this->build_message($this->parts[$i]) . '--'.$boundary;
		return ($multipart .= '--' . $this->crlf);
	}

/*
 *		void build_body()
 *		build a non multipart mail
*/

	function build_body()
	{
		if (sizeof($this->parts) == 1)
			$part = $this->build_message($this->parts[0]);
		else
			$part = '';
		return ($part . $this->crlf);
	}

/*
 *      void send()
 *      Send the mail (last class-function to be called)
 */ 
	function send() 
	{
		$mime = '';
		if (!empty($this->from))
			$mime .= 'From: ' . $this->from . $this->crlf;
		if (($this->smtp_server != '' && $this->smtp_port != '') && ($this->to[0] != ''))
			$mime .= 'To: ' . join(', ', $this->to) . $this->crlf;
		if ($this->cc[0] != '')
			$mime .= 'Cc: ' . join(', ', $this->cc) . $this->crlf;
		if ($this->bcc[0] != '')
			$mime .= 'Bcc: ' . join(', ', $this->bcc) . $this->crlf;
		if (!empty($this->from))
			$mime .= 'Reply-To: ' . $this->from . $this->crlf . 'Errors-To: '.$this->from . $this->crlf;
		if (!empty($this->subject))
			$mime .= 'Subject: ' . $this->subject . $this->crlf;
		if (!empty($this->headers))
			$mime .= $this->headers . $this->crlf;
		if (sizeof($this->parts) >= 1)
		{
			$this->add_attachment($this->body,  '',  'text/plain', 'quoted-printable', $this->charset);
			$mime .= 'MIME-Version: 1.0' . $this->crlf . $this->build_multipart();
		}
		else
		{
			$this->add_attachment($this->body,  '',  'text/plain', '8bit', $this->charset);
			$mime .= $this->build_body();
		}
		// Whether or not to use SMTP or sendmail
		// depends on the config file (conf.php)
		if ($this->smtp_server == '' || $this->smtp_port == '')
			return (mail(join(', ', $this->to), $this->subject,  '', $mime));
		else
		{
			if (($smtp = new smtp()) != 0)
			{
				$smtp->smtp_server = $this->smtp_server;
				$smtp->port = $this->smtp_port;
				$smtp->from = $this->from;
				$smtp->to = $this->to;
				$smtp->cc = $this->cc;
				$smtp->bcc = $this->bcc;
				$smtp->subject = $this->subject;
				$smtp->data = $mime;
				return ($smtp->send());
			}
			else
				return (0);
		}
	}
}  // end of class
?>