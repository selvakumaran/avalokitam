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

		<img src="css/images/sitting_avalokitesvara.jpg" width="225px"
			style="float: right; margin: 15px; -webkit-border-radius: 25px; -moz-border-radius: 25px;"
			alt="" />

		<div class="quote">

			<p>
				ஆயும் குணத்து அலோகிதன் பக்கல் அகத்தியன் கேட்டு <br /> ஏயும்
				புவனிக்கு இயம்பிய தண்டமிழ் ஈங்கு உரைக்க [...]
			</p>

			<p>-- வீரசோழியம்</p>

		</div>

		<h1>பற்றி</h1>

		<p>அவலோகிதம் - ஒரு தமிழ் யாப்பு மென்பொருள் ஆகும். உள்ளிடப்பட்ட உரையினை
			தமிழ் யாப்பு விதிகளின் படி ஆராய்ந்து - எழுத்து, அசை, சீர், தளை, அடி,
			தொடை ஆகிய யாப்பு உறுப்புக்களை வெளியிடும். இவற்றைக்கொண்டு உள்ளீட்டின்
			பாவகையினையும் கண்டுகொள்ளும்.</p>

		<p>பண்டைய தமிழ் மஹாயான பௌத்தர்கள் தமிழ் மொழியை அகத்தியருக்கு
			உபதேசித்தவராக கருதிய, சர்வபுத்தர்களின் மஹாகருணையின் உருவகமாக
			விளங்கும் பகவான் போதிசத்துவர் அவலோகிதேஸ்வரரின் பெயர்
			இம்மென்பொருளுக்கு இடப்பட்டது.</p>

		<p>
			இம்மென்பொருள் பெ.ஹெச்.பி'ல் இயற்றப்பட்டு கூகிள் ஆப் இஞ்ஜினில்
			இயங்குகிறது. இதற்கு <a href="help-ta#API">ரெஸ்ட் ஏ.பி.ஐ'யும்</a>
			உள்ளது. கூடவே <a href="help-ta#terminal">டெர்மினலில்</a> இருந்தும்
			இதை செயல்படுத்தலாம்.
		</p>

		<p>
			நீங்கள் இம்மென்பொருளினை விரும்பி, அதற்கு உதவ விரும்பினால் கீழ்க்கண்ட
			பே-பால் இணைப்பை சொடுக்கவும் அல்லது எனது <a
				href="http://www.amazon.co.uk/gp/wishlist/1ELPO31YULX6D/ref=reg_hu-rd_add_wl?ie=UTF8&amp;layout=">அமேசான்
				விருப்ப-பட்டியலில்</a> உள்ளதையும் கொடுக்கலாம் !
		</p>

		<p>
			இம்மென்பொருள் தற்போது <a
				href="https://github.com/virtualvinodh/avalokitam">கிட்ஹப்பில்</a>
			உள்ளது. நீங்கள் இந்த மென்பொருளின் வளர்ச்சியில் பங்களிக்க
			விரும்பினால், நிச்சயம் செய்யலாம்.
		</p>

		<p>
			என்னைப்பற்றி அறிந்து கொள்ள எனது <a
				href="http:/www.virtualvinodh.com/about">தனிப்பட்ட வலைத்தளத்தை</a>
			காணவும். எனது ஆராய்ச்சியினை பற்றி அறிந்து கொள்ள எனது <a
				href="http://sachi.cs.st-andrews.ac.uk/people/phd-students/vinodh-rajan/">பல்கலைக்கழக
				பக்கத்தைக்</a> காணவும்.
		</p>

		<h1>About</h1>

		<p>
			Avalokitam is a Prosody Analyzer for the Tamil Language. It
			constructs a parse tree of the input text based on the prosodic
			syllable patterns. Based on this parse tree, the input verses are
			analyzed for all the six basic elements of Tamil prosody: <em>
				eḻuttu (Phone), acai (Metreme), cīr (Metrical Foot), taḷai
				(Linkage), aṭi (Metrical Line), toṭai (Ornamenation)</em>. The
			meter of the verse is then recognized by matching the elements with
			the elaborate and complex rules of Tamil prosody.
		</p>

		<p>It is named upon Bodhisattva Avalokiteshvara, whom the Tamil
			Mahayana Buddhists of the yore considered as the progenitor of the
			Tamil Language.</p>

		<p>
			The Tool runs on PHP in Google App Engine. It has a <a
				href="help-en#API">REST API</a> and can also be run from the <a
				href="help-en#terminal">terminal</a>.
		</p>

		<p>
			If you liked this software and want to contribute you may click the
			button below or purchase something on my <a
				href="http://www.amazon.co.uk/gp/wishlist/1ELPO31YULX6D/ref=reg_hu-rd_add_wl?ie=UTF8&amp;layout=">wish-list
			</a> !
		</p>

		<p>
			The project is currently being hosted at <a
				href="https://github.com/virtualvinodh/avalokitam">Github</a>. If
			you would like contribute on the development side, you are more than
			welcome!
		</p>

		<p>
			You can read more about me on my <a
				href="http://www.virtualvinodh.com/about">personal website</a> and
			about my research on my <a
				href="http://sachi.cs.st-andrews.ac.uk/people/phd-students/vinodh-rajan/">university
				webpage</a>.
		</p>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post"
			target="_top">
			<input type="hidden" name="cmd" value="_s-xclick"> <input
				type="hidden" name="hosted_button_id" value="28ZHZ2FKTVTKL"> <input
				type="image"
				src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif"
				border="0" name="submit"
				alt="PayPal – The safer, easier way to pay online."> <img alt=""
				border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif"
				width="1" height="1">

		</form>

	</div>

	<?PHP echo $foot?>

</body>
</html>
