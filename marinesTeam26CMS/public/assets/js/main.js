$('.slick-notification').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: false,
  dots:false,
  autoplay: true,
  autoplaySpeed: 3000,
  speed: 2000,
});
$('.slick-banner').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade: true,
  dots:false,
  autoplay: true,
  autoplaySpeed: 3000,
  speed: 500,
});
$('.slick-album').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: false,
  dots:true,
  autoplay: true,
  autoplaySpeed: 3000,
  speed: 500,
});

$('.slick-web').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: false,
  fade: false,
  dots:true,
  autoplay: true,
  autoplaySpeed: 3000,
  speed: 500,
});

$(function() {
  $(".js-name").lettering();
});

$('.js-menu-mb').click(function(){
  $(this).hide();
  $('.header__menu').fadeIn();
  $('body').css('overflow','hidden');
  $('.js-close').show();
});

$('.js-close').click(function(){
  $(this).hide();
  $('.header__menu').fadeOut();
  $('body').css('overflow','auto');
  $('.js-menu-mb').show();
});
$('.js-out').click(function(){
  $('.header__menu').fadeOut();
  $('body').css('overflow','auto');
  $('.js-close').hide();
  $('.js-menu-mb').show();
});

$('.login-js').click(function(){
  $('.login-pp').addClass('active-pp');
});
$('.js-bg-login').click(function(){
  $('.login-pp').removeClass('active-pp');
});

$('.js-message').click(function(){
  $('.js-pp-mess1').addClass('active-m');
});
$('.js-message2').click(function(){
  $('.js-pp-mess2').addClass('active-m');
});

$('.js-close').click(function(){
  $('.pp-message').removeClass('active-m');
});

$('.js-his').click(function(){
  $('.pp-total-d').addClass('active');
});
$('.js-close1,.js-bg').click(function(){
  $('.pp-total-d').removeClass('active');
});

$('.js-close2,.js-bg2').click(function(){
  $('.pp-ads').removeClass('active-ads');
});


$('.js-qa .form-control').each(function(){
  if ($(this).val() != ''){
    $(this).addClass('active');
  }
});
