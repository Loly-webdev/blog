let page = location.pathname.split('/').slice(-1);
$('nav ul li').removeClass('active bg-gradient');
$('#'+ page).addClass('active bg-gradient');
