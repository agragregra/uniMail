<?php

$method = $_SERVER['REQUEST_METHOD'];

//Script Settings
$frm_name  = "Project Name";     //Change
$recepient = "agragregra@ya.ru"; //Change
$subject   = "E-mail Subject";   //Change

//Script Foreach
$c = true;
if ( $method === 'POST' ) {
	foreach ( $_POST as $key => $value ) {
		$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
		";
	};
} else if ( $method === 'GET' ) {
	foreach ( $_GET as $key => $value ) {
		$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
		";
	};
};

$message = "<table style='width: 100%;'>$message</table>";

mail($recepient, $subject, $message, "From: $frm_name <$recepient>" . "\r\n" . "Reply-To: $recepient" . "\r\n" . "X-Mailer: PHP/" . phpversion() . "\r\n" . "Content-type: text/html; charset=\"utf-8\"");
