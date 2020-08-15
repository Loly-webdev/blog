let page = location.pathname.split('/').slice(-1);
$('nav ul li').removeClass('active');
$('#'+ page).addClass('active');
