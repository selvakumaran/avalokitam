
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


    //button
    $("input:submit").button();

    $("#talai").buttonset();

    $("#asaiceer").buttonset();

    $("#menu-right").menu();

    $("#menu-left").menu({

    });
    
    $(".sampleBtn").click(function(){
    
	var sampDiv = $(this).parent();
	var pelm = sampDiv.find("p");
	
	var txt = "";
	
	pelm.each(function(index) {
	
	txt += $(this).text()+"\n";
	
	});
	
	$("form").remove();
	
	$form = $('<form method="post" action="http://www.avalokitam.com"></form>');
	$form.append('<textarea name="ttxt">'+txt+'</textarea>');
	$('body').append($form);
	
	$('form').hide();
	
	$("form").submit();
    
    
    });
    
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
					}, function(data,status) { 
					
						$("#submit").val(data);
					
					});     
					
		$.get("/translation", {
					
					txt: $("#send").val(),
					lang: lan
					}, function(data,status) { 
					
						$("#send").val(data);
					
					});   					   
        
		$(".uiTran").each(function(index) {
		
					var elm = $(this);
					
					$.get("/translation", {
					
					txt: $(this).text(),
					lang: lan
					}, function(data,status) { 
					
						elm.text(data);
					
					});
									    
			    });
			    
		$(".uiTrant").each(function(index) {
		
					var elm = $(this);
										
					$.get("/transliteration", {
					
					txt: $(this).text(),
					lang: lan
					}, function(data,status) { 
					
						elm.text(data);
					
					});
									    
			    }); 
			       

    });

});