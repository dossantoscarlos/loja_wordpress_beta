jQuery(document).ready(function($) {


// check if fb is loaded
var checkfb = 1;



function get_browser() {
    var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
    if(/trident/i.test(M[1])){
        tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
        return {name:'IE',version:(tem[1]||'')};
        }   
    if(M[1]==='Chrome'){
        tem=ua.match(/\bOPR|Edge\/(\d+)/)
        if(tem!=null)   {return {name:'Opera', version:tem[1]};}
        }   
    M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
    return {
        name: M[0],
        version: M[1]
    };
}
// source 
// https://stackoverflow.com/a/16938481/2591092

var browser = get_browser();
browser_name = browser.name.toLowerCase();

// if safari browser .. 
if ( browser_name == "safari" && browser.version >= 12 ) {
    // if ( browser_name == "chrome" && browser.version >= 12 ) {
    // console.log('Safari 12');
    fbcheck();
}


function fbcheck() {

    if ( window.FB ) {
    //    console.log('FB Exists ..........'); 
        messageus();
    } else {
    //    console.log('FB check' ); 
        checkfb++;
        if ( checkfb < 100 ) {
            setTimeout(fbcheck, 100);
        }
    }
}


function messageus() {
    // console.log('messageus');

    var htcc_message_us = document.querySelector('.htcc_message_us div');
    
    if ( htcc_message_us ) {
        htcc_message_us.classList.add('fb-messengermessageus');
    }

    setTimeout(do_parse, 500);

}

function do_parse() {
    // parse .. 
    FB.XFBML.parse(document.getElementById('htcc_message_us'), parsed_messageus );
}

function parsed_messageus() {
    // console.log('message us parsed on safari 12');
}

});