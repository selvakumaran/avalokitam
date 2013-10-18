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


		<h1>கலிப்பா</h1>
		<div class="sampleTxt">
			<h2 class="sample">தரவு கொச்சகக்
				கலிப்பா</h2>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>செல்வப்போர்க் கதக்கண்ணன் செயிர்த்தெறிந்த சினவாழி</p>
			<p>முல்லைத்தார் மறமன்னர் முடித்தலையை முருக்கிப்போய்</p>
			<p>எல்லைநீர் வியன்கொண்மூ இடைநுழையும் மதியம்போல்</p>
			<p>மல்லல்ஒங் கெழில்யானை மருமம்பாய்ந் தொளித்ததே</p>
		</div>
		<p> </p>
		<div class="sampleTxt">
			<h2 class="sample">வெண்கலிப்பா</h2>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>ஏர்மலர் நறுங்கோதை எருத்தலைப்ப இறைஞ்சித்தன்</p>
			<p>வார்மலர்த் தடங்கண்ணார் வலைப்பட்டு வருந்தியவென்</p>
			<p>தார்வரை அகன்மார்பன் தனிமையை அறியுங்கொல்</p>
			<p>சீர்மலி கொடியிடை சிறந்து</p>
		</div>

	</div>

<?PHP echo $foot ?>

