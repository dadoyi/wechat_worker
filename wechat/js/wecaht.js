

//搴曢儴鎵╁睍閿�
$(function() {
    $('#doc-dropdown-js').dropdown({justify: '#doc-dropdown-justify-js'});
});

$(function(){
    $(".office_text").panel({iWheelStep:32});
});

//tab for three icon
$(document).ready(function(){
    $(".sidestrip_icon a").click(function(){
        $(".sidestrip_icon a").eq($(this).index()).addClass("cur").siblings().removeClass('cur');
        $(".middle").hide().eq($(this).index()).show();
    });
});

//input box focus
$(document).ready(function(){
    $("#input_box").focus(function(){
        $('.windows_input').css('background','#fff');
        $('#input_box').css('background','#fff');
    });
    $("#input_box").blur(function(){
        $('.windows_input').css('background','');
        $('#input_box').css('background','');
    });
});

window.onload=function b(){
    var text = document.getElementById('input_box');
    var chat = document.getElementById('chatbox');
    var btn = document.getElementById('send');
    var talk = document.getElementById('talkbox');

    btn.onclick=function(){
        if(text.value ==''){
            alert('涓嶈兘鍙戦€佺┖娑堟伅');
        }else{
            chat.innerHTML += '<li class="me"><img src="'+'images/own_head.jpg'+'"><span>'+text.value+'</span></li>';
            text.value = '';
            chat.scrollTop=chat.scrollHeight;
            talk.style.background="#fff";
            text.style.background="#fff";
        };
    };
};






















































