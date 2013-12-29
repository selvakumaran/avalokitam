<?PHP

/*
 * Copyright (C) 2013 Vinodh Rajan vinodh@virtualvinodh.com
 *
 * This file is a part
 * of Avalokitam. Avalokitam is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version. This program is distributed in the hope that it
 * will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General
 * Public License for more details. You should have received a copy of the GNU
 * Affero General Public License along with this program. If not, see
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
		<h1>மோனை</h1>
		ஒரு சீரின் முதலெழுத்து
		பின்வரும் சீர்களுடைய
		முதலெழுத்துக்களுடன்
		ஒன்றி வருது மோனை ஆகும்.
		<h2>மோனை எழுத்துக்கள்</h2>
		<p>
			நேரடியாகவே ஒன்றி வரும்
			எழுத்துக்களைத்
			தவிர்த்து (<strong>அ</strong>கரம்-<strong>அ</strong>ன்னை,
			<strong>கு</strong>டை-<strong>கு</strong>ழை
			முதலியன
			போல),&nbsp;கீழ்க்கானும்
			எழுத்துக்களும்
			ஒன்றுக்கொன்று மோனை ஆகும்.
		</p>
		<p> </p>
		<p>
			அ - ஆ - ஐ - ஔ</span>
		</p>
		<p>இ - ஈ - எ - ஏ</p>
		<p>உ - ஊ - ஒ -ஓ</p>
		<p>ஞ - ந</p>
		<p>ம - வ</p>
		<p>த - ச</p>
		<p> </p>
		<p>
			வலை - மனை - <em>மோனை</em>
		</p>
		<p>
			ஞாயிறு - நான் - <em>மோனை</em>
		</p>
		<p>
			கலை - காளை - <em>மோனை</em>
		</p>
		<p> </p>
		<div class="sampleTxt">
			<h2 class="sample">பா உதாரணம்</h2>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>அணிமலர் அசோகின் தளிர்நலம் கவற்றி</p>
			<p>அரிக்குரல் கிண்கிணி அரற்றும் சீறடி</p>
			<p>அம்பொன் கொடிஞ்சி நெடுந்தேர் அகற்றி</p>
			<p>அகன்ற அல்குல் அந்நுண் மருங்குல்</p>
			<p>அரும்பிய கொங்கை அவ்வளை அமைத்தோள்</p>
			<p>அவிர்மதி அனைய திருநுதல் அரிவை</p>
			<p>அயில்வேல் அனுக்கி அம்பலைத்து அமர்ந்த</p>
			<p>கருங்கயல் நெடுங்கண் நோக்கம்என்</p>
			<p>திருந்திய சிந்தையைத் திறைகொண் டனவே</p>
		</div>
		<h1>எதுகை</h1>
		<p>ஒரு சீரின்
			இரண்டாமெழுத்து
			பின்வரும் சீர்களுடைய
			இரண்டாமெழுத்துக்களுடன்
			ஒன்றி வருது எதுகை ஆகும்.
			இரண்டாம் எழுத்து
			பொருந்தும் அதே நேரத்தில்,
			இரு சொற்களுடைய
			முதலெழுத்துக்களின்
			மாத்திரை அளவுகளும்
			பொருந்தி வர வேண்டியது
			அவசியம்.</p>
		<p> </p>
		<p>
			படம் குடம் - <em>எதுகை</em>
		</p>
		<p>
			பாடம் கூடம் - <em>எதுகை</em>
		</p>
		<p>
			<em>&nbsp;</em>
		</p>
		<p>
			படம் கூடம் - <em>எதுகை அல்ல</em>
		</p>
		<p>
			பாடம் குடம் - <em>எதுகை அல்ல</em>
		</p>

		</td>

	</div>

<?PHP echo $foot ?>

