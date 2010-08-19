/** jquery.color.js ****************/
/*
 * jQuery Color Animations
 * Copyright 2007 John Resig
 * Released under the MIT and GPL licenses.
 */

(function(jQuery){

	// We override the animation for all of these color styles
	jQuery.each(['backgroundColor', 'borderBottomColor', 'borderLeftColor', 'borderRightColor', 'borderTopColor', 'color', 'outlineColor'], function(i,attr){
		jQuery.fx.step[attr] = function(fx){
			if ( fx.state == 0 ) {
				fx.start = getColor( fx.elem, attr );
				fx.end = getRGB( fx.end );
			}
            if ( fx.start )
                fx.elem.style[attr] = "rgb(" + [
                    Math.max(Math.min( parseInt((fx.pos * (fx.end[0] - fx.start[0])) + fx.start[0]), 255), 0),
                    Math.max(Math.min( parseInt((fx.pos * (fx.end[1] - fx.start[1])) + fx.start[1]), 255), 0),
                    Math.max(Math.min( parseInt((fx.pos * (fx.end[2] - fx.start[2])) + fx.start[2]), 255), 0)
                ].join(",") + ")";
		}
	});

	// Color Conversion functions from highlightFade
	// By Blair Mitchelmore
	// http://jquery.offput.ca/highlightFade/

	// Parse strings looking for color tuples [255,255,255]
	function getRGB(color) {
		var result;

		// Check if we're already dealing with an array of colors
		if ( color && color.constructor == Array && color.length == 3 )
			return color;

		// Look for rgb(num,num,num)
		if (result = /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(color))
			return [parseInt(result[1]), parseInt(result[2]), parseInt(result[3])];

		// Look for rgb(num%,num%,num%)
		if (result = /rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(color))
			return [parseFloat(result[1])*2.55, parseFloat(result[2])*2.55, parseFloat(result[3])*2.55];

		// Look for #a0b1c2
		if (result = /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(color))
			return [parseInt(result[1],16), parseInt(result[2],16), parseInt(result[3],16)];

		// Look for #fff
		if (result = /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(color))
			return [parseInt(result[1]+result[1],16), parseInt(result[2]+result[2],16), parseInt(result[3]+result[3],16)];

		// Otherwise, we're most likely dealing with a named color
		return colors[jQuery.trim(color).toLowerCase()];
	}
	
	function getColor(elem, attr) {
		var color;

		do {
			color = jQuery.curCSS(elem, attr);

			// Keep going until we find an element that has color, or we hit the body
			if ( color != '' && color != 'transparent' || jQuery.nodeName(elem, "body") )
				break; 

			attr = "backgroundColor";
		} while ( elem = elem.parentNode );

		return getRGB(color);
	};
	
	// Some named colors to work with
	// From Interface by Stefan Petre
	// http://interface.eyecon.ro/

	var colors = {
		aqua:[0,255,255],
		azure:[240,255,255],
		beige:[245,245,220],
		black:[0,0,0],
		blue:[0,0,255],
		brown:[165,42,42],
		cyan:[0,255,255],
		darkblue:[0,0,139],
		darkcyan:[0,139,139],
		darkgrey:[169,169,169],
		darkgreen:[0,100,0],
		darkkhaki:[189,183,107],
		darkmagenta:[139,0,139],
		darkolivegreen:[85,107,47],
		darkorange:[255,140,0],
		darkorchid:[153,50,204],
		darkred:[139,0,0],
		darksalmon:[233,150,122],
		darkviolet:[148,0,211],
		fuchsia:[255,0,255],
		gold:[255,215,0],
		green:[0,128,0],
		indigo:[75,0,130],
		khaki:[240,230,140],
		lightblue:[173,216,230],
		lightcyan:[224,255,255],
		lightgreen:[144,238,144],
		lightgrey:[211,211,211],
		lightpink:[255,182,193],
		lightyellow:[255,255,224],
		lime:[0,255,0],
		magenta:[255,0,255],
		maroon:[128,0,0],
		navy:[0,0,128],
		olive:[128,128,0],
		orange:[255,165,0],
		pink:[255,192,203],
		purple:[128,0,128],
		violet:[128,0,128],
		red:[255,0,0],
		silver:[192,192,192],
		white:[255,255,255],
		yellow:[255,255,0]
	};
	
})(jQuery);

/** jquery.lavalamp.js ****************/
/**
 * LavaLamp - A menu plugin for jQuery with cool hover effects.
 * @requires jQuery v1.1.3.1 or above
 *
 * http://gmarwaha.com/blog/?p=7
 *
 * Copyright (c) 2007 Ganeshji Marwaha (gmarwaha.com)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Version: 0.1.0
 */

