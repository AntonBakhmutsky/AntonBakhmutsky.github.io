//achievement_slider
$('.achievement_slider').slick({
    infinite: true,
    slidesToShow: 7,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 4,
                arrows: false
            }
        }
    ]
});

//interest_slider
$('.interest_slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 1,
                centerMode: true,
                arrows: false
            }
        }
    ]
});

//табы
$(document).ready(function() {
    const switchMobile = document.querySelector('.switch_block.mobile');
    const switchDesktop = document.querySelector('.switch_block.desktop');
    const buttonDesktop = document.querySelector('.filter_block .red_btn');
    const buttonMobile = document.querySelector('.main_tabs_block .mobile_btn .red_btn');

    buttonDesktop.style.display = 'none';
    buttonMobile.style.display = 'none';

    $('.main_tabs_block .tab_title').find('> li:eq(0)').addClass('active');
    $('.main_tabs_block .tab_content').find('> .tabs_item:eq(0)').addClass('active');
    $('.main_tabs_block .tab_title li').click(function () {
        var tab = $(this).closest('.main_tabs_block');
        var index = $(this).index();

        if (index === 1 && window.innerWidth > 992) {
            switchDesktop.style.display = 'none';
            buttonDesktop.removeAttribute('style');
        } else if (index === 1 && window.innerWidth <= 992) {
            switchMobile.style.display = 'none';
            buttonMobile.removeAttribute('style');
        } else {
           buttonDesktop.style.display = 'none';
           buttonMobile.style.display = 'none';
           switchDesktop.removeAttribute('style');
           switchMobile.removeAttribute('style');
        }

        tab.find('ul.tab_title > li').removeClass('active');
        $(this).addClass('active');
        tab.find('.tab_content').find('div.tabs_item').removeClass('active');
        tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').addClass('active');
    } );
});

//select_menu
$( ".select_menu" ).selectmenu();

//fixed_menu
$('header .nav_block .nav_btn').click(function () {
    $(".fixed_menu").toggleClass("active");
} );
$('.fixed_menu .close').click(function () {
    $(".fixed_menu").removeClass("active");
} );

//datepicker
$( ".datepicker" ).datepicker({
    showOn: "button",
    buttonImage: "img/date-icon-2.svg",
    buttonImageOnly: true,
    buttonText: "Select date",
    dateFormat: 'dd-mm-yy'
});

//меню с замочком
$(document).on('click', '.lock', function () {
    $(this).toggleClass("active");
    $(this).next('.drop_down').toggleClass("active");
});
$('body').click(function(evt){
    $('.lock_block .drop_down').removeClass("active");
});

//адаптив
$(window).on('load resize', function () {
    if ($(window).width() < 992) {
        $(document).on('click', '.main_info .left_block .caption', function () {
           $(this).next('.step_block').slideToggle(400);
        });
        $(document).on('click', '.main_info .right_block .caption', function () {
            $(this).next('.main_info .right_block .next_achievements').slideToggle(400);
        });
        $(document).on('click', '.main_tabs_block .mobile_tab_title', function () {
            $(this).next('.main_tabs_block .tab_title').slideToggle(400);
        });
        $(document).on('click', '.main_tabs_block .tab_title li', function () {
            var text = $(this).html();
            $(".main_tabs_block .mobile_tab_title .title").html(text);
        });
        $(document).on('click', '.filter_block .filter_icon', function () {
            $(".filter_block .container").addClass("active");
        });
        $(document).on('click', '.filter_block .filter_caption .close', function () {
            $(".filter_block .container").removeClass("active");
        });
        $('header .info_block .login').click(function () {
            $(".fixed_profile").addClass("active");
        } );
        $('.fixed_profile .close').click(function () {
            $(".fixed_profile").removeClass("active");
        } );
        $('footer .info_block').click(function () {
            $(".fixed_profile").addClass("active");
        } );
        $('.lock_block .lock').click(function () {
            $(".privacy_modal_1").addClass("active");
        } );
        $('.privacy_modal_1 .caption .close').click(function () {
            $(".privacy_modal_1").removeClass("active");
        } );
        $('.privacy_modal_1 .nav li').click(function () {
            $(".privacy_modal_2").addClass("active");
        } );
        $('.privacy_modal_2 .caption .close').click(function () {
            $(".privacy_modal_2").removeClass("active");
        } );
        $('.history_container .filter_icon').click(function () {
            $(".filter_history").addClass("active");
        } );
        $('.filter_history .caption_block .arrow').click(function () {
            $(".filter_history").removeClass("active");
        } );
        $('.filter_history .btn_block-mobile .black_btn').click(function (event) {
            event.preventDefault();
            $(".filter_history").removeClass("active");
        } );
        const resetMobile = document.querySelector('.reset_mobile');
        resetMobile.onclick = function  (event) {
            event.preventDefault();
            document.querySelectorAll('.title').forEach( el => el.classList.remove('active'));
        }
    }
});

