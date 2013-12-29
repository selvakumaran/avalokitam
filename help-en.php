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

		<h1>Help</h1>

		<p>Given a Tamil Prosody Text, it analyzes all the Metrical
			information (yāppu)&nbsp;such as acai, cīr,
			vāypāṭu,&nbsp;taḷai, aṭi, toṭai&nbsp;etc and displays them.
			It also attempts to find the metre of the Text. It can recognize all
			the 4 major types (and their subtypes) of Tamil metre namely,
			veṇpā, āciriyappā, kalippā &amp; vañcippā &amp; the
			corresponding pāviṉam-s :&nbsp;veṇpāviṉam,
			āciriyappāviṉam, kalippāviṉam &amp; vañcippāviṉam</p>

		<h2>Guidelines for Text Input</h2>
		<ul>
			<li>The Text entered must have their cīr-s divided properly.</li>
			<li>Sandhi split text is not adviced to be given as Input. The Sandhi
				split version plays havoc with the prosody rules, and the incorrect
				metre is displayed as a result.</li>
			<li>neṭilaṭi &amp; kaḻineṭilaṭi must be entered as a single
				line (In print, it is a customary practice to break it and print it
				as two lines with a tab on the second line)</li>
			<li>The letters that are to omitted in metrical analysis must be
				given within braces ().&nbsp;</li>
			<li>The taṉiccol must be indicated with the symbol - (Hyphen)</li>
			<li>Except for Hyphens, avoid all other unnecessary puncutations</li>
			<li>Avoid unnecessary spaces &amp; tabs.</li>
		</ul>

		<h2>Additional Options</h2>
		<h3>Do not parse short-u before initial vowels</h3>
		In several cases, the short-u occurring just before initial vowels
		must not be parsed. Else, the metrical analysis of the verse would
		fail. To enable this, you may select his option.

		<h3>Compare with Veṇpā rules</h3>
		<p>Performs a comparison with the rules of Veṇpā metre and outputs
			the result.</p>

		<h2>FAQ</h2>
		<ol>
			<li><strong>The Metre of the Text I have entered appears incorrectly.
					I have entered a veṇpā, while the result shows it as a
					veṇṭuṟai. Why ?</strong></li>
			<br />
			<div>Please check if the Text is in concordance with all the rules of
				the veṇpā metre. (The taḷai, vāyppāṭu etc ) Failing that,
				the nearest pāviṉam is Matched. In case of veṇpā, it is
				veṇṭuṟai&nbsp;</div>
			<div>&nbsp;</div>
			<div></div>
			<div>So Whenever, identification with pā fails, the nearest
				pāviṉam is matched and displayed.</div>
			<div>&nbsp;</div>
			<li><strong>How does the parser handle puṟanaṭai ?</strong></li>
			<br />
			<div>puṟanaṭai are specific exceptions to the General prosody
				rules, to deliberately fit a text to a particular metre. As of now,
				puṟanaṭai must be handled manually. For e.g. In cases, where
				Aytam should be considered a short letter, it can be replaced by
				'ku'. For the extra-long vowels (Alabedai), the corresponding
				short-vowel could be removed. For letters that mustn't be included
				in prosody analysis, they can be given within braces.</div>
			<div>&nbsp;</div>
			<li><strong>How do I force the parser to parse a word in a specific
					way ?</strong></li>
			<br />
			<div>There are several cases, where a given word can be parsed in
				several ways. If you want to force the parser to parse in a specific
				way, do indicate the syllable breaks using /. As in
				கலை/யோ/டு</div>
		</ol>
		<div></div>

		<a id="API"><h2>API</h2></a> There is also a REST API that could be
		accessed. A post request to <a href="http://www.avalokitam.com/api">http://www.avalokitam.com/api</a>
		with the following parameters would return an XML, which could be
		parsed as required.

		<p>
			<em>verse</em> : Text in Tamil Unicode <br /> <em>lang</em> : Script
			of the output. Should be either 'en' or 'ta'. Default is 'ta' <br />
			<em>kurilu</em> : To suppress parsing short-u before initial vowels.
			1 or 0. Default is 0
		</p>

		<a id="terminal"><h2>Terminal</h2></a>
		<p>
			You can also invoke this tool from the Terminal. Download the source
			code from <a href="https://github.com/virtualvinodh/avalokitam">Github</a>.
			It has to be then invoked using the PHP CLI.
		</p>
		<p>In OS X Mountain Lion, the in-built PHP doesn't seem to handle
			UTF-8 properly. You can install PHP 5.4 using Homebrew and then use
			it as CLI.</p>

		<image src="css/images/options.png" />
		<image src="css/images/sample-analysis.png" />

	</div>

<?PHP echo $foot ?>

