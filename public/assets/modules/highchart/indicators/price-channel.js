/*
  Highcharts JS v7.1.1 (2019-04-09)

 Indicator series type for Highstock

 (c) 2010-2019 Daniel Studencki

 License: www.highcharts.com/license
*/
(function(a){"object"===typeof module&&module.exports?(a["default"]=a,module.exports=a):"function"===typeof define&&define.amd?define("highcharts/indicators/price-channel",["highcharts","highcharts/modules/stock"],function(e){a(e);a.Highcharts=e;return a}):a("undefined"!==typeof Highcharts?Highcharts:void 0)})(function(a){function e(a,b,t,d){a.hasOwnProperty(b)||(a[b]=d.apply(null,t))}a=a?a._modules:{};e(a,"mixins/reduce-array.js",[a["parts/Globals.js"]],function(a){var b=a.reduce;return{minInArray:function(a,
d){return b(a,function(a,b){return Math.min(a,b[d])},Number.MAX_VALUE)},maxInArray:function(a,d){return b(a,function(a,b){return Math.max(a,b[d])},-Number.MAX_VALUE)},getArrayExtremes:function(a,d,q){return b(a,function(a,f){return[Math.min(a[0],f[d]),Math.max(a[1],f[q])]},[Number.MAX_VALUE,-Number.MAX_VALUE])}}});e(a,"mixins/multipe-lines.js",[a["parts/Globals.js"]],function(a){var b=a.each,e=a.merge,d=a.error,q=a.defined,r=a.seriesTypes.sma;return{pointArrayMap:["top","bottom"],pointValKey:"top",
linesApiNames:["bottomLine"],getTranslatedLinesNames:function(a){var f=[];b(this.pointArrayMap,function(b){b!==a&&f.push("plot"+b.charAt(0).toUpperCase()+b.slice(1))});return f},toYData:function(a){var f=[];b(this.pointArrayMap,function(b){f.push(a[b])});return f},translate:function(){var a=this,d=a.pointArrayMap,k=[],c,k=a.getTranslatedLinesNames();r.prototype.translate.apply(a,arguments);b(a.points,function(f){b(d,function(b,d){c=f[b];null!==c&&(f[k[d]]=a.yAxis.toPixels(c,!0))})})},drawGraph:function(){var a=
this,u=a.linesApiNames,k=a.points,c=k.length,h=a.options,m=a.graph,n={options:{gapSize:h.gapSize}},l=[],p=a.getTranslatedLinesNames(a.pointValKey),g;b(p,function(a,b){for(l[b]=[];c--;)g=k[c],l[b].push({x:g.x,plotX:g.plotX,plotY:g[a],isNull:!q(g[a])});c=k.length});b(u,function(b,c){l[c]?(a.points=l[c],h[b]?a.options=e(h[b].styles,n):d('Error: "There is no '+b+' in DOCS options declared. Check if linesApiNames are consistent with your DOCS line names." at mixin/multiple-line.js:34'),a.graph=a["graph"+
b],r.prototype.drawGraph.call(a),a["graph"+b]=a.graph):d('Error: "'+b+" doesn't have equivalent in pointArrayMap. To many elements in linesApiNames relative to pointArrayMap.\"")});a.points=k;a.options=h;a.graph=m;r.prototype.drawGraph.call(a)}}});e(a,"indicators/price-channel.src.js",[a["parts/Globals.js"],a["mixins/reduce-array.js"],a["mixins/multipe-lines.js"]],function(a,b,e){var d=b.getArrayExtremes;b=a.merge;a.seriesType("pc","sma",{params:{period:20},lineWidth:1,topLine:{styles:{lineColor:"#90ed7d",
lineWidth:1}},bottomLine:{styles:{lineColor:"#f45b5b",lineWidth:1}},dataGrouping:{approximation:"averages"}},b(e,{pointArrayMap:["top","middle","bottom"],pointValKey:"middle",nameBase:"Price Channel",nameComponents:["period"],linesApiNames:["topLine","bottomLine"],getValues:function(a,b){b=b.period;var f=a.xData,e=(a=a.yData)?a.length:0,k=[],c,h,m,n,l=[],p=[],g;if(e<b)return!1;for(g=b;g<=e;g++)n=f[g-1],h=a.slice(g-b,g),c=d(h,2,1),h=c[1],m=c[0],c=(h+m)/2,k.push([n,h,c,m]),l.push(n),p.push([h,c,m]);
return{values:k,xData:l,yData:p}}}))});e(a,"masters/indicators/price-channel.src.js",[],function(){})});
//# sourceMappingURL=price-channel.js.map
