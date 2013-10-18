<?PHP

/*
 * Copyright (C) 2013 Vinodh Rajan vinodh@virtualvinodh.com This file is a part
 * of Avalokitam. Avalokitam is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version. This program is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General
 * Public License for more details. You should have received a copy of the GNU
 * General Public License along with this program. If not, see
 * <http://www.gnu.org/licenses/>.
 */

require_once "menu.php";

require_once ('recaptchalib.php');
require_once 'google/appengine/api/mail/Message.php';

use google\appengine\api\mail\Message;

$publickey = "6LcvHOgSAAAAANFGki5OXL5NqDIQDa0H7lvDfvkI";
$privatekey = "6LcvHOgSAAAAAMbREQWCrbnvUOO92FiVrvqnd1N8";

$error = null;

if ($_POST ["recaptcha_response_field"]) {
	$resp = recaptcha_check_answer ( $privatekey, $_SERVER ["REMOTE_ADDR"], $_POST ["recaptcha_challenge_field"], $_POST ["recaptcha_response_field"] );
	
	if ($resp->is_valid) {
		$msgSent = "தங்களது கருத்து பெறப்பட்டது. நன்றி";
		
		$message_body = "From:" . $_POST ["nm"] . "\n\n" . "Email:" . $_POST ["em"] . "\n\n" . $_POST ["ftxt"];
                
$mail_options = [
    "sender" => "vinodh.vinodh@gmail.com",
    "to" => "vinodh.vinodh@gmail.com",
    "subject" => "Feedback for Avalokitam",
    "textBody" => $message_body
]
		;
		
		$message = new Message ( $mail_options );
		$message->send ();
	} else {
		$error = $resp->error;
		$msgError = "ரீ-கேப்ட்சா பிழை. மீண்டும் ரீ-கேப்ட்சா உரையினை சரியான முறையில் உள்ளீடு செய்க";
	}
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tamil Prosody Analyzer</title>
<?PHP echo $jscss; ?>
</head>
<body>

<?PHP echo $head?>

<?PHP echo $menu?>

<div class="container-cont">
		<br />

		<div class="uiTran"><?PHP echo lanconTrnL("அவலோகிதம் குறித்து கருத்துக்கள், ஆலோசனைகள் ஏதேனும் இருப்பின் தெரியப்படுத்துக:",$_SESSION['lang']); ?></div>

		<br />

		<form name="vinodh" method="post"
			action="<?PHP echo $_SERVER['PHP_SELF'];?>">
			<div class="uiTran"><?PHP echo lanconTrnL("பெயர்:",$_SESSION['lang']); ?></div>
			<input name="nm"
				value="<?PHP if(isset($msgError)) echo $_POST["nm"] ?>"></input>
			<div class="uiTran"><?PHP echo lanconTrnL("மின்னஞ்சல்:",$_SESSION['lang']); ?></div>
			<input name="em"
				value="<?PHP if(isset($msgError)) echo $_POST["em"] ?>"></input> <br />
			<br />
			<textarea cols="50" rows="12" name="ftxt">
<?PHP if(isset($msgError)) echo $_POST["ftxt"]?>
</textarea>
			<br />

<?PHP echo recaptcha_get_html($publickey, $error);?>

<br /> <input type="submit"
				value="<?PHP echo lanconTrnL("அனுப்புக",$_SESSION['lang']); ?>"
				id="send">
		</form>
		<br />
<?PHP if(isset($msgError)) echo $msgError; ?>
<?PHP if(isset($msgSent)) echo $msgSent; ?>
<br /> <br />
	</div>

<?PHP echo $foot ?>

