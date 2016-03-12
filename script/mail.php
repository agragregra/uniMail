<?php
function adopt ( $text )
{
	return '=?UTF-8?B?' . base64_encode ( $text ) . '?=';
}

function clear ( $str )
{
	return strip_tags ( trim ( $str ) );
}

$c = TRUE;
$mess = '';
$p_name = '';
$a_email = '';
$f_subject = '';
$sk = [ 'admin_email' , 'project_name' , 'form_subject' ];

if ( ( $m = $_SERVER[ 'REQUEST_METHOD' ] )
	&& ( $m == 'POST' || $m == 'GET' )
	&& ( $p_name = clear ( $_POST[ 'project_name' ] ) )
	&& ( $a_email = clear ( $_POST[ 'admin_email' ] ) )
	&& ( $f_subject = clear ( $_POST[ 'form_subject' ] ) )
) {
	foreach ( $_POST as $k => $v )
		if ( $v != '' && ! in_array ( $k , $sk ) )
			$mess .= ( $c = ! $c ? '<tr>' : '<tr style="background-color: #f8f8f8;">' )
				. "<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$k</b></td>"
				. "<td style='padding: 10px; border: #e9e9e9 1px solid;'>$v</td></tr>\r\n";
}
$mess = "<table style='width: 100%;'>$mess</table>";
$headers = "MIME-Version: 1.0" . PHP_EOL .
	"Content-Type: text/html; charset=utf-8" . PHP_EOL .
	'From: ' . adopt ( $p_name ) . ' <' . $a_email . '>' . PHP_EOL .
	'Reply-To: ' . $a_email . '' . PHP_EOL;

mail ( $a_email , adopt ( $f_subject ) , $mess , $headers );
