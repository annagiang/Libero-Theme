/**
 * Created by ertaserdi on 05.07.2015.
 *
 * * Versiyon: 1.0.1
 *
 * Contact for support. / KatkÄ± saÄŸlamak iĂ§in iletiÅŸime geĂ§ebilirsiniz.
 * Email: ertaserdi@gmail.com
 * Download: https://github.com/ertaserdi/jQuery-PageLoading
 *
 * KullandÄ±ÄŸÄ±nÄ±z iĂ§in teÅŸekkĂ¼rler... / Thank you for using...
 *
 * LICENSE: https://github.com/ertaserdi/jQuery-PageLoading/blob/master/LICENSE
 */
(function($, window) {
    var pageLoadingidTime   =   true;

    var pageLoading_LoadS =  0;
    var pageLoading_Speed =  1;
    
    function pageLoading_Load(pageLoading_valueText){
    
        if(pageLoadingidTime==true){
            if(pageLoading_LoadS==600){
                pageLoading_Speed   =   10;
            }else if(pageLoading_LoadS==850){
                pageLoading_Speed   =   200;
            }else if(pageLoading_LoadS==990){
                pageLoading_Speed   =   400;
            }
        }else{
            pageLoading_Speed   =   1;
            pageLoading_LoadS=  pageLoading_LoadS+10;
        }
        if(pageLoading_LoadS>=1000){
            $("div.pageLoading").remove();
    
            return false;
        }
    
    
        $( ".pageLoadingInner" ).width((pageLoading_LoadS/10)+'%');
    
        setTimeout(function(){pageLoading_Load(pageLoading_valueText)},pageLoading_Speed);
        pageLoading_LoadS++;
    }
    
    
    function pageLoading(options){
        var pageLoading_defaultText = '';
    
        if( typeof options === 'object' ) {
    
            if($("div.pageLoading").length==0){
                $(options.elements).prepend("<div class='pageLoading'><div class='pageLoadingInner'></div></div>");
                $(options.elements).css("visibility","visible");
            }
            pageLoadingidTime   =   true;
            pageLoading_LoadS   =   0;
            pageLoading_Speed =  1;
    
            if("loadOut" in options){
                if(options.loadOut==true){
                    $(window).load(function() {
                        pageLoadingidTime   =   false;
                    });
                }
            }
    
    
        }else if( typeof options === 'string' ) {
            pageLoadingidTime   =   false;
    
        }else{
            pageLoading({show:'on'});
        }
    
        pageLoading_Load(pageLoading_defaultText);
    }
    
    window.pageLoading = pageLoading;
    
})(jQuery, window);