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

		<h1>வஞ்சிப்பாவினம்</h1>
		<div class="sampleTxt">
			<h2 class="sample">வஞ்சித்தாழிசை</h2>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>மடப்பிடியை மதவேழம்</p>
			<p>தடக்கையான் வெயில்மறைக்கும்</p>
			<p>இடைச்சுரம் இறந்தார்க்கே</p>
			<p>நடக்குமென் மனனேகாண்</p>
			<p>பேடையை இரும்போத்துத்</p>
			<p>தோகையான் வெயில்மறைக்கும்</p>
			<p>காடகம் இறந்தார்க்கே</p>
			<p>ஓடுமென் மனனேகாண்</p>
			<p>இரும்பிடியை இகல்வேழம்</p>
			<p>பெருங்கையான் வெயில்மறைக்கும்</p>
			<p>அருஞ்சுரம் இறந்தார்க்கே</p>
			<p>விரும்புமென் மனனேகாண்</p>
		</div>
		<p> </p>
		<div class="sampleTxt">
			<h2 class="sample">வஞ்சித்துறை</h2>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>பொருந்து போதியில்</p>
			<p>இருந்த மாதவர்</p>
			<p>திருந்து சேவடி</p>
			<p>மருந்து ஆகுமே!</p>
		</div>
		<p> </p>
		<div class="sampleTxt">
			<h2 class="sample">வஞ்சி விருத்தம்</h2>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>அணிதங்கு போதி வாமன்</p>
			<p>பணிதங்கு பாதம் அல்லால்</p>
			<p>துணிபொன் றிலாத தேவர்</p>
			<p>மணிதங்கு பாதம் மேவார்</p>
		</div>



	</div>

<?PHP echo $foot ?>

