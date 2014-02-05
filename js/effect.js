/*

Copyright (C) 2013 Vinodh Rajan vinodh@virtualvinodh.com

This file is a part of Avalokitam.

Avalokitam is free software: you  can redistribute it and/or modify it
under the  terms of the GNU Affero General Public License as  published by the
Free Software Foundation,  either version 3 of the License,  or (at your
option) any later version.

This  program  is distributed  in  the  hope  that  it will  be  useful,
but  WITHOUT  ANY  WARRANTY;  without   even  the  implied  warranty  of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General
Public License for more details.

You should have received a copy  of the GNU Affero General Public License along
with this program. If not, see <http://www.gnu.org/licenses/>.

*/
$(document).ready(function () {

    // Accordion
    $("#accordion").accordion({
        header: "h3",
        autoHeight: true,
        navigation: true,
        collapsible: true
    });

    $("#accord").accordion({
        header: "h3",
        autoHeight: true,
        navigation: true,
        collapsible: true
    });

    // Tabs
    $("#uruppu").tabs({
        collapsible: false,
        active: 1
    });

    $("#uruppu").tabs().css({
        'overflow': 'auto'
    });


    //buttons
    
    $("input:submit").button();

    $("#extendanalysis").button();

    $("#talai").buttonset();

    $("#asaiceer").buttonset();

    $("#menu-right").menu();

    $("#menu-left").menu({

    });
    
    // close site notice

    $(".ui-icon-closethick").click(function () {

        $(this).parent().fadeTo(300, 0, function () {
            $('.notice').remove();
        });

        $.get("/pst", {
            varb: 'notice',
            vale: true
        }, function (data, status) {}

        );

    });

    // Extended Analysis on Editor page
    // Passing the text to the main page
    
    $("#extendanalysis").click(function () {

        $("form").remove();

        $form = $('<form method="post" action="http://www.avalokitam.com"></form>');
        $form.append('<textarea name="ttxt">' + $("#inp").val() + '</textarea>');

        if ($('#kurilCk').prop('checked')) var kC = "checked";

        if ($('#rulesCk').prop('checked')) var rC = "checked";


        $form.append('<input type="checkbox" name="venRules" ' + rC + '>' + '</input>');
        $form.append('<input type="checkbox" name="kurilU" ' + kC + '>' + '</input>');
        $('body').append($form);

        $('form').hide();

        $("form").submit();


    });


    // Function to analyze the sample verses
    
    $(".sampleBtn").click(function () {

        var sampDiv = $(this).parent();
        var pelm = sampDiv.find("p");

        var txt = "";

        pelm.each(function (index) {

            txt += $(this).text() + "\n";

        });

        $("form").remove();

        $form = $('<form method="post" action="http://www.avalokitam.com"></form>');
        $form.append('<textarea name="ttxt">' + txt + '</textarea>');
        $('body').append($form);

        $('form').hide();

        $("form").submit();


    });

    // For Verse Creator - AJAX simplified analysis
    
    $('#rulesCk,#kurilCk').change(function () {

        $("#inp").trigger("keyup");

    });

    var timer;

    $("#inp").keyup(function () {

        clearTimeout(timer);

        rulesCheck = $('#rulesCk').prop('checked');

        var venpa = true;

        var wordClassCk = ['தேமா', 'புளிமா', 'கூவிளம்', 'கருவிளம்', 'தேமாங்காய்', 'புளிமாங்காய்', 'கூவிளங்காய்', 'கருவிளங்காய்', 'நாள்', 'மலர்', 'காசு', 'பிறப்பு'];
        var wordFinalCk = ['நாள்', 'மலர்', 'காசு', 'பிறப்பு'];
        var linkClassCk = 'வெண்டளை';

        timer = setTimeout(function () {

            $.post("/api", {
                verse: $("#inp").val(),
                kurilu: +$('#kurilCk').prop('checked'),
                vencheck: +rulesCheck,
            },

            function (data, status) {

                $("#parseedit").empty();

                $(data).find('verse').each(function () {

                    var n = 1; 
                    var ln = 0; //Line Number

                    $(this).find('MetricalLine').each(function () {

                        var linkAna = "";
                        var newLine = true;
                        var nk = 0; //Metrical foot number

                        ln = ln + 1; 

                        // 			   		if(ln !=1 && ln == $(data).find('MetricalLine').length)
                        // 			   		{
                        // 			   			if(rulesCheck && $(this).find('MetricalFoot').length != 3)
                        // 			   				$( "#parseedit" ).append("<span class=\"error\"><small>இது ஈற்று அடி எனில் 3 சீர்கள் கொண்டிருத்தல் வேண்டும், இல்லையெனில் 4 சீர்கள்</small></span>"+"<br/><br/>");
                        // 			   	    }
                        // 			   		else
                        // 			   		{
                        // 			   			if(rulesCheck && $(this).find('MetricalFoot').length != 4)
                        // 			   				$( "#parseedit" ).append("<span class=\"error\"><small>கீழ்க்கண்ட அடி 4 சீர்கள் கொண்டிருத்தல் வேண்டும்</small></span>"+"<br/><br/>");
                        // 			   		}
                        $(this).find('MetricalFoot').each(function () {

                            var footAna = "";

                            nk = nk + 1;

                            if (n > 1) {
                                if (newLine) var arrw = "↪";
                                else var arrw = "→";

                                linkAna = $(this).attr('linkage').split(' ');

                                var linkClass = (linkAna.length > 1) ? linkAna[1] : linkAna[0];

                                if (rulesCheck && linkClass != linkClassCk) {
                                    footAna = footAna + " <span class=\"error\"><ruby><rb> " + arrw + " </rb><rt>" + linkClass + " </rt></ruby></span>";
                                    venpa = false;
                                } else footAna = footAna + " <ruby><rb> " + arrw + " </rb><rt>" + linkClass + " </rt></ruby>";

                            }

                            newLine = false;

                            var wordClass = $(this).attr('class');

                            if ((rulesCheck && $.inArray(wordClass, wordClassCk) == -1) || (rulesCheck && $(data).find('MetricalFoot').length == n && $.inArray(wordClass, wordFinalCk) == -1 && nk == 3)) {
                                footAna = footAna + "<span class=\"error\"><ruby><rb>";
                                venpa = false;
                            } else footAna = footAna + "<ruby><rb>";

                            $(this).find('Metreme').each(function () {


                                footAna = footAna + "<ruby><rb>" + $(this).text() + "</rb><rt>" + $(this).attr('type') + "</rt> </ruby> ";

                            });

                            var wordClass = $(this).attr('class');

                            if ((rulesCheck && $.inArray(wordClass, wordClassCk) == -1) || (rulesCheck && $(data).find('MetricalFoot').length == n && $.inArray(wordClass, wordFinalCk) == -1 && nk == 3)) {
                                footAna = footAna + "</rb><rt>" + wordClass + "</rt></ruby></span>";
                                venpa = false;
                            } else footAna = footAna + "</rb><rt>" + wordClass + "</rt></ruby>";

                            n = n + 1;

                            $("#parseedit").append(footAna);
                        });

                        $("#parseedit").append("<br/><br/>");

                    });

                    if ($(this).attr('metre') != "") if (rulesCheck && venpa == false) $("#parseedit").append("வெண்பா விதிகள் பொருந்தவில்லை. பிழைகள் சிகப்பு நிறத்தில் சுட்டிக்காட்டப்பட்டுள்ளன. அவற்றை சரி செய்யவும். ");
                    else $("#parseedit").append("இது " + $(this).attr('metre'));

                });

            });

        }, 250);

    });


    // Language switch
    $("#english,#tamil").change(function () {

        lan = $(this).val();

        $.get("/pst", {
            varb: 'lang',
            vale: lan
        }, function (data, status) {}

        );

        $.get("/translation", {

            txt: $("#submit").val(),
            lang: lan
        }, function (data, status) {

            $("#submit").val(data);

        });

        $.get("/translation", {

            txt: $("#send").val(),
            lang: lan
        }, function (data, status) {

            $("#send").val(data);

        });

        $(".uiTran").each(function (index) {

            var elm = $(this);

            $.get("/translation", {

                txt: $(this).text(),
                lang: lan
            }, function (data, status) {

                elm.text(data);

            });

        });

        $(".uiTrant").each(function (index) {

            var elm = $(this);

            $.get("/transliteration", {

                txt: $(this).text(),
                lang: lan
            }, function (data, status) {

                elm.text(data);

            });

        });


    });

});