/**
 * Creates a menu with an unordered list of menu-items. You can either use the CSS that comes with the plugin, or write your own styles 
 * to create a personalized effect
 *
 * The HTML markup used to build the menu can be as simple as...
 *
 *       <ul class="lavaLamp">
 *           <li><a href="#">Home</a></li>
 *           <li><a href="#">Plant a tree</a></li>
 *           <li><a href="#">Travel</a></li>
 *           <li><a href="#">Ride an elephant</a></li>
 *       </ul>
 *
 * Once you have included the style sheet that comes with the plugin, you will have to include 
 * a reference to jquery library, easing1 plugin(optional) and the LavaLamp(this) plugin.
 *
 * Use the following snippet to initialize the menu.
 *   $(function() { $(".lavaLamp").lavaLamp({ fx: "backout", speed: 700}) });
 *
 * Thats it. Now you should have a working lavalamp menu. 
 *
 * @param an options object - You can specify all the options shown below as an options object param.
 *
 * @option fx - default is "linear"
 * @example
 * $(".lavaLamp").lavaLamp({ fx: "backout" });
 * @desc Creates a menu with "backout" easing1 effect. You need to include the easing1 plugin for this to work.
 *
 * @option speed - default is 500 ms
 * @example
 * $(".lavaLamp").lavaLamp({ speed: 500 });
 * @desc Creates a menu with an animation speed of 500 ms.
 *
 * @option click - no defaults
 * @example
 * $(".lavaLamp").lavaLamp({ click: function(event, menuItem) { return false; } });
 * @desc You can supply a callback to be executed when the menu item is clicked. 
 * The event object and the menu-item that was clicked will be passed in as arguments.
 */

(function($) {
	
    $.fn.lavaLamp = function(o1) {
        o1 = $.extend({ fx: "linear", speed: 500, click: function(){} }, o1 || {});

        return this.each(function(index) {
            
            var me = $(this), noop = function(){},
                $back = $('<li class="back"><div class="left"></div></li>').appendTo(me),
                $li = $(">li", this), curr = $("li.current", this)[0] || $($li[0]).addClass("current")[0];

            $li.not(".back").hover(function() {
                move(this);
            }, noop);

            $(this).hover(noop, function() {
              move(curr);
            });

            $li.click(function(e1) {
                setCurr(this);
                return o1.click.apply(this, [e1, this]);
            });

            setCurr(curr);

            function setCurr(el) {
                $back.css({ "left": el.offsetLeft+"px", "width": el.offsetWidth+"px" });
                curr = el;
            };
            
            function move(el) {
                $back.each(function() {
                    $.dequeue(this, "fx"); }
                ).animate({
                    width: el.offsetWidth,
                    left: el.offsetLeft
                }, o1.speed, o1.fx);
            };

            if (index == 0){
                $(window).resize(function(){
                    $back.css({
                        width: curr.offsetWidth,
                        left: curr.offsetLeft
                    });
                });
            }
            
        });
    };
})(jQuery);

