/**
* @desc        Script functions

* @name        script_funct
* @author      m.tranier
* @requires    plugins.js / jquery-1.9.1.min.js / jquery-ui-1.10.2.custom.min.js / mappyApiPack.js / mappyInit.js / xtcore.js
*/

/**
* CONFIG PARAMETRES TAGS
* params to fill :
* xtnv = document
* xtpage, x1 : nom page
* xtsdi, xtsd, xtsite : fournis par le client
* xt_multc : customised indicators
*/
xtnv = document,
	xtsdi = "http://logc259.at.pagesjaunes.fr",
	xtsd = (parseInt($(window).innerWidth()) > 720) ? "http://log526427" : "http://log526426",
    // xtsd = (parseInt($(window).innerWidth()) > 720) ? "http://logv8" : "http://logv8",
	xtsite = (parseInt($(window).innerWidth()) > 720) ? "526427" : "526426",
    // xtsite = (parseInt($(window).innerWidth()) > 720) ? "527285" : "527285",
    xtpage = "", xtn2 = "", xt_cr = "";

!(function() {
    if(parseInt($(window).innerWidth()) <= 720) { $('html').addClass('mobile').removeClass('desktop'); }
    else { $('html').removeClass('mobile').addClass('desktop'); }
    if(typeof String.prototype.trim !== 'function') {
      String.prototype.trim = function() {
        return this.replace(/^\s+|\s+$/g, ''); 
      }
    }
})();

/**
* CONFIG PARAMETRES TAGS PAGE PLAN MAGASIN (MOB)
*/
function mapTags() {
    xtpage = "plan";
    xt_multc = "&x8=&x9=&x10=&stc=";

    // Tag page plan magasin
    sendTags(xtpage, xtsdi, xt_multc);
}

/**
* CONFIG PARAMETRES TAGS PAGE ERREUR SUPPORT NAVIGATEUR
*/
function majBrowserTags() {
    xtpage = "browser_update";
    // Tag page erreur support navigateur
    sendTags(xtpage, xtsdi, xt_multc);
}

/**
* CONFIG PARAMETRES TAGS PAGE ERREUR 404
*/
function error404Tags() {
    xtpage = "error_404";
    // Tag page erreur 404
    sendTags(xtpage, xtsdi, xt_multc);
}

/**
* CONFIG PARAMETRES TAGS PAGE ERREUR 500
*/
function error500Tags() {
    xtpage = "error_500";
    // Tag page erreur 500
    sendTags(xtpage, xtsdi, xt_multc);
}

/**
* ENVOI DES TAGS
*/
function sendTags(xtpage, xtsdi, xt_multc, event) {
    $('#tagLink').attr('href', 'http://www.xiti.com/xiti.asp?s=' + xtsite);
    $('#tagLink').attr('href', xtsdi + '?s=' + xtsite);
    
    if(event == 'page') {
        window.Xt_param = "xtsite=" + xtsite + "&xtpage="+xtpage+"&x1="+xtpage+xt_multc;
        /*$('#tags').empty()
                  .append('<noscript>Mesure d\'audience ROI statistique webanalytics par <img width="1" height="1" src="'+ xtsd 
                    + '.xiti.com/hit.xiti?s='+ xtsite + '&xtpage='+xtpage+'&x1='+xtpage+xt_multc +'" alt="WebAnalytics"/></noscript>');*/
        $('#tags').empty()
                  .append('<noscript>Mesure d\'audience ROI statistique webanalytics par <img width="1" height="1" src="'+ xtsdi 
                    + '?s='+ xtsite + '&xtpage='+xtpage+'&x1='+xtpage+xt_multc +'" alt="WebAnalytics"/></noscript>');
    }
    else {
        window.Xt_param = "xtsite=" + xtsite + xt_multc;
        /*$('#tags').empty()
                  .append('<noscript>Mesure d\'audience ROI statistique webanalytics par <img width="1" height="1" src="'+ xtsd 
                    + '.xiti.com/hit.xiti?s='+ xtsite + xt_multc +'" alt="WebAnalytics"/></noscript>');*/
        /*$('#tags').empty()
                  .append('<noscript>Mesure d\'audience ROI statistique webanalytics par <img width="1" height="1" src="'+ xtsdi 
                    + '?s='+ xtsite + xt_multc +'" alt="WebAnalytics"/></noscript>');*/
    }


    // Xt_i = '<img width="0" height="0" border="0" alt="" src="' + xtsd + '.xiti.com/hit.xiti?'+Xt_param;
    Xt_i = '<img width="0" height="0" border="0" alt="" src="' + xtsdi + '?'+Xt_param;
    $('<iframe id="tagFrame" src=""></iframe>').appendTo($('body'));
    var iframe= $('#tagFrame')[0];
    var iframewindow= iframe.contentWindow? iframe.contentWindow : iframe.contentDocument.defaultView;
    iframewindow.document.write(Xt_i+'" title="Internet Audience"/>');
    setTimeout(function() { $('#tagFrame').remove(); }, 500);
    xt_multc = "";
}
