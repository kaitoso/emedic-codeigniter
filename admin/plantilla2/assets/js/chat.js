/*

Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)

This script may be used for non-commercial purposes only. For any
commercial purposes, please contact the author at 
anant.garg@inscripts.com

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

*/

var windowFocus = true;
var username;
var from_username;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 2000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;

var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();
var chat_with = false;
jQuery(document).ready(function(){
	originalTitle = document.title;
	startChatSession();

	jQuery([window, document]).blur(function(){
		windowFocus = false;
	}).focus(function(){
		windowFocus = true;
		document.title = originalTitle;
	});
});

function restructureChatBoxes() {
	align = 0;
	for (x in chatBoxes) {
		chatboxtitle = chatBoxes[x];
		
		if (jQuery("#chatbox_"+chatboxtitle).css('display') != 'none') {
			if (align == 0) {
				jQuery("#chatbox_"+chatboxtitle).css('right', '262px');
			} else {
				width = (align)*(262+7)+262;
				jQuery("#chatbox_"+chatboxtitle).css('right', width+'px');
			}
			align++;
		}
	}
}

function getTitle( title ){
	try{
		return title.replace('-', ' ');
	} catch(ex) {
		return title;		
	}
}

function chatWith(chatuser, chatuserName, chatToFoto, chatUser2, chatUserName2, chatFromFoto) {
	chat_with = true;
	createChatBox(chatuser, chatuserName, chatToFoto, chatFromFoto, 1);
	jQuery("#chatbox_"+chatuser+" .chatboxtextarea").focus();

}

