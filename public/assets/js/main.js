(function($) {
    "use strict";

    var windowHeight;
    var windowWidth;
    var contentHeight;
    var contentWidth;
    var isDevice = true;

    function windowResizeHandler() {
        windowHeight = window.innerHeight;
        windowWidth = $(window).width();
        if(main_vars.top_admin_menu) {
            if(windowWidth < 783) {
                contentHeight = windowHeight - ( $('#header').height() + 64 );
            } else {
                contentHeight = windowHeight - ( $('#header').height() + 32 );
            }
        } else {
            contentHeight = windowHeight - $('#header').height();
        }

        $('#leftSide').height(contentHeight);
        $('.closeLeftSide').height(contentHeight);
        $('#wrapper').height(contentHeight);
        $('#mapView').height(contentHeight);
        $('#mapSingleView').height(contentHeight);
        $('#mapNewView').height(contentHeight);
        $('#mapMyView').height(contentHeight);
        $('#mapFavView').height(contentHeight);
        $('#mapAgentView').height(contentHeight);
        $('#mapIdxView').height(contentHeight);
        $('#content').height(contentHeight - 1);
        setTimeout(function() {
            $('.commentsFormWrapper').width(contentWidth);
        }, 300);

        if (map) {
            google.maps.event.trigger(map, 'resize');
        }

        if (appMap) {
            google.maps.event.trigger(appMap, 'resize');
        }

        // Add custom scrollbar for left side navigation
        $('.bigNav').slimScroll({
            height : contentHeight
        });
        if($('.bigNav').parent('.slimScrollDiv').size() > 0) {
            $('.bigNav').parent().replaceWith($('.bigNav'));
            $('.bigNav').slimScroll({
                height : contentHeight
            });
        }

        // reposition of prices and area reange sliders tooltip
        var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
        var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
        var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
        $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);

        var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
        var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
        var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
        $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);

        $("img.scale").imageScale();
    }

    if(!(('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch)) {
        $('body').addClass('no-touch');
        isDevice = false;
    }

    $('input, textarea').placeholder();
    $('#searchform input[type=text]').attr('placeholder', main_vars.search_placeholder);

    windowResizeHandler();
    $(window).resize(function() {
        windowResizeHandler();
    });

    setTimeout(function() {
        $('body').removeClass('notransition');
    }, 300);

    // Header search icon transition
    $('.search input').focus(function() {
        $('.searchIcon').addClass('active');
    });
    $('.search input').blur(function() {
        $('.searchIcon').removeClass('active');
    });

    $('.top-nav > div > ul > li.menu-item-has-children > a').append('&nbsp;&nbsp;<span class="fa fa-angle-down"></span>');
    $('.leftNav > div > ul > li.menu-item-has-children > a').append('<span class="fa fa-angle-down arrowRight"></span>');

    // functionality for map manipulation icon on mobile devices
    $('.mapHandler').click(function() {
        if ($('#mapView').hasClass('mob-min') || 
            $('#mapView').hasClass('mob-max') || 
            $('#mapSingleView').hasClass('mob-min') || 
            $('#mapSingleView').hasClass('mob-max') || 
            $('#mapNewView').hasClass('mob-min') || 
            $('#mapNewView').hasClass('mob-max') || 
            $('#mapMyView').hasClass('mob-min') || 
            $('#mapMyView').hasClass('mob-max') || 
            $('#mapFavView').hasClass('mob-min') || 
            $('#mapFavView').hasClass('mob-max') || 
            $('#mapAgentView').hasClass('mob-min') || 
            $('#mapAgentView').hasClass('mob-max') || 
            $('#mapIdxView').hasClass('mob-min') || 
            $('#mapIdxView').hasClass('mob-max') || 
            $('#content').hasClass('mob-min') || 
            $('#content').hasClass('mob-max')) {
                $('#mapView').toggleClass('mob-max');
                $('#mapSingleView').toggleClass('mob-max');
                $('#mapNewView').toggleClass('mob-max');
                $('#mapMyView').toggleClass('mob-max');
                $('#mapFavView').toggleClass('mob-max');
                $('#mapAgentView').toggleClass('mob-max');
                $('#mapIdxView').toggleClass('mob-max');
                $('#content').toggleClass('mob-min');
        } else {
            $('#mapView').toggleClass('min');
            $('#mapSingleView').toggleClass('min');
            $('#mapNewView').toggleClass('min');
            $('#mapMyView').toggleClass('min');
            $('#mapFavView').toggleClass('min');
            $('#mapAgentView').toggleClass('min');
            $('#mapIdxView').toggleClass('min');
            $('#content').toggleClass('max');
        }

        setTimeout(function() {
            var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
            var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
            var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
            $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);

            var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
            var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
            var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
            $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);

            if (map) {
                google.maps.event.trigger(map, 'resize');
            }

            if (appMap) {
                google.maps.event.trigger(appMap, 'resize');
            }

        }, 300);

    });

    // Exapnd left side navigation
    var navExpanded = false;
    $('.navHandler, .closeLeftSide').click(function() {
        if(!navExpanded) {
            $('.logo').addClass('expanded');
            $('#leftSide').addClass('expanded');
            if(windowWidth < 768) {
                $('.closeLeftSide').show();
            }
            $('.menu-item-has-children').addClass('hasSubActive');
            $('.leftNav').addClass('bigNav');
            if(windowWidth > 767) {
                $('.full').addClass('m-full');
            }
            windowResizeHandler();
            navExpanded = true;
        } else {
            $('.logo').removeClass('expanded');
            $('#leftSide').removeClass('expanded');
            $('.closeLeftSide').hide();
            $('.menu-item-has-children').removeClass('hasSubActive');
            $('.bigNav').slimScroll({ destroy: true });
            $('.leftNav').removeClass('bigNav');
            $('.leftNav').css('overflow', 'visible');
            $('.full').removeClass('m-full');
            navExpanded = false;
        }
    });

    // Expand left side sub navigation menus
    $(document).on("click", '.hasSubActive', function() {
        $(this).toggleClass('active');
        $(this).children('ul').toggleClass('bigList');
        $(this).children('a').children('.arrowRight').toggleClass('fa-angle-down');
    });

    if(isDevice) {
        $('.menu-item-has-children').click(function() {
            $('.leftNav ul li').not(this).removeClass('onTap');
            $(this).toggleClass('onTap');
        });
    }

    $('.btn').click(function() {
        if ($(this).is('[data-toggle-class]')) {
            $(this).toggleClass('active ' + $(this).attr('data-toggle-class'));
        }
    });

    var headerAvatarW = $('.headerAvatar img').width();
    var headerAvatarH = $('.headerAvatar img').height();
    if(headerAvatarW > headerAvatarH) {
        $('.headerAvatar img').height(40);
    } else {
        $('.headerAvatar img').width(40);
    }

    var mobHeaderAvatarW = $('.mobHeaderAvatar img').width();
    var mobHeaderAvatarH = $('.mobHeaderAvatar img').height();
    if(mobHeaderAvatarW > mobHeaderAvatarH) {
        $('.mobHeaderAvatar img').height(100);
    } else {
        $('.mobHeaderAvatar img').width(100);
    }

    if($('#slideshow > div').length > 1) {
        $("#slideshow > div:gt(0)").hide();

        setInterval(function() { 
            $('#slideshow > div:first')
            .fadeOut(1000)
            .next()
            .fadeIn(1000)
            .end()
            .appendTo('#slideshow');
        },  6000);
    }

    $('.top-navHandler').click(function() {
        $('.top-nav').toggleClass('active');
        $(this).toggleClass('active');
        $('.user-nav').removeClass('active');
        $('.userNavHandler').removeClass('active');
    });

    $('.userNavHandler').click(function() {
        $('.user-nav').toggleClass('active');
        $(this).toggleClass('active');
        $('.top-nav').removeClass('active');
        $('.top-navHandler').removeClass('active');
    });

    $('.userHandler').click(function() {
        $('.top-nav').removeClass('active');
        $('.top-navHandler').removeClass('active');
    });

    $('.modal-su').click(function() {
        $('#signin').modal('hide');
        $('#signup').modal('show');
    });

    $('.modal-si').click(function() {
        $('#signup').modal('hide');
        $('#signin').modal('show');
    });

    $('.modal-ca').click(function() {
        $('#contactAgent').modal('hide');
        //$('#signup').modal('show');
    });

    $('.modal-of').click(function() {
        $('#listcompany').modal('hide');
        $('#offer').modal('show');
    });

    $('.modal-lst').click(function() {
        $('#offer').modal('hide');
        $('#listcompany').modal('show');
    });

    $('.modal-qr').click(function() {
        $('#Qrequest').modal('hide');
        $('#detailed').modal('show');
    });

    $('.modal-msi').click(function() {
        $('#detailedMaterial').modal('hide');
        $('#signin').modal('show');
    });

    $('.modal-mo').click(function() {
        $('#detailedMaterial').modal('hide');
        $('#offerMaterial').modal('show');
    });

    $('.forgotPass').click(function() {
        $('#signin').modal('hide');
        $('#signup').modal('hide');
        $('#forgot').modal('show');
        $('.forgotField').show();
    });

    $('#signin').on('show.bs.modal', function () {
        $('.user-nav').removeClass('active');
        $('.userNavHandler').removeClass('active');
    });

    $('#signup').on('show.bs.modal', function () {
        $('.user-nav').removeClass('active');
        $('.userNavHandler').removeClass('active');
    });

    $('#signin').on('hidden.bs.modal', function (e) {
        $('#signinMessage').empty();
        $('#usernameSignin').val('');
        $('#passwordSignin').val('');
    });

    $('#signup').on('hidden.bs.modal', function (e) {
        $('#signupMessage').empty();
        $('#usernameSignup').val('');
        $('#firstnameSignup').val('');
        $('#lastnameSignup').val('');
        $('#emailSignup').val('');
        $('#pass1Signup').val('');
        $('#pass2Signup').val('');
    });

    $('#forgot').on('hidden.bs.modal', function (e) {
        $('#forgotMessage').empty();
        $('#emailForgot').val('');
    });

    $('#resetpass').on('hidden.bs.modal', function (e) {
        $('#resetPassMessage').empty();
        $('#resetPass_1').val('');
        $('#resetPass_2').val('');
    });

    $(".carousel-inner").swipe( {
        swipeLeft:function(event, direction, distance, duration, fingerCount) {
            $(this).parent().carousel('next'); 
        },
        swipeRight: function() {
            $(this).parent().carousel('prev');
        }
    });

    var cityOptions = {
        types : [ '(cities)' ]
    };
    if($('#search_city').length > 0) {
        var searchCity = document.getElementById('search_city');
        var searchCityAuto = new google.maps.places.Autocomplete(searchCity, cityOptions);
        google.maps.event.addListener(searchCityAuto, 'place_changed', function() {
            var place = searchCityAuto.getPlace();
            $('#search_city').blur();
            setTimeout(function() { $('#search_city').val(place.name); }, 1);

            $('#search_lat').val(place.geometry.location.lat());
            $('#search_lng').val(place.geometry.location.lng());

            return false;
        });
    }

    if($('#header').length > 0) {
        $('body').css('overflow', 'hidden');
    }

    if($('#location').length > 0) {
        var locate = document.getElementById('location');
        var locateAuto = new google.maps.places.Autocomplete(locate);
        google.maps.event.addListener(locateAuto, 'place_changed', function() {
            var place = locateAuto.getPlace();
            $('#location').blur();
            setTimeout(function() { $('#location').val(place.address_components[0].short_name); }, 1);

            return false;
        });
    }

    if($('#search_neighborhood').length > 0) {
        var neighborhood = document.getElementById('search_neighborhood');
        var neighborhoodAuto = new google.maps.places.Autocomplete(neighborhood);
        google.maps.event.addListener(neighborhoodAuto, 'place_changed', function() {
            var place = neighborhoodAuto.getPlace();
            $('#search_neighborhood').blur();
            setTimeout(function() { $('#search_neighborhood').val(place.address_components[0].short_name); }, 1);

            return false;
        });
    }

    $('#filterPropertySubmit').click(function() {
        $('#filterPropertyForm').submit();
    });

    $('.sorter li a').click(function() {
        var selected = $(this).prev().val();
        $('#sort').val(selected);
        $('#filterPropertyForm').submit();
    });

    $('.handleFilter').click(function() {
        $('.filterForm').slideToggle(200);
    });

    $('#showAdvancedFilter').click(function() {
        $('#advancedFilter').slideDown(200);
        $('#hideAdvancedFilter').addClass('display');
        $(this).removeClass('display');

        setTimeout(function() {
            var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
            var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
            var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
            $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);

            var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
            var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
            var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
            $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);

            if (map) {
                google.maps.event.trigger(map, 'resize');
            }

            if (appMap) {
                google.maps.event.trigger(appMap, 'resize');
            }
        }, 300);
    });
    $('#hideAdvancedFilter').click(function() {
        $('#advancedFilter').slideUp(200);
        $('#showAdvancedFilter').addClass('display');
        $(this).removeClass('display');
    });

    $('#advanced').click(function() {
        $('.adv').toggleClass('hidden-xs');
    });

    $('.dropdown-select li a').click(function() {
        if (!($(this).parent().hasClass('disabled'))) {
            $(this).prev().prop("checked", true);
            $(this).parent().siblings().removeClass('active');
            $(this).parent().addClass('active');
            $(this).parent().parent().siblings('.dropdown-toggle').children('.dropdown-label').html($(this).text());
        }
    });

    var ddSelect = $(".dropdown-select li input[type='radio']:checked");
    $.each(ddSelect, function(index, value) {
        $(this).parent().siblings().removeClass('active');
        $(this).parent().addClass('active');
        $(this).parent().parent().siblings('.dropdown-toggle').children('.dropdown-label').html($(this).siblings('a').text());
    });
    
    $('#searchServiceSubmit').click(function() {
        $('#searchServiceForm').submit();
    });
    
    $('#searchPropertySubmit').click(function() {
        $('#searchPropertyForm').submit();
    });
    $('#searchAgentSubmit').click(function() {
        $('#searchAgentForm').submit();
    });
    $("#search_min_price").keyup(function(e) {
        if(e.keyCode == 13) {
            $('#searchPropertyForm').submit();
        }
    });
    $("#search_max_price").keyup(function(e) {
        if(e.keyCode == 13) {
            $('#searchPropertyForm').submit();
        }
    });
    $("#search_state").keyup(function(e) {
        if(e.keyCode == 13) {
            $('#searchPropertyForm').submit();
        }
    });
    $("#search_min_area").keyup(function(e) {
        if(e.keyCode == 13) {
            $('#searchPropertyForm').submit();
        }
    });
    $("#search_max_area").keyup(function(e) {
        if(e.keyCode == 13) {
            $('#searchPropertyForm').submit();
        }
    });

    $('.leftNav ul li').each(function() {
        var lsmiClasses = $(this).attr("class").split(' ');
        if(lsmiClasses[0].indexOf('fa') == 0) {
            var iconClass = lsmiClasses[0] + ' ' + lsmiClasses[1];
            $(this).removeClass(iconClass);
            $(this).children('a').children('.navIcon').addClass(iconClass);
        } else if(lsmiClasses[0].indexOf('icon') == 0) {
            var iconClass = lsmiClasses[0];
            $(this).removeClass(iconClass);
            $(this).children('a').children('.navIcon').addClass(iconClass);
        }
    });

    var min_price = ($('#search_min_price').val() != '') ? $('#search_min_price').val() : 0;
    var max_price = ($('#search_max_price').val() != '') ? $('#search_max_price').val() : main_vars.max_price;

    $('.priceSlider').slider({
        range: true,
        min: 0,
        max: parseInt(main_vars.max_price),
        values: [parseInt(min_price), parseInt(max_price)],
        step: 100,
        slide: function(event, ui) {
            if(main_vars.currency_pos == 'before') {
                $('.priceSlider .sliderTooltip .stLabel').html(
                    main_vars.currency + ' ' + ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + 
                    ' <span class="fa fa-arrows-h"></span> ' +
                    main_vars.currency + ' ' + ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
                );
            } else {
                $('.priceSlider .sliderTooltip .stLabel').html(
                    ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' ' + main_vars.currency +
                    ' <span class="fa fa-arrows-h"></span> ' +
                    ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' ' + main_vars.currency
                );
            }
            $('#search_min_price').val(ui.values[0]);
            $('#search_max_price').val(ui.values[1]);
            var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
            var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
            var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
            $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);
        }
    });
    if(main_vars.currency_pos == 'before') {
        $('.priceSlider .sliderTooltip .stLabel').html(
            main_vars.currency + ' ' + $('.priceSlider').slider('values', 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + 
            ' <span class="fa fa-arrows-h"></span> ' +
            main_vars.currency + ' ' + $('.priceSlider').slider('values', 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
        );
    } else {
        $('.priceSlider .sliderTooltip .stLabel').html(
            $('.priceSlider').slider('values', 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' ' + main_vars.currency +
            ' <span class="fa fa-arrows-h"></span> ' +
            $('.priceSlider').slider('values', 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' ' + main_vars.currency
        );
    }
    var priceSliderRangeLeft = parseInt($('.priceSlider .ui-slider-range').css('left'));
    var priceSliderRangeWidth = $('.priceSlider .ui-slider-range').width();
    var priceSliderLeft = priceSliderRangeLeft + ( priceSliderRangeWidth / 2 ) - ( $('.priceSlider .sliderTooltip').width() / 2 );
    $('.priceSlider .sliderTooltip').css('left', priceSliderLeft);

    var min_area = ($('#search_min_area').val() != '') ? $('#search_min_area').val() : 0;
    var max_area = ($('#search_max_area').val() != '') ? $('#search_max_area').val() : main_vars.max_area;
    $('.areaSlider').slider({
        range: true,
        min: 0,
        max: parseInt(main_vars.max_area),
        values: [parseInt(min_area), parseInt(max_area)],
        step: 10,
        slide: function(event, ui) {
            $('.areaSlider .sliderTooltip .stLabel').html(
                ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' ' + main_vars.unit +
                ' <span class="fa fa-arrows-h"></span> ' +
                ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' ' + main_vars.unit
            );
            $('#search_min_area').val(ui.values[0]);
            $('#search_max_area').val(ui.values[1]);
            var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
            var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
            var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
            $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);
        }
    });
    $('.areaSlider .sliderTooltip .stLabel').html(
        $('.areaSlider').slider('values', 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' ' + main_vars.unit +
        ' <span class="fa fa-arrows-h"></span> ' +
        $('.areaSlider').slider('values', 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + ' ' + main_vars.unit
    );
    var areaSliderRangeLeft = parseInt($('.areaSlider .ui-slider-range').css('left'));
    var areaSliderRangeWidth = $('.areaSlider .ui-slider-range').width();
    var areaSliderLeft = areaSliderRangeLeft + ( areaSliderRangeWidth / 2 ) - ( $('.areaSlider .sliderTooltip').width() / 2 );
    $('.areaSlider .sliderTooltip').css('left', areaSliderLeft);

    $('.volume .btn-round-right').click(function() {
        var currentVal = parseInt($(this).siblings('input').val());
        if (currentVal < 10) {
            $(this).siblings('input').val(currentVal + 1);
        }
    });
    $('.volume .btn-round-left').click(function() {
        var currentVal = parseInt($(this).siblings('input').val());
        if (currentVal > 0) {
            $(this).siblings('input').val(currentVal - 1);
        }
    });
    $('.volume-half .btn-round-right').click(function() {
        var currentVal = parseFloat($(this).siblings('input').val());
        if (currentVal < 10) {
            $(this).siblings('input').val(currentVal + 0.5);
        }
    });
    $('.volume-half .btn-round-left').click(function() {
        var currentVal = parseFloat($(this).siblings('input').val());
        if (currentVal > 0) {
            $(this).siblings('input').val(currentVal - 0.5);
        }
    });

    $('.datePicker').datepicker();

    $('.plan').fancybox();
    $('.galleryItem').fancybox();

    if($(".dsidx-secondary-data").length > 0) {
        $(".dsidx-secondary-data div").each(function() {
            var secDataText = $(this).text().split(": ");
            if(secDataText.length > 1) {
                $(this).html('<span class="dsidx-secondary-data-item1">' + secDataText[0] + '</span><span class="dsidx-secondary-data-item2">' + secDataText[1] + '</span><div class="clearfix"></div>');
            }
        });
    }

    if($('#dsidx-actions').length > 0) {
        $('#dsidx-actions a').addClass('btn btn-sm btn-o btn-green');
        var contactAgentBtnText = $('#dsidx-button-contact-agent').text();
        $('#dsidx-button-contact-agent').html('<span class="icon-bubbles"></span> ' + contactAgentBtnText);
        var scheduleBtnText = $('#dsidx-button-schedule-showing').text();
        $('#dsidx-button-schedule-showing').html('<span class="icon-calendar"></span> ' + scheduleBtnText);
        var shareBtnText = $('#dsidx-button-share').text();
        $('#dsidx-button-share').html('<span class="icon-share"></span> ' + shareBtnText);
        var printBtnText = $('#dsidx-button-print').text();
        $('#dsidx-button-print').html('<span class="icon-printer"></span> ' + printBtnText);

        $('#dsidx-button-share').click(function() {
            var offset = $(this).offset();
            var _self = $(this);
            $('.dsidx-ui-widget.ui-widget').css({
                'top' : offset.top + 31,
                'left': offset.left
            });
            $('.dsidx-ui-widget.ui-widget button.ui-dialog-titlebar-close').addClass('icon-close');
            $('#dsidx-share table tr:nth-child(1) td a').addClass('fa fa-twitter');
            $('#dsidx-share table tr:nth-child(2) td a').addClass('fa fa-facebook');
            $('#dsidx-share table tr:nth-child(3) td a').addClass('icon-bubbles');
            $('#dsidx-share table tr:nth-child(4) td a').addClass('icon-envelope');
            $('#dsidx-share-email .dsidx-text').addClass('form-control input-sm');
            $('#dsidx-share-email textarea').addClass('form-control input-sm');
            $('#dsidx-share-form-submit').removeClass('dsidx-submit').addClass('btn btn-green btn-sm');
            $('.dsidx-cancel').addClass('btn btn-gray btn-sm');
        });

        $('#dsidx-button-contact-agent, #dsidx-button-schedule-showing').click(function() {
            $('#content').animate({
                scrollTop: parseInt($('#dsidx-contact-form-header').offset().top) - 120
            }, 1000);
        });

        $('#dsidx-map').prev().hide();
        $('#dsidx-contact-form input[type="text"]').addClass('form-control');
        $('#dsidx-contact-form textarea').addClass('form-control');

        $('#dsidx-contact-form-submit').addClass('btn btn-green');
    } else {
        $('.idx-filter').show();
    }

    if($('.dsidx-resp-area').length > 0) {
        $('.dsidx-resp-area select').addClass('form-control');
        $('.dsidx-resp-area input[type="text"]').addClass('form-control');
        $('.dsidx-resp-area input[type="submit"]').addClass('btn btn-green');
    }

    if($('div.dsidx-results-widget').length > 0) {
        $('div.dsidx-results-widget .dsidx-controls a').addClass('btn btn-green btn-o');
    }

    if($('.search-panel').length > 0) {
        $('#dsidx-resp-location').attr('placeholder', main_vars.idx_search_location);
        $('#dsidx-resp-area-type option:first-child').text(main_vars.idx_search_category);
        $('#idx-q-PriceMin').attr('placeholder', main_vars.idx_search_price_min);
        $('#idx-q-PriceMax').attr('placeholder', main_vars.idx_search_price_max);
        $('#idx-q-BedsMin option:first-child').text(main_vars.idx_search_beds);
        $('#idx-q-BathsMin option:first-child').text(main_vars.idx_search_baths);
        $('#dsidx-resp-area-type, #idx-q-BedsMin, #idx-q-BathsMin, #idx-q-PriceMin, #idx-q-PriceMax').addClass('hidden-xs');
        $('.dsidx-resp-area-submit').append('<a href="javascript:void(0);" class="btn btn-o btn-white pull-right visible-xs" id="idx-advanced">' + main_vars.idx_advanced_search + ' <span class="fa fa-angle-up"></span></a>');
        $('.dsidx-resp-search-box').show();
        $('#idx-advanced').click(function() {
            $('#dsidx-resp-area-type').toggleClass('hidden-xs');
            $('#idx-q-BedsMin').toggleClass('hidden-xs');
            $('#idx-q-BathsMin').toggleClass('hidden-xs');
            $('#idx-q-PriceMin').toggleClass('hidden-xs');
            $('#idx-q-PriceMax').toggleClass('hidden-xs');
        });
    }

    if($('.idx-filter').length > 0 ) {
        $('.dsidx-resp-area:not(.dsidx-resp-area-submit)').removeClass('dsidx-resp-area-right').removeClass('dsidx-resp-area-left').addClass('dsidx-resp-area-half');
        $('#idx-q-Communities, #idx-q-TractIdentifiers, #idx-q-ZipCodes, #idx-q-MlsNumbers, #idx-q-BedsMin, #idx-q-BathsMin, #idx-q-ImprovedSqFtMin').parent().addClass('hidden');
        $('.dsidx-resp-area-submit').append('<a href="javascript:void(0);" class="btn btn-gray" id="showIDXAdvanced"><span>' + main_vars.idx_advanced_filter + '</span><span class="hidden">' + main_vars.idx_advanced_filter_hide + '</span></a>');

        $('#showIDXAdvanced').click(function() {
            $('#idx-q-Communities, #idx-q-TractIdentifiers, #idx-q-ZipCodes, #idx-q-MlsNumbers, #idx-q-BedsMin, #idx-q-BathsMin, #idx-q-ImprovedSqFtMin').parent().toggleClass('hidden');
            $(this).children('span').toggleClass('hidden');
        });
    }

    $('#textrequest').on('hidden.bs.modal', function (e) {
        $('#modalsubmitRequest').html('Send Request').removeClass('disabled');
        $('#requestMessage').empty();
        $('#nameRequest').val('');
        $('#numberRequest').val('');
        $('#msgRequest').val('');
        $('#agents_call_me').empty();
    });


        //jQuery time
        var current_fs, next_fs, previous_fs; //fieldsets
        var left, opacity, scale; //fieldset properties which we will animate
        var animating; //flag to prevent quick multi-click glitches

        $(".next").click(function(){
            if(animating) return false;
            animating = true;
            
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            
            //activate next step on progressbar using the index of next_fs
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            
            //show the next fieldset
            next_fs.show(); 
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50)+"%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'transform': 'scale('+scale+')'});
                    next_fs.css({'left': left, 'opacity': opacity});
                }, 
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });

        $(".previous").click(function(){
            if(animating) return false;
            animating = true;
            
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            
            //de-activate current step on progressbar
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            
            //show the previous fieldset
            previous_fs.show(); 
            //hide the current fieldset with style
            current_fs.animate({opacity: 0}, {
                step: function(now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale previous_fs from 80% to 100%
                    scale = 0.8 + (1 - now) * 0.2;
                    //2. take current_fs to the right(50%) - from 0%
                    left = ((1-now) * 50)+"%";
                    //3. increase opacity of previous_fs to 1 as it moves in
                    opacity = 1 - now;
                    current_fs.css({'left': left});
                    previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                }, 
                duration: 800, 
                complete: function(){
                    current_fs.hide();
                    animating = false;
                }, 
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        });



(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6&appId=1534791290160125";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '{1534791290160125}',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }


  /**
  * Ratings Star
  */
  ReviewItem = Views.PostItem.extend({
                template: _.template($('#de-review-item').html()),
                // class name define column 
                className: 'col-md-4 col-sm-6 review-item',
                onItemRendered: function() {
                    var view = this;
                    this.$('.rate-it').raty({
                        half: true,
                        score: view.model.get('et_rate'),
                        readOnly: true,
                        hints: raty.hint
                    });
                }
            });

            ListReview = Views.ListPost.extend({
                tagName: 'ul',
                itemView: PostItem,
                itemClass: 'review-item'
            });


            $('.rating-it').raty({
                half: true,
                hints: raty.hint
            });

})(jQuery);