/** jquery.easing1.js ****************/
/*
 * jQuery easing1 v1.1 - http://gsgd.co.uk/sandbox/jquery.easing1.php
 *
 * Uses the built in easing capabilities added in jQuery 1.1
 * to offer multiple easing options
 *
 * Copyright (c) 2007 George Smith
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 */
jQuery.easing1={easein:function(x1,t1,b1,c1,d1){return c1*(t1/=d1)*t1+b1},
easeinout:function(x1,t1,b1,c1,d1){if(t1<d1/2)return 2*c1*t1*t1/(d1*d1)+b1;
var a1=t1-d1/2;return-2*c1*a1*a1/(d1*d1)+2*c1*a1/d1+c1/2+b1},easeout:function(x1,t1,b1,c1,d1)
{return-c1*t1*t1/(d1*d1)+2*c1*t1/d1+b1},expoin:function(x1,t1,b1,c1,d1){var a1=1;if(c1<0){a1*=-1;c1*=-1}
return a1*(Math.exp(Math.log(c1)/d1*t1))+b1},expoout:function(x1,t1,b1,c1,d1){var a1=1;if(c1<0){a1*=-1;
c1*=-1}return a1*(-Math.exp(-Math.log(c1)/d1*(t1-d1))+c1+1)+b1},expoinout:function(x1,t1,b1,c1,d1)
{var a1=1;if(c1<0){a1*=-1;c1*=-1}if(t1<d1/2)return a1*(Math.exp(Math.log(c1/2)/(d1/2)*t1))+b1;
return a1*(-Math.exp(-2*Math.log(c1/2)/d1*(t1-d1))+c1+1)+b1},bouncein:function(x1,t1,b1,c1,d1)
{return c1-jQuery.easing1['bounceout'](x1,d1-t1,0,c1,d1)+b1},bounceout:function(x1,t1,b1,c1,d1)
{if((t1/=d1)<(1/2.75)){return c1*(7.5625*t1*t1)+b1}else if(t1<(2/2.75))
{return c1*(7.5625*(t1-=(1.5/2.75))*t1+.75)+b1}else if(t1<(2.5/2.75))
{return c1*(7.5625*(t1-=(2.25/2.75))*t1+.9375)+b1}else
{return c1*(7.5625*(t1-=(2.625/2.75))*t1+.984375)+b1}},bounceinout:function(x1,t1,b1,c1,d1){if(t1<d1/2)
return jQuery.easing1['bouncein'](x1,t1*2,0,c1,d1)*.5+b1;
return jQuery.easing1['bounceout'](x1,t1*2-d1,0,c1,d1)*.5+c1*.5+b1},
elasin:function(x1,t1,b1,c1,d1){var s1=1.70158;var p1=0;var a1=c1;if(t1==0)
return b1;if((t1/=d1)==1)return b1+c1;if(!p1)p1=d1*.3;if(a1<Math.abs(c1)){a1=c1;var s1=p1/4}else 
var s1=p1/(2*Math.PI)*Math.asin(c1/a1);return-(a1*Math.pow(2,10*(t1-=1))*Math.sin((t1*d1-s1)*(2*Math.PI)/p1))+b1},
elasout:function(x1,t1,b1,c1,d1){var s1=1.70158;var p1=0;var a1=c1;if(t1==0)return b1;if((t1/=d1)==1)
return b1+c1;if(!p1)p1=d1*.3;if(a1<Math.abs(c1)){a1=c1;var s1=p1/4}
else var s1=p1/(2*Math.PI)*Math.asin(c1/a1);return a1*Math.pow(2,-10*t1)*Math.sin((t1*d1-s1)*(2*Math.PI)/p1)+c1+b1},
elasinout:function(x1,t1,b1,c1,d1){var s1=1.70158;var p1=0;var a1=c1;if(t1==0)return b1;
if((t1/=d1/2)==2)return b1+c1;if(!p1)p1=d1*(.3*1.5);if(a1<Math.abs(c1)){a1=c1;var s1=p1/4}
else var s1=p1/(2*Math.PI)*Math.asin(c1/a1);if(t1<1)return-.5*(a1*Math.pow(2,10*(t-=1))*Math.sin((t1*d1-s1)*(2*Math.PI)/p1))+b1;
return a1*Math.pow(2,-10*(t1-=1))*Math.sin((t1*d1-s1)*(2*Math.PI)/p1)*.5+c1+b1},
backin:function(x1,t1,b1,c1,d1){var s1=1.70158;return c1*(t1/=d1)*t1*((s1+1)*t1-s1)+b1},
backout1:function(x1,t1,b1,c1,d1){var s1=1.70158;return c1*((t1=t1/d1-1)*t1*((s1+1)*t1+s1)+1)+b1},
backinout:function(x1,t1,b1,c1,d1){var s1=1.70158;if((t1/=d1/2)<1)
return c1/2*(t1*t1*(((s1*=(1.525))+1)*t1-s1))+b1;return c1/2*((t1-=2)*t1*(((s1*=(1.525))+1)*t1+s1)+2)+b1},
linear:function(x1,t1,b1,c1,d1){return c1*t1/d1+b1}};


/** apycom menu ****************/
jQuery(function() {
    
    var $ = jQuery;
    // retarder
    $.fn.retarder = function(delay, method){
        var node = this;
        if (node.length){
            if (node[0]._timer_) clearTimeout(node[0]._timer_);
            node[0]._timer_ = setTimeout(function(){ method(node); }, delay);
        }
        return this;
    };
    
    // base rules
    $('ul ul', '#menu').css({display: 'none', left: -2});
    $('li', '#menu').hover(
        function(){
            var ul = $('ul:first', this);
            $('span', ul).css('color', 'rgb(169,169,169)');
            if (ul.length){
                if (!ul[0].wid){
                    ul[0].wid = ul.width();
                    ul[0].hei = ul.height();
                }
                ul.css({width: 0, height: 0, overflow: 'hidden', display: 'block'}).retarder(100, function(i){
                    i.animate({width: ul[0].wid, height: ul[0].hei}, {duration: 300, complete : function(){ ul.css('overflow', 'visible'); }});
                });
            }
        },
        function(){
            var ul  = $('ul:first', this);
            if (ul.length){
                var css = {display: 'none', width: ul[0].wid, height: ul[0].hei};
                ul.stop().css('overflow', 'hidden').retarder(50, function(i){
                    i.animate({width: 0, height: 0}, {duration: 100, complete : function(){  $(this).css(css); }});
                });
            }
        }
    );
    // lava lamp
    $('#menu ul.menu').lavaLamp({
        fx: 'backout1',
        speed: 800
    });
    // color animation
    if (!($.browser.msie && $.browser.version.substr(0, 1) == '6')){
        $('ul ul a span', '#menu').css('color', 'rgb(169,169,169)').hover(
            function(){ $(this).animate({color: 'rgb(255,255,255)'}, 500); },
            function(){ $(this).animate({color: 'rgb(169,169,169)'}, 200); }
        );
    }
});