function createChatBox(chatboxtitle,chatuserName, chatToFoto, chatFromFoto, minimizeChatBox) {
	if (jQuery("#chatbox_"+chatboxtitle).length > 0) {
		if (jQuery("#chatbox_"+chatboxtitle).css('display') == 'none') {
			jQuery("#chatbox_"+chatboxtitle).css('display','block');
			restructureChatBoxes();
		}
		jQuery("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		return;
	}

	jQuery(" <div />" ).attr("id","chatbox_"+chatboxtitle)
	.addClass("chatbox slimScrollDiv")
	.html('<div class="chatboxhead"><div class="chatboxtitle">'+getTitle( chatuserName )+'</div><div class="chatboxoptions"><a href="javascript:void(0)" onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle+'\')"><i class="fa fa-window-minimize" aria-hidden="true"></i></a> <a href="javascript:void(0)" onclick="javascript:closeChatBox(\''+chatboxtitle+'\')"><i class="fa fa-times" aria-hidden="true"></i></a></div><br clear="all"/></div><ul class="chatboxcontent chats"></ul><div class="chatboxinput"><input type="text" class="form-control input-sm chatboxtextarea" name="message" placeholder="Envía un mensaje" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\',\''+chatuserName+'\',\''+chatToFoto+'\',\''+chatFromFoto+'\');"></div>')
	.appendTo(jQuery( "body" ));
			   
	jQuery("#chatbox_"+chatboxtitle).css('bottom', '0px');
	
	chatBoxeslength = 0;

	for (x in chatBoxes) {
		if (jQuery("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
			chatBoxeslength++;
		}
	}

	if (chatBoxeslength == 0) {
		jQuery("#chatbox_"+chatboxtitle).css('right', '262px');
	} else {
		width = (chatBoxeslength)*(262+7)+262;
		jQuery("#chatbox_"+chatboxtitle).css('right', width+'px');
	}
	
	chatBoxes.push(chatboxtitle);

	if (minimizeChatBox == 1) {
		minimizedChatBoxes = new Array();

		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}
		minimize = 0;
		for (j=0;j<minimizedChatBoxes.length;j++) {
			if (minimizedChatBoxes[j] == chatboxtitle) {
				minimize = 1;
			}
		}

		if (minimize == 1) {
			jQuery('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
			jQuery('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
		}
	}

	chatboxFocus[chatboxtitle] = false;

	jQuery("#chatbox_"+chatboxtitle+" .chatboxtextarea").blur(function(){
		chatboxFocus[chatboxtitle] = false;
		jQuery("#chatbox_"+chatboxtitle+" .chatboxtextarea").removeClass('chatboxtextareaselected');
	}).focus(function(){
		chatboxFocus[chatboxtitle] = true;
		newMessages[chatboxtitle] = false;
		jQuery('#chatbox_'+chatboxtitle+' .chatboxhead').removeClass('chatboxblink');
		jQuery("#chatbox_"+chatboxtitle+" .chatboxtextarea").addClass('chatboxtextareaselected');
	});

	jQuery("#chatbox_"+chatboxtitle).click(function() {
		if (jQuery('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') != 'none') {
			jQuery("#chatbox_"+chatboxtitle+" .chatboxtextarea").focus();
		}
	});

	jQuery("#chatbox_"+chatboxtitle).show();
	itemsfound = 0;
	//call
	$.ajax({
	  url: "?action=chathistory",
	  cache: false,
	  data: 'to='+chatboxtitle,
	  dataType: "json",
	  success: function(data) {

		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug
				if (item.s == 1) {
					item.f = from_username;
				}
				if (item.s == 2) {
					//jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<li class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></li>');
					//jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div hidden="hidden"><audio controls="" autoplay=""><source src="../plantilla2/assets/notifications/hangouts_message.ogg" type="audio/ogg"><source src="../plantilla2/assets/notifications/hangouts_message.mp3" type="audio/mp3"></audio></div>');
					//jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<li class="chatboxmessage left"><span class="date-time">'+ getTitle( item.fh ) +'</span><a href="javascript:;" class="name chatboxmessagefrom">'+ getTitle( item.fname ) +'</a><a href="javascript:;" class="image"><img alt="" src="../'+ getTitle(item.ff) +'"></a><div class="chatboxmessagecontent message">'+item.m+'</div></li>');
				} else {
					var position_message = '', foto_user = '';
					if (from_username != getTitle( item.fname ) ) {
						position_message = 'left';
						foto_user = getTitle(item.tf);
					} else {
						position_message = 'right';
						foto_user = getTitle(item.tf);
					}
					jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<li class="chatboxmessage '+ position_message +'"><span class="date-time">'+ getTitle( item.fh ) +'</span><a href="javascript:;" class="name chatboxmessagefrom">'+ getTitle( item.fname ) +'</a><a href="javascript:;" class="image"><img alt="" src="../'+ getTitle(item.ff) +'"></a><div class="chatboxmessagecontent message">'+item.m+'</div></li>');
				}

				jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop(jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				itemsfound += 1;
			}
		});
	
	}});

}


function chatHeartbeat(){
	var itemsfound = 0;
	
	/*if (windowFocus == false) {
 
		var blinkNumber = 0;
		var titleChanged = 0;
		for (x in newMessagesWin) {
			if (newMessagesWin[x] == true) {
				++blinkNumber;
				if (blinkNumber >= blinkOrder) {
					//document.title = x+' says...';
					document.title = ' New message...';
					titleChanged = 1;
					break;	
				}
			}
		}
		
		if (titleChanged == 0) {
			document.title = originalTitle;
			blinkOrder = 0;
		} else {
			++blinkOrder;
		}

	} else {
		for (x in newMessagesWin) {
			newMessagesWin[x] = false;
		}
	}*/

	for (x in newMessages) {
		if (newMessages[x] == true) {
			if (chatboxFocus[x] == false) {
				//FIXME: add toggle all or none policy, otherwise it looks funny
				jQuery('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
			}
		}
	}
	
	$.ajax({
	  url: "?action=chatheartbeat",
	  cache: false,
	  dataType: "json",
	  success: function(data) {

		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug
				chatboxtitle = item.f;
				chatuserName = item.fname;
				if (jQuery("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle, chatuserName, item.ff, item.tf, 1);
				}
				if (jQuery("#chatbox_"+chatboxtitle).css('display') == 'none') {
					jQuery("#chatbox_"+chatboxtitle).css('display','block');
					restructureChatBoxes();
				}
				
				if (item.s == 1) {
					item.f = from_username;
				}
				if (item.s == 2) {
					//jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage left"><span class="chatboxinfo">'+item.m+'</span></div>');
					//jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div hidden="hidden"><audio controls="" autoplay=""><source src="../plantilla2/assets/notifications/hangouts_message.ogg" type="audio/ogg"><source src="../plantilla2/assets/notifications/hangouts_message.mp3" type="audio/mp3"></audio></div>');
				} else {
					newMessages[chatboxtitle] = true;
					newMessagesWin[chatboxtitle] = true;
					var DateTime = new Date();
					var foto_user;
					if (from_username != getTitle( item.fname ) ) {
						foto_user = item.ff;
					} else {
						foto_user = item.tf;
					}
					jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<li class="chatboxmessage left"><span class="date-time">'+ DateTime.getFullYear() + ' ' + ('0' + (DateTime.getMonth()+1)).slice(-2)  + '-' + ('0' + DateTime.getDate()).slice(-2) + ' ' + ('0' + DateTime.getHours()).slice(-2) + ':' +  ('0' + DateTime.getMinutes()).slice(-2) + ':' + ('0' + DateTime.getSeconds()).slice(-2) +'</span><a href="javascript:;" class="name chatboxmessagefrom">'+ getTitle( item.fname ) +'</a><a href="javascript:;" class="image"><img alt="" src="../'+ foto_user +'"></a><div class="chatboxmessagecontent message">'+item.m+'</div></li>');
					jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div hidden="hidden"><audio controls="" autoplay=""><source src="../plantilla2/assets/notifications/hangouts_message.ogg" type="audio/ogg"><source src="../plantilla2/assets/notifications/hangouts_message.mp3" type="audio/mp3"></audio></div>');
				}

				jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop(jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				itemsfound += 1;
			}
		});
		chatHeartbeatCount++;

		if (itemsfound > 0) {
			chatHeartbeatTime = minChatHeartbeat;
			chatHeartbeatCount = 1;
		} else if (chatHeartbeatCount >= 10) {
			chatHeartbeatTime *= 2;
			chatHeartbeatCount = 1;
			if (chatHeartbeatTime > maxChatHeartbeat) {
				chatHeartbeatTime = maxChatHeartbeat;
			}
		}
		
		setTimeout('chatHeartbeat();',chatHeartbeatTime);
	}});
}

function closeChatBox(chatboxtitle) {
	jQuery('#chatbox_'+chatboxtitle).css('display','none');
	restructureChatBoxes();

	$.post("?action=closechat", { chatbox: chatboxtitle} , function(data){	
	});

}

function toggleChatBoxGrowth(chatboxtitle) {
	if (jQuery('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {  
		
		var minimizedChatBoxes = new Array();
		
		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}

		var newCookie = '';

		for (i=0;i<minimizedChatBoxes.length;i++) {
			if (minimizedChatBoxes[i] != chatboxtitle) {
				newCookie += chatboxtitle+'|';
			}
		}

		newCookie = newCookie.slice(0, -1)


		$.cookie('chatbox_minimized', newCookie);
		jQuery('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');
		jQuery('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');
		jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop(jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
	} else {
		
		var newCookie = chatboxtitle;

		if ($.cookie('chatbox_minimized')) {
			newCookie += '|'+$.cookie('chatbox_minimized');
		}


		$.cookie('chatbox_minimized',newCookie);
		jQuery('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
		jQuery('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
	}
	
}

function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle, boxUserName, chatToFoto, chatFromFoto) {
	 
	if(event.keyCode == 13 && event.shiftKey == 0)  {
		message = jQuery(chatboxtextarea).val();
		message = message.replace(/^\s+|\s+$/g,"");

		jQuery(chatboxtextarea).val('');
		jQuery(chatboxtextarea).focus();
		jQuery(chatboxtextarea).css('height','44px');
		if (message != '') {
			$.post("?action=sendchat", {to: chatboxtitle, to_name: boxUserName, message: message, from_foto: chatFromFoto, to_foto: chatToFoto} , function(data){
				message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
				var DateTime = new Date();
				jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<li class="chatboxmessage right"><span class="date-time">'+  DateTime.getFullYear() + ' ' + ('0' + (DateTime.getMonth()+1)).slice(-2)  + '-' + ('0' + DateTime.getDate()).slice(-2) + ' ' + ('0' + DateTime.getHours()).slice(-2) + ':' +  ('0' + DateTime.getMinutes()).slice(-2) + ':' + ('0' + DateTime.getSeconds()).slice(-2) +'</span><a href="javascript:;" class="name chatboxmessagefrom">'+ getTitle( from_username ) +'</a><a href="javascript:;" class="image"><img alt="" src="../'+ chatFromFoto +'"></a><div class="chatboxmessagecontent message">'+message+'</div></li>');
				jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop(jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			});
		}
		chatHeartbeatTime = minChatHeartbeat;
		chatHeartbeatCount = 1;

		return false;
	}

	var adjustedHeight = chatboxtextarea.clientHeight;
	var maxHeight = 94;

	if (maxHeight > adjustedHeight) {
		adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
		if (maxHeight)
			adjustedHeight = Math.min(maxHeight, adjustedHeight);
		if (adjustedHeight > chatboxtextarea.clientHeight)
			jQuery(chatboxtextarea).css('height',adjustedHeight+8 +'px');
	} else {
		jQuery(chatboxtextarea).css('overflow','auto');
	}
	 
}

function startChatSession(){  
	$.ajax({
	  url: "?action=startchatsession",
	  cache: false,
	  dataType: "json",
	  success: function(data) {
 
		username = data.username;
		from_username = data.from_username;
		$.each(data.items, function(i,item){
			if (item)	{ // fix strange ie bug

				chatboxtitle = item.f;
				chatuserName = item.fname;
				/*if (jQuery("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(chatboxtitle, chatuserName, item.ff, item.tf, 1);
				}*/
				
				if (item.s == 1) {
					item.f = from_username;
					item.fname = from_username;
				}

				if (item.s == 2) {
					//jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<li class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></li>');
				} else {
					//jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+getTitle(item.fname)+':&nbsp;&nbsp;</span><div class="chatboxmessagecontent message">'+item.m+'</div></div>');
				}
			}
		});
		
		for (i=0;i<chatBoxes.length;i++) {
			chatboxtitle = chatBoxes[i];
			jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop(jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			setTimeout('jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop(jQuery("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
		}
	
	setTimeout('chatHeartbeat();',chatHeartbeatTime);
		
	}});
}

/**
 * Cookie plugin
 *
 * Copyright (c) 2006 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

jQuery.cookie = function(name, value, options) {
    if (typeof value != 'undefined') { // name and value given, set cookie
        options = options || {};
        if (value === null) {
            value = '';
            options.expires = -1;
        }
        var expires = '';
        if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
            var date;
            if (typeof options.expires == 'number') {
                date = new Date();
                date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
            } else {
                date = options.expires;
            }
            expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
        }
        // CAUTION: Needed to parenthesize options.path and options.domain
        // in the following expressions, otherwise they evaluate to undefined
        // in the packed version for some reason...
        var path = options.path ? '; path=' + (options.path) : '';
        var domain = options.domain ? '; domain=' + (options.domain) : '';
        var secure = options.secure ? '; secure' : '';
        document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
    } else { // only name given, get cookie
        var cookieValue = null;
        if (document.cookie && document.cookie != '') {
            var cookies = document.cookie.split(';');
            for (var i = 0; i < cookies.length; i++) {
                var cookie = jQuery.trim(cookies[i]);
                // Does this cookie string begin with the name we want?
                if (cookie.substring(0, name.length + 1) == (name + '=')) {
                    cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                    break;
                }
            }
        }
        return cookieValue;
    }
};