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

		<td valign="top" colspan="2">
			<h1>
				<strong><strong>வெண்பா</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><span
					style="font-family: Tahoma, Arial, Helvetica, sans-serif; line-height: 19px;">&nbsp;
						&nbsp;</span></strong>
			</h1>
			<h2>
				<strong>நேரிசை வெண்பா</strong><strong>&nbsp;</strong><strong>&nbsp;&nbsp;</strong><span
					style="line-height: 16px;">&nbsp;</span>
			</h2>
			<div class="sampleTxt">
				<h3 class="sample">ஒரு விகறபம்</h3>
				<div class="sampleBtn">
					<button>
						<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
					</button>
				</div>
				<p>கூற்றங் குமைத்த குரைகழற்காற் கும்பிட்டுத்</p>
				<p>தோற்றந் துடைத்தேந் துடைத்தேமாற் - சீற்றஞ்செய்</p>
				<p>யேற்றினான் றில்லை யிடத்தினா னென்னினியாம்</p>
				<p>போற்றினா னல்கும் பொருள்</p>
			</div>
			<p> </p>
			<div class="sampleTxt">
				<h3 class="sample">இரு விகற்பம்</h3>
				<div class="sampleBtn">
					<button>
						<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
					</button>
				</div>
				<p>மாதவா போதி வரதா வருளமலா</p>
				<p>பாதமே யோத சுரரைநீ - தீதகல</p>
				<p>மாயா நெறியளிப்பா யின்றன் பகலாச்சீர்த்</p>
				<p>தாயே யலகில்லா டாம்</p>
			</div>
			<p> </p>

			<h2>
				<strong>இன்னிசை வெண்பா</strong>
			</h2>
			<div class="sampleTxt">
				<h3 class="sample">ஒரு விகற்பம்</h3>
				<div class="sampleBtn">
					<button>
						<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
					</button>
				</div>
				<p>துகடீர் பெருஞ்செல்வம் தோன்றியக்கால் தொட்டுப்</p>
				<p>பகடு நடந்தகூழ் பல்லாரோ டுண்க</p>
				<p>அகடுற யார்மாட்டும் நில்லாது செல்வம்</p>
				<p>சகடக்கால் போல வரும்</p>
			</div>
			<p> </p>
			<div class="sampleTxt">
				<h3 class="sample">பல விகற்பம்</h3>
				<div class="sampleBtn">
					<button>
						<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
					</button>
				</div>
				<p>இன்றுகொல் அன்றுகொல் என்றுகொல் என்னாது</p>
				<p>பின்றையே நின்றது கூற்றமென் றெண்ணி</p>
				<p>ஒருவுமின் தீயவை ஒல்லும் வகையான்</p>
				<p>மருவுமின் மாண்டார் அறம்</p>
			</div>
			<p> </p>
			<div class="sampleTxt">
				<h2>சிந்தியல் வெண்பா</h2>
				<h3 class="sample">நேரிசை சிந்தியல்
					வெண்பா</h3>
				<div class="sampleBtn">
					<button>
						<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
					</button>
				</div>
				<p>அறிந்தானை ஏத்தி அறிவாங் கறிந்து</p>
				<p>செறிந்தார்க்குச் செவ்வன் உரைப்ப - செறிந்தார்</p>
				<p>சிறந்தமை ஆராய்ந்து கொண்டு</p>
			</div>
			<p> </p>
			<div class="sampleTxt">
				<h3 class="sample">இன்னிசை சிந்தியல்
					வெண்பா</h3>
				<div class="sampleBtn">
					<button>
						<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
					</button>
				</div>
				<p>சுரையாழ அம்மி மிதப்ப வரையனைய</p>
				<p>யானைக்கு நீத்து முயற்கு நிலையென்ப</p>
				<p>கானக நாடன் சுனை</p>
			</div>
			<div></div>
			<p> </p>
			<h2>குறள் வெண்பா</h2>
			<div class="sampleTxt">
				<h3 class="sample">ஒரு விகற்பம்</h3>
				<div class="sampleBtn">
					<button>
						<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
					</button>
				</div>
				<p>முற்ற உணர்ந்தானை ஏத்தி மொழிகுவன்</p>
				<p>குற்றமொன்று இல்லா அறம்</p>
			</div>
			<p> </p>
			<div class="sampleTxt">
				<h3 class="sample">இரு விகற்பம்</h3>
				<div class="sampleBtn">
					<button>
						<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
					</button>
				</div>
				<p>நற்காட்சி நன்ஞானம் நல்லொழுக்கம் இம்மூன்றும்</p>
				<p>தொக்க அறச்சொல் பொருள்</p>
			</div>
			<p> </p>
			<div class="sampleTxt">
				<h2 class="sample">பஃறொடை வெண்பா</h2>
				<div class="sampleBtn">
					<button>
						<span class="uiTran"><?PHP echo lanconTrnL("இதை ஆராய்க",$_SESSION['lang']); ?></span>
					</button>
				</div>
				<p>வையக மெல்லாங் கழினியா வையகத்துட்</p>
				<p>செய்யகமே நாற்றிசையின் றேயங்கள் செய்யகத்துள்</p>
				<p>வான்கரும்பே தொண்டை வளநாடு வான்கரும்பின்</p>
				<p>சாறேயந் நாட்டிற் றிலையூர்கள் சாறட்ட</p>
				<p>கட்டியே கச்சிப் புறமெல்லாங்க் கட்டியுட்</p>
				<p>டானேற்ற மான சருக்கரை மாமணியே</p>
				<p>ஆணேற்றான் கச்சி யகம்</p>
			</div>
			<p> </p>
	
	</div>

<?PHP echo $foot ?>

