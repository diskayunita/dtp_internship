var Layout=function(){var layoutImgPath='img/';var layoutCssPath='css/';var resBreakpointMd=App.getResponsiveBreakpoint('md');var handleHeader=function(){$('.page-header').on('click','.search-form',function(e){$(this).addClass("open");$(this).find('.form-control').focus();$('.page-header .search-form .form-control').on('blur',function(e){$(this).closest('.search-form').removeClass("open");$(this).unbind("blur");});});$('.page-header').on('keypress','.hor-menu .search-form .form-control',function(e){if(e.which==13){$(this).closest('.search-form').submit();return false;}});$('.page-header').on('mousedown','.search-form.open .submit',function(e){e.preventDefault();e.stopPropagation();$(this).closest('.search-form').submit();});$('body').on('click','.page-header-top-fixed .page-header-top .menu-toggler',function(){App.scrollTop();});};var handleMainMenu=function(){$(".page-header .menu-toggler").on("click",function(event){if(App.getViewPort().width<resBreakpointMd){var menu=$(".page-header .page-header-menu");if(menu.is(":visible")){menu.slideUp(300);}else{menu.slideDown(300);}
if($('body').hasClass('page-header-top-fixed')){App.scrollTop();}}});$(".hor-menu .menu-dropdown > a, .hor-menu .dropdown-submenu > a").on("click",function(e){if(App.getViewPort().width<resBreakpointMd){if($(this).next().hasClass('dropdown-menu')){e.stopPropagation();if($(this).parent().hasClass("opened")){$(this).parent().removeClass("opened");}else{$(this).parent().addClass("opened");}}}});$(".hor-menu li > a").on("click",function(e){if(App.getViewPort().width<resBreakpointMd){if(!$(this).parent('li').hasClass('classic-menu-dropdown')&&!$(this).parent('li').hasClass('mega-menu-dropdown')&&!$(this).parent('li').hasClass('dropdown-submenu')){$(".page-header .page-header-menu").slideUp(300);App.scrollTop();}}});$(document).on('click','.mega-menu-dropdown .dropdown-menu, .classic-menu-dropdown .dropdown-menu',function(e){e.stopPropagation();});$(window).scroll(function(){var offset=75;if($('body').hasClass('page-header-menu-fixed')){if($(window).scrollTop()>offset){$(".page-header-menu").addClass("fixed");}else{$(".page-header-menu").removeClass("fixed");}}
if($('body').hasClass('page-header-top-fixed')){if($(window).scrollTop()>offset){$(".page-header-top").addClass("fixed");}else{$(".page-header-top").removeClass("fixed");}}});};var handleMainMenuActiveLink=function(mode,el,$state){var url=encodeURI(location.hash).toLowerCase();var menu=$('.hor-menu');if(mode==='click'||mode==='set'){el=$(el);}else if(mode==='match'){menu.find("li > a").each(function(){var state=$(this).attr('ui-sref');if($state&&state){if($state.is(state)){el=$(this);return;}}else{var path=$(this).attr('href');if(path){path=path.toLowerCase();if(path.length>1&&url.substr(1,path.length-1)==path.substr(1)){el=$(this);return;}}}});}
if(!el||el.size()==0){return;}
if(el.attr('href')=='javascript:;'||el.attr('ui-sref')=='javascript:;'||el.attr('href')=='#'||el.attr('ui-sref')=='#'){return;}
menu.find('li.active').removeClass('active');menu.find('li > a > .selected').remove();menu.find('li.open').removeClass('open');el.parents('li').each(function(){$(this).addClass('active');if($(this).parent('ul.navbar-nav').size()===1){$(this).find('> a').append('<span class="selected"></span>');}});};var handleMainMenuOnResize=function(){var width=App.getViewPort().width;var menu=$(".page-header-menu");if(width>=resBreakpointMd){$(".page-header-menu").css("display","block");}else if(width<resBreakpointMd){$(".page-header-menu").css("display","none");}};var handleContentHeight=function(){return;var height;if($('body').height()<App.getViewPort().height){height=App.getViewPort().height-$('.page-header').outerHeight()-($('.page-container').outerHeight()-$('.page-content').outerHeight())-$('.page-prefooter').outerHeight()-$('.page-footer').outerHeight();$('.page-content').css('min-height',height);}};var handleGoTop=function(){var offset=100;var duration=500;if(navigator.userAgent.match(/iPhone|iPad|iPod/i)){$(window).bind("touchend touchcancel touchleave",function(e){if($(this).scrollTop()>offset){$('.scroll-to-top').fadeIn(duration);}else{$('.scroll-to-top').fadeOut(duration);}});}else{$(window).scroll(function(){if($(this).scrollTop()>offset){$('.scroll-to-top').fadeIn(duration);}else{$('.scroll-to-top').fadeOut(duration);}});}
$('.scroll-to-top').click(function(e){e.preventDefault();$('html, body').animate({scrollTop:0},duration);return false;});};return{initHeader:function($state){handleHeader();handleMainMenu();App.addResizeHandler(handleMainMenuOnResize);if(App.isAngularJsApp()){handleMainMenuActiveLink('match',null,$state);}},initContent:function(){handleContentHeight();},initFooter:function(){handleGoTop();},init:function(){this.initHeader();this.initContent();this.initFooter();},setMainMenuActiveLink:function(mode,el){handleMainMenuActiveLink(mode,el);},setAngularJsMainMenuActiveLink:function(mode,el,$state){handleMainMenuActiveLink(mode,el,$state);},closeMainMenu:function(){$('.hor-menu').find('li.open').removeClass('open');if(App.getViewPort().width<resBreakpointMd&&$('.page-header-menu').is(":visible")){$('.page-header .menu-toggler').click();}},getLayoutImgPath:function(){return App.getAssetsPath()+layoutImgPath;},getLayoutCssPath:function(){return App.getAssetsPath()+layoutCssPath;}};}();if(App.isAngularJsApp()===false){jQuery(document).ready(function(){Layout.init();});}