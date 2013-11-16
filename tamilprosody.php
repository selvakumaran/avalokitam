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

		<h1>Tamil Prosody</h1>
		<p>This section attempts to provide a very brief introduction to Tamil
			Prosody. For a detailed account, refer to Ulrike Niklas's book in the
			reference section.</p>

		Tamil Prosody system defines the following six basic components:
		<ol>
			<li />
			<em>eḻuttu</em> - Letter
			<li />
			<em>acai</em> - Metreme
			<li />
			<em>cīr</em> - Metrical Foot
			<li />
			<em>taḷai</em> - Linkage
			<li />
			<em>aṭi</em> - Metrical Line
			<li />
			<em>toṭai</em> - Ornamentation
		</ol>

		The system of Tamil Prosody is completely dependant on syllable
		patterns rather than being based on stress.

		<h2>Letter</h2>
		<p>
			Tamil Script is an alpha-syllabary. A <em>letter</em> in Tamil
			Prosody corresponds to an <em>orthographic grapheme</em>.
		</p>
		<p>Tamil differentiates three types of Letters (due to its
			orthography)</p>
		<ol>
			<li><em>uyireḻuttu</em> - Initial Vowels (<sup>i</sup>V)
			
			<li><em>meyyeḻuttu</em> - Pure Consonants (C)
			
			<li><em>uyirmeyyeḻuttu</em> - Consonant-Vowels (<u>CV</u>)
		
		</ol>

		<p>Each of the above, is considered as a "letter" in Tamil. Tamil
			being a phonemic script, it can also be used to denote a phoneme.</p>

		For instance, the word <em>அவலோகிதம் : avalōkitam </em>
		would be analyzed as having <em> 6 letters </em> - <sup>i</sup>V <u>CV</u>
		<u>CV</u> <u>CV</u> <u>CV</u> C

		<h2>Metreme</h2>
		<p>Metreme is the basic unit of Tamil Prosody, which in turn makes up
			the metrical foot. A Metreme can (roughly) be either mono-syllabic or
			bi-syllabic.</p>

		<p>
			A mono-syllabic metreme is called "<em>nēr</em>" and the bi-syllabic
			metreme is "<em>nirai</em>".
		</p>

		<p>They may be conveniently expressed as a Regular Expression:</p>

		<table cellspacing="10">
			<tr>
				<td><strong>Metreme</strong></td>
				<td><strong>Phonetic</strong></td>
				<td><strong>Orthographic</strong></td>
			</tr>
			<tr>
				<td><em>nēr</em></td>
				<td>C?(V̆|V̄)C*</td>
				<td>(<sup>i</sup>V̆|<sup>i</sup>V̄|<u>CV̆</u>|<u>CV̄</u>)C*
				</td>
			</tr>
			<tr>
				<td><em>nirai</em></td>
				<td>C?V̆C(V̆|V̄)C*</td>
				<td>(<sup>i</sup>V̆|<u>CV̆</u>)(<u>CV̆</u>|<u>CV̄</u>)C*
				</td>
			</tr>
		</table>
		<p>
			<em>V̆ - Short Vowel ; V̄ - Long Vowel</em>
		</p>

		<p>
			For example, <em>kal, kāl, uṉ</em> are all <em>nēr</em> metremes,
			where as <em>viḻā, pakal, akār, </em> are <em>nirai</em>
			metremes.
		</p>

		<h2>Metrical Foot</h2>

		<p>
			A metrical foot can be composed of at most 4 metremes. Therefore, the
			number of possible metrical feet are 2<sup>1</sup> + 2<sup>2</sup> +
			2<sup>3</sup> + 2<sup>4</sup> combinations of <em>nēr</em> & <em>nirai</em>
			metremes.
		</p>

		<p>Different classes of metrical feet for double metremes and triple
			metremes are shown below:</p>

		<p>Denoting - as ner and = as nirai :</p>

		<table cellspacing="5" style="float: left;">
			<tr>
				<td>- -</td>
				<td>tēmā</td>
			</tr>
			<tr>
				<td>= -</td>
				<td>puḷimā</td>
			</tr>
			<table cellspacing="5"">
				<td>- =</td>
				<td>kūviḷam</td>
				</tr>
				<tr>
					<td>= =</td>
					<td>karuviḷam</td>
				</tr>
			</table>
			<p></p>
			<table cellspacing="5" style="float: left;">
				<tr>
					<td>- - -</td>
					<td>tēmāṅkāy</td>
				</tr>
				<tr>
					<td>= - -</td>
					<td>puḷimāṅkāy</td>
				</tr>
					<td>- = -</td>
					<td>kūviḷaṅkāy</td>
				</tr>
				<tr>
					<td>= = -</td>
					<td>karuviḷaṅkāy</td>
				</tr>
				<table cellspacing="5"">
					<tr>
						<td>- - =</td>
						<td>tēmāṅkaṉi</td>
					</tr>
					<tr>
						<td>= - =</td>
						<td>puḷimāṅkaṉi</td>
					</tr>
						<td>- = =</td>
						<td>kūviḷaṅkaṉi</td>
					</tr>
					<tr>
						<td>= = =</td>
						<td>karuviḷaṅkaṉi</td>
					</tr>
				</table>
				<p>Note that the names of the classes themselves parse into the feet
					pattern they represent.</p>

				<h2>Linkage</h2>
				<p>The relation between preceding feet and the succeeding feet is
					termed as "Linkage". The type of linkage is dependant on the class
					of preceding feet and the first metreme of the succeeding feet.
				
				
				<p>
					For instance, <em>iyaṟcīr veṇṭaḷai</em> type of linkage is
					considered as occuring in the following cases :
				</p>

				- - → =
				<br /> = - → =
				<br /> - = → -
				<br /> = = → -
				<br />

				<p>Tamil Prosody defines 6 specific types of linkages that may occur
					between metrical feet.</p>

				<h2>Metrical Line</h2>

				<p>A Metrical line can be composed of several metrical feet. There
					are no specific upper limit for number of feet that may appear
					in a line, though it rarely exceeds beyond 8. In most cases it is
					around 3 - 6 feet per line.</p>

				<h2>Ornamentation</h2>
				<p> In Tamil, <em>Toṭai</em> refers to a collection of several forms of poetic devices - both phonetic ( e.g. <em>etuaki,mōṉai</em>) and lexical ( e.g. <em>muraṇ</em> - Usage of lexically
				opposite pairs such as light & dark). Etymologically, it is derived from <em>toṭu</em>, meaning 'making a flower garland'. Similar to that of linking
				different flowers (and forming patterns), patterns can be formed in a verse composition, by means of words and syllables. </p>
				<p>Ornamentation in Tamil Prosody mainly occurs as :</p>

				<ol>
					<li><em>mōṉai</em> - Alliteration of the first Letter
					
					<li><em>etukai</em> - Rhyme on the second Letter
				
				</ol>
				
				<p>These can occur between feet in the same line and also
					between first foot of the lines in a verse.</p>

				<h3>Alliteration</h3>
				Alliteration in Tamil prosody occurs in the first letter. Apart from
				homophones, few other pairs of phones such as
				<em>m-v</em>,
				<em>ñ-n</em>,
				<em>u-o</em> etc. are considered equivalent for purposes of
				alliteration.
				<h3>Rhyme</h3>
				<p>Rhyme on second Letter is the another type of Ornamentation
					found in Tamil Prosody. For a feet to be considered as rhyming with
					another feet, the second Letter must belong to the same consonant
					class while the first Letter must agree in vowel length.</p>

				<p>
					<em>pāṭam - kūṭam </em> is considered to rhyme, while <em>kal
						- kāl</em> is not.
				</p>

				<h1>Metre</h1>
				<p>Classical Tamil Prosody has 4 types of "major" metres (along with
					their subtypes). They are:</p>
				<ol>
					<li>veṇpā
					
					<li>āciriyappā
					
					<li>kalippā
					
					<li>vañcippā
				
				</ol>
				<p>The rules governing these metres are mostly concerned with
					classes of metrical feet allowed, number of feet per line and
					type of linkage occurring.</p>
				<p>Apart from these main metres, there are four more "minor" metres
					which are considered belonging to the family (iṉam) of the above
					metres. These are
				
				
				<p>
				
				
				<ol>
					<li>veṇpāviṉam
					
					<li>āciriyappāviṉam
					
					<li>kalippāviṉam
					
					<li>vañcippāviṉam
				
				</ol>
				<p>
					These don't have very strict rules as compared to major metres.
					They may superficially resemble the major metres, for instance by
					the number of the feet per line. In fact in most cases, the only
					rules governing these "family" metres are number of metrical feet
					in each line of the verse. Though some metres like <em>Kalitturai</em>
					also impose additional rules, like the necessity of all lines
					rhyming in the second letter.
				</p>

				<p>
					These are also several sub-types of the major and minor metres. <em>Veṇpā</em>,
					for example has 5 subtypes.
				
				
				<p>
				
				
				<h1>
					Sample Analysis
					</h2>
					For illustration purposes, let's consider a verse composed in <em>Veṇpā</em>
					metre:

					<p>
						Of all Tamil metres, <em>Veṇpā</em> is usually considered the
						strictest with very rigid rules of composition.
					</p>
					<ul>
						<li>A metrical feet may contain only two or three metremes. If
							three metremes, only <em>-kāy</em> class of metrical feet are
							allowed
						
						<li>The verse may contain only <em>veṇṭaḷai</em> type of
							linkages
						
						<li>All lines except the last should be composed of four feet, the
							last line being three feet.
						
						<li>The last foot of the last line should fall under a special
							class (specific to this metre)
					
					</ul>
					<hr />
					<p>
						அகர முதல எழுத்தெல்லாம்
						ஆதி<br /> பகவன் முதற்றே உலகு
					</p>
					<p>
						akara mutala eḻuttellām āti <br /> pakavaṉ mutaṟṟē
						ulaku
					</p>

					<h2>Scansion</h2>

					<p>The above verse is scanned as follows:</p>

					<p>
						அக/ர முத/ல எழுத்/தெல்/லாம்
						ஆ/தி<br /> பக/வன் முதற்/றே
						உல/கு
					</p>

					<p>
						aka/ra muta/la eḻut/tel/lām ā/ti <br /> paka/vaṉ
						mutaṟ/ṟē ula/ku
					</p>

					<h3>Letters</h3>

					<p>
						<sup>i</sup>V<u>CV</u>/<u>CV</u> <u>CV</u><u>CV</u>/<u>CV</u> <sup>i</sup>V<u>CV</u>C/<u>CV</u>C/<u>CV</u>C
						<sup>i</sup>V/<u>CV</u><br /> <u>CV</u><u>CV</u>/<u>CV</u>C <u>CV</u><u>CV</u>C/<u>CV</u>
						<sup>i</sup>V<u>CV</u>/<u>CV</u>
					</p>

					<h3>Metreme types</h3>

					<p>
						nirai/nēr nirai/nēr nirai/nēr/nēr nēr/nēr<br /> nirai/nēr
						nirai/nēr nirai/pu
					</p>

					<h3>Metrical feet class</h3>

					<p>
						puḷimā puḷimā puḷimāṅkāy tēmā<br /> puḷimā
						puḷimā piṟappu
					</p>

					<p>
						(The last feet of the <em>Veṇpā</em> verse needs a slightly
						different scan and classification)
					</p>

					<h3>Linkage</h3>
					<p>
						akara → mutala : <em>iyaṟcīr veṇṭaḷai </em>(puḷimā
						→ nirai)<br /> mutala → eḻuttellām : <em>iyaṟcīr
							veṇṭaḷai</em> (puḷimā → nirai)<br /> eḻuttellām →
						āti : <em>veṇcīr veṇṭaḷai</em> (puḷimāṅkāy →
						nēr)<br /> āti → pakavaṉ : <em>iyaṟcīr veṇṭaḷai </em>(tēmā
						→ nirai)<br /> pakavaṉ → mutaṟṟē : <em>iyaṟcīr
							veṇṭaḷai </em>(puḷimā → nirai)<br /> mutaṟṟē →
						ulaku :<em> iyaṟcīr veṇṭaḷai</em> (puḷimā → nirai)<br />
					</p>

					<h3>Ornamentation</h3>
					<p>
						Alliteration at feet level: <strong>a</strong>kara - <strong>ā</strong>ti
					</p>
					<p>
						Rhyme at line level : a<strong>ka</strong>ra - pa<strong>ka</strong>vaṉ
					</p>

					<p>
						This verse satisfies all rules of the <em>Veṇpā</em> metre.
						Being of two Metrical Lines, it falls under the sub-type of <em>Kuṟaḷ
							Veṇpā</em>.
					</p>

					<h1>Reference</h1>
					<ol>
						<li>Niklas, U. (1988). Introduction to Tamil prosody. <em>Bulletin
								de l'Ecole française d'Extrême-Orient</em>, 77(1), 165-227.
						
						<li>tiruttaṇikai vicākap perumāḷaiyar (1939).
							Yāppilakkaṇam (Tamil Prosody Grammar)
						
						<li>Tamil Virtual Academy - <a
							href="http://www.tamilvu.org/courses/degree/d031/d0312/html/d0312ind.htm">Online
								Course on Tamil Prosody</a>
						
						<li>Pasupathy, <a
							href="https://groups.google.com/forum/#!msg/yappulagam/Umr4M2rOzQs/xaSw4OecQbIJ">kavitai
								iyaṟṟik kalakku</a>
					
					</ol>

					<br />

					</div>

<?PHP echo $foot ?>

