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

<script type="text/javascript" src="js/sample.js"></script>

</head>
<body>

<?PHP echo $head?>

<?PHP echo $menu?>

<div class="container-cont">

		<h1>வெண்பாவினம்</h1>
		<h2>குறள் வெண்பா</h2>
		<div class="sampleTxt">
			<h3 class="sample">குறள்
				வெண்செந்துறை</h3>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>போதிநிழற் புனிதன் பொலங்கழல்</p>
			<p>ஆதி உலகிற் காண்</p>
		</div>
		<p> </p>
		<div class="sampleTxt">
			<h3 class="sample">குறட்டாழிசை</h3>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>நண்ணு வார்வினை நைய நாடொறும் நற்ற வர்க்கர சாய ஞானநல்</p>
			<p>கண்ணி னானடி யேயடை வார்கள் கற்றவரே</p>
		</div>
		<p> </p>
		<div class="sampleTxt">
			<h2 class="sample">வெண்டாழிசை</h2>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>நண்பி தென்று தீய சொல்லார்</p>
			<p>முன்பு நின்று முனிவு செய்யார்</p>
			<p>அன்பு வேண்டு பவர்</p>
		</div>
		<p> </p>
		<div class="sampleTxt">
			<h2 class="sample">வெண்டுறை</h2>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>படர்தருவெவ் வினைத்தொடர்பாற் பவத்தொடர்பப் பவதொடர்பாற் படராநிற்கும்</p>
			<p>விடலரும்வெவ் வினைத்தொடர்பவ் வினைத்தொடர்புக் கொழிபுண்டோ வினையேற்கம்மா</p>
			<p>விடர்பெரிது முடையேன்மற் றென்செய்கே னென்செய்கே</p>
			<p>னடலரவ மரைக்கசைத்த வடிகேளோ வடிகேளோ</p>
		</div>
		<p> </p>
		<div class="sampleTxt">
			<h2 class="sample">வெளிவிருத்தம்</h2>
			<div class="sampleBtn">
				<button>
					<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
				</button>
			</div>
			<p>மருள்அறுத்த பெரும்போதி மாதவரைக் கண்டிலனால்! - என்செய்கோயான்!</p>
			<p>அருள்இருந்த திருமொழியால் அறவழக்கங் கேட்டிலனால்! - என்செய்கோயான்!</p>
			<p>பொருள்அறியும் அருந்தவத்துப் புரவலரைக் கண்டிலனால்! - என்செய்கோயான்!</p>
		</div>

	</div>

<?PHP echo $foot ?>

