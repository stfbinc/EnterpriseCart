$(document).ready(function(){
    var currentTheme = localStorage.getItem('ColorTheme');
    if(currentTheme)
	$('#theme').attr({href: 'dependencies/assets/css/colors/'+currentTheme+'.css'});
 
    // color selector
    $('#themecolors').on('click', 'a', function(){
        $('#themecolors li a').removeClass('working');
        $(this).addClass('working');
    });

    $("*[theme]").click(function(e){
	e.preventDefault();
        var currentStyle = $(this).attr('theme');
        localStorage.setItem('ColorTheme', currentStyle);
        $('#theme').attr({href: 'dependencies/assets/css/colors/'+currentStyle+'.css'});
    });
});
