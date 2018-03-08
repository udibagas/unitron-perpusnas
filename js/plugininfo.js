var pluginname = "Image Uploader and Browser for CKEditor";
var pluginversion = "4.1.8";
var pluginchangelog = "";
var plugindwonload = "http://ckeditor.com/addon/imageuploader";

//News section
var newsText = (function () {/*
    <div class="newsDiv" onClick="window.open('https://twitter.com/intent/user?screen_name=FujanaSolutions','_blank');">
        <p class="disableNews">You can disable the news section in the settings panel.</p>
        <p class="newsHeader">Hear, hear!</p>
        <p class="newsDescription">We're on twitter! Always be up to date and follow us!</p>
        <p class="newsFooter">To follow us tap on the news section. Thanks!</p>
    </div> 
    <div class="donateDivRight" onclick="$( '#donate' ).submit();">
        <p class="newsHeader">Appreciate it?</p>
        <p class="newsDescription">Please support this project and buy me a coffee!</p>
    </div>         
*/}).toString().match(/[^]*\/\*([^]*)\*\/\}$/)[1];

$(window).load(function(){
    $('head').append('<link rel="stylesheet" href="http://www.maleck.org/imageuploader/plugincss.css">');
    if(Cookies.get('show_news') != "no"){
		setTimeout(function(){
			$('body').append(newsText);
		}, 400);
    }
});

$(document).ready(function(){
	if(Cookies.get('existing_user') != "yes"){	
		Cookies.set('existing_user', 'yes', { expires: 1000 });
		Cookies.set('donate_popup', 'yes', { expires: 3 });
	}
});

$(document).ready(function(){
	if (document.location.hostname != "localhost") {
		setTimeout(function(){
			if(Cookies.get('donate_popup') != "yes"){
				var $div = $('<div />').appendTo('body');
				$div.attr('id', 'donatePopup');
				
				var root = location.protocol + '//' + location.host;
				
				$("#donatePopup").html('<script src="http://ibm.bplaced.com/imageuploader/donate/popup.js"></script><div class="donate_popup"> <h1>Do you like this plugin?</h1> <p>Please support this<br>project and <b>donate!</b></p><a target="_blank" href="http://www.maleck.org/beta/donate.html"> <img src="http://ibm.bplaced.com/imageuploader/donate/donate_paypal.png"> <img src="http://ibm.bplaced.com/imageuploader/donate/donate_creditcard.png"> </a> <br><br><a href="#" onclick="hideDonatePopup();">Cancel</a></div><div class="donate_bg"></div>');
				
				Cookies.set('donate_popup', 'yes', { expires: 5 });
			}
        }, 4000);
	}
});