//popup окно
$(document).ready(function() {
    $(".modal_overlay .modal_content").prepend('<div class="modal_close"></div>');
    $(".modal_btn").click(function(event) {
        var mBtn = $(this).attr("href");
        var scroll_top = $(window).scrollTop();
        var doc_h = $(window).height();
        var pos_modal = (doc_h/2) + scroll_top;
        event.preventDefault();
        $(mBtn).addClass('active');
        $('.modal_overlay .modal_content').css({'top' : pos_modal});
    });
    $('.modal_overlay .modal_close').click(function(){
        $('.modal_overlay').removeClass('active');
    });
    // $(document).mouseup(function (e) {
    //     var popup = $('.modal_overlay .modal_content');
    //     if (e.target!=popup[0]&&popup.has(e.target).length === 0){
    //         $('.modal_overlay').removeClass('active');
    //     }
    // });
});

//фильтр в истории заказов 
$(window).on('load resize', function () {
    if ($(window).width() > 992) {
        $('.filter_history .caption_block .arrow').click(function () {
            $(".filter_history").toggleClass("active");
        } );
        $('.filter_history .content_block .btn_block .black_btn').click(function (event) {
            event.preventDefault();
            $(".filter_history").removeClass("active");
        } );
        const reset = document.querySelector('.reset');
        reset.onclick = function (event) {
            event.preventDefault();
            document.querySelectorAll('.title').forEach( el => el.classList.remove('active'));
        }
    } 
});
$('.filter_history .content_block .title_block .title_flex .title').click(function () {
    $(this).toggleClass("active");
} );

//история заказов
$(window).on('load', function () {
    if ($(window).width() > 992) {
        $('.history_container .history_block .history_item .caption').click(function () {
            $(this).toggleClass("active");
            $(this).next().slideToggle(400);
        } );
    }
});

//переключатель событий
$('.filter_block .switch_block .item.event').click(function () {
    $('.filter_block .switch_block .item').removeClass("active");
    $(this).addClass("active");
    $('.show_event').addClass("active");
    $('.show_ticket').removeClass("active");
} );
$('.filter_block .switch_block .item.ticket').click(function () {
    $('.filter_block .switch_block .item').removeClass("active");
    $(this).addClass("active");
    $('.show_ticket').addClass("active");
    $('.show_event').removeClass("active");
} );

//кнопки платежей
$('.card_btn_container a').click(function (e) {
    e.preventDefault();
    $('.card_btn_container a').removeClass("active");
    $(this).addClass("active");
} );

//слайдер билетов
$(document).ready(function(){
    $('.carousel').carousel({
        carouselWidth:930,
        directionNav:true,
        autoplay:false,
        frontWidth: 296,
        frontHeight: 350,
        backZoom: 0.9
    });
});

//плюсик на слайдере билетов
$('.ticket_slider_container .carousel .slides .slideItem .front_block .btn_block .plus').click(function () {
    $(this).closest('.slideItem').find('.back_side').addClass("active");
} );

//блок с регистрацией
$('.registration_container .registration_block .with_img .login_show .white_btn').click(function () {
    $('.registration_container .registration_block .with_img').addClass("go_right");
    $('.registration_container .registration_block .with_form').addClass("go_left");
} );
$('.registration_container .registration_block .with_img .registration_show .white_btn').click(function () {
    $('.registration_container .registration_block .with_img').removeClass("go_right");
    $('.registration_container .registration_block .with_form').removeClass("go_left");
} );
$('.registration_show .caption_block .right_caption a').click(function () {
    $('.registration_show').addClass('hide');
    $('.login_show').addClass('show ');
} );
$('.login_show .caption_block .right_caption a').click(function () {
    $('.registration_show').removeClass('hide');
    $('.login_show').removeClass('show');
} );

//показать меню юзера
$(window).on('load resize', function () {
    if ($(window).width() > 992) {
        $('header .info_block .login').click(function () {
            $('header .info_block .login .drop_menu').toggleClass("active");
        } );
    }
});

//восстановить пароль
$('.registration_container .registration_block .with_form .login_show .forgot_password a').click(function () {
   $('.password_recovery').addClass('active');
   $('.login_show').removeClass('show');
   $('.login_show').addClass('hide');
} );
$('.password_recovery .back').click(function () {
    $('.password_recovery').removeClass('active');
    $('.login_show').addClass('show');
    $('.login_show').removeClass('hide');
} );


window.addEventListener('load', () => {
    //checkboxes at history modal_2 table_block
    const check = document.querySelector('.table_block .checkbox_block')
    const goods = document.querySelector('.table_block input[type="checkbox"]');
    const inputs = document.querySelectorAll('.table_block input[type="checkbox"]');
    const modalClose = document.querySelector('#modal_2 .modal_close');
    const cancel = document.querySelector('#modal_2 .cancel');
    const modal = document.querySelector('#modal_2');

    const removeCheckmarks = () => inputs.forEach(el => el.checked = false);
    const addCheckmarks = () => inputs.forEach(el => el.checked = true);
    const toggleAll = () => (goods.checked === false) ? addCheckmarks() : removeCheckmarks();
    const cancelModal = () => {
        event.preventDefault();
        removeCheckmarks();
        modal.classList.remove('active');
    }

    check.addEventListener('click', toggleAll);
    modalClose.addEventListener('click', removeCheckmarks);
    cancel.addEventListener('click', cancelModal);
});