(function($,Edge,compId){var Composition=Edge.Composition,Symbol=Edge.Symbol;
//Edge symbol: 'stage'
(function(symbolName){Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",0,function(sym,e){});
//Edge binding end
Symbol.bindElementAction(compId,symbolName,"document","compositionReady",
    function(sym,e){
        var stageHeight=sym.$('Stage').height();sym.$("#Stage").css({"transform-origin":"0 0","-ms-transform-origin":"0 0","-webkit-transform-origin":"0 0","-moz-transform-origin":"0 0","-o-transform-origin":"0 0"});
    function scaleStage(){
        var stage=sym.$('Stage');
        var parent=sym.$('Stage').parent();
        var parentWidth=stage.parent().width();
        var stageWidth=stage.width();
        var desiredWidth=Math.round(parentWidth*1);
        var rescale=(desiredWidth/stageWidth);
            stage.css('transform','scale('+rescale+')');
            stage.css('-o-transform','scale('+rescale+')');
            stage.css('-ms-transform','scale('+rescale+')');
            stage.css('-webkit-transform','scale('+rescale+')');
            stage.css('-moz-transform','scale('+rescale+')');
            stage.css('-o-transform','scale('+rescale+')');
            parent.height(stageHeight*rescale);}$(window).on('resize',function(){scaleStage();});$(document).ready(function(){scaleStage();});});
                      
//Edge binding end
Symbol.bindTriggerAction(compId,symbolName,"Default Timeline",2150,function(sym,e){this.play(0);});
//Edge binding end
})("stage");
//Edge symbol end:'stage'
})(jQuery,AdobeEdge,"EDGE-184616930");