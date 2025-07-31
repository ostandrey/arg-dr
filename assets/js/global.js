/**
 * Modern JavaScript for WordPress Theme
 * Handles UI interactions, sliders, AJAX functionality, and accessibility
 */

(function($) {
    'use strict';

    // Accessibility: Tab navigation handling
    const handleAccessibility = () => {
        const handleFirstTab = (e) => {
            const key = e.key || e.keyCode;
            if (key === 'Tab' || key === '9') {
                document.body.classList.remove('no-outline');
                window.removeEventListener('keydown', handleFirstTab);
                window.addEventListener('mousedown', handleMouseDownOnce);
            }
        };

        const handleMouseDownOnce = () => {
            document.body.classList.add('no-outline');
            window.removeEventListener('mousedown', handleMouseDownOnce);
            window.addEventListener('keydown', handleFirstTab);
        };

        window.addEventListener('keydown', handleFirstTab);
    };

    // Video background resizing
    const resizeVideo = () => {
        $('.videoHolder').each(function() {
            const $holder = $(this);
            const ratio = $holder.data('ratio') || '16:9';
            const [width, height] = ratio.split(':').map(parseFloat);

            $holder.find('.video').each(function() {
                const $video = $(this);
                if ($holder.width() / width > $holder.height() / height) {
                    $video.css({ width: '100%', height: 'auto' });
                } else {
                    $video.css({
                        width: $holder.height() * width / height,
                        height: '100%'
                    });
                }
            });
        });
    };

    // Utility: Debounce function
    const debounce = (callback, delay) => {
        let timeoutId;
        return (...args) => {
            clearTimeout(timeoutId);
            timeoutId = setTimeout(() => callback.apply(this, args), delay);
        };
    };

    // Hero tabs functionality
    const initHeroTabs = () => {
        $('.hero__tab').on('click', function(e) {
            e.preventDefault();

            const tabIndex = $(this).data('tab-index');

            // Update active states
            $('.hero__tab').removeClass('active');
            $(this).addClass('active');

            $('.tab-pane').removeClass('show active');
            $(`#hero-tab-pane-${tabIndex}`).addClass('show active');

            $('.hero__img').removeClass('active');
            $(`.hero__img[data-tab-img="${tabIndex}"]`).addClass('active');
        });
    };

    // Portfolio load more functionality
    const initPortfolioLoadMore = () => {
        const items = $('.portfolio__item');
        const numToShow = 9;
        const numToAdd = 3;
        const button = $('#load-more-btn');
        const numInList = items.length;

        items.hide();

        if (numInList > numToShow) {
            button.show();
        }

        items.slice(0, numToShow).show();

        button.on('click', function(e) {
            e.preventDefault();

            const showing = items.filter(':visible').length;
            items.slice(showing, showing + numToAdd).fadeIn();

            const nowShowing = items.filter(':visible').length;
            if (nowShowing >= numInList) {
                button.hide();
            }
        });
    };

    // Header search toggle
    const initHeaderSearch = () => {
        const searchButton = document.querySelector('.header__search-button');
        const searchLabel = document.querySelector('.header__search label');

        if (searchButton && searchLabel) {
            searchButton.addEventListener('click', () => {
                searchLabel.classList.toggle('active');
            });
        }
    };

    // FAQ accordion
    const initFAQ = () => {
        $('.faq-list__question').on('click', function() {
            const $item = $(this).parent();
            const isActive = $item.hasClass('active');

            // Close all items
            $('.faq-list__item').removeClass('active');
            $('.faq-list__answer').slideUp(300);

            // Open clicked item if it was closed
            if (!isActive) {
                $item.addClass('active');
                $item.find('.faq-list__answer').slideDown(300);
            }
        });
    };

    // Drone hero slider
    const initDroneHeroSlider = () => {
        if (!$('.drone-hero__slider').length) return;

        $('.drone-hero__slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
            infinite: true,
            speed: 300,
            adaptiveHeight: true,
            prevArrow: `
                <button type="button" class="drone-hero__slider-arrow drone-hero__slider-arrow--prev">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 19L8 12L15 5" stroke="#A1A0A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            `,
            nextArrow: `
                <button type="button" class="drone-hero__slider-arrow drone-hero__slider-arrow--next">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 5L16 12L9 19" stroke="#A1A0A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            `,
            dotsClass: 'drone-hero__slider-nav',
            customPaging: () => '<div class="drone-hero__slider-dot"></div>'
        });

        $('.drone-hero__slider').on('afterChange', (event, slick, currentSlide) => {
            $('.drone-hero__slider-dot').removeClass('drone-hero__slider-dot--active');
            $('.drone-hero__slider-dot').eq(currentSlide).addClass('drone-hero__slider-dot--active');
        });

        $('.drone-hero__slider-dot').first().addClass('drone-hero__slider-dot--active');
    };

    // Initialize all sliders
    const initSliders = () => {
        // Logos slider
        $('.logos-slider').slick({
            dots: false,
            infinite: true,
            speed: 500,
            slidesToShow: 5,
            slidesToScroll: 5,
            arrows: true,
            responsive: [
                {
                    breakpoint: 1525,
                    settings: { slidesToShow: 3, slidesToScroll: 3 }
                },
                {
                    breakpoint: 1080,
                    settings: { slidesToShow: 2, slidesToScroll: 2 }
                },
                {
                    breakpoint: 800,
                    settings: { slidesToShow: 1, slidesToScroll: 1 }
                }
            ]
        });

        // Reviews slider
        $('.reviews__list').slick({
            dots: false,
            infinite: true,
            speed: 500,
            autoplay: false,
            autoplaySpeed: 3000,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            adaptiveHeight: true
        });

        // Specialties gallery slider
        $('.specialties-gallery__list').slick({
            dots: false,
            infinite: true,
            speed: 500,
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: true,
            responsive: [
                {
                    breakpoint: 992,
                    settings: { slidesToShow: 3, slidesToScroll: 1 }
                },
                {
                    breakpoint: 756,
                    settings: { slidesToShow: 1, slidesToScroll: 1 }
                }
            ]
        });

        // Drones slider with delay
        setTimeout(() => {
            $('.drones-slider').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                arrows: true,
                prevArrow: $('.drones-slider-prev'),
                nextArrow: $('.drones-slider-next'),
                dots: false,
                infinite: false,
                speed: 500,
                cssEase: 'ease',
                variableWidth: false,
                centerMode: false,
                adaptiveHeight: true,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: { slidesToShow: 2 }
                    },
                    {
                        breakpoint: 768,
                        settings: { slidesToShow: 1 }
                    }
                ]
            });

            $('.drones-slider').slick('setPosition');
            console.log('Drones slider initialized');
        }, 500);

        // Services reviews slider
        $('.services-reviews__slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            adaptiveHeight: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
            responsive: [
                {
                    breakpoint: 992,
                    settings: { arrows: false }
                }
            ]
        });
    };


    let reviewsSlider = $('.client-reviews__slider');

    function initReviewsSlider() {
        if (reviewsSlider.hasClass('slick-initialized')) {
            reviewsSlider.slick('unslick');
        }

        reviewsSlider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            infinite: true,
            speed: 500,
            cssEase: 'ease',
            autoplay: true,
            autoplaySpeed: 5000,
            adaptiveHeight: false,
            variableWidth: false,
            centerMode: false,
            prevArrow: '<button type="button" class="slick-prev" aria-label="Previous slide"></button>',
            nextArrow: '<button type="button" class="slick-next" aria-label="Next slide"></button>',
            responsive: [
                {
                    breakpoint: 801,
                    settings: {
                        arrows: false,
                        dots: false,
                        autoplay: false,
                        swipe: true,
                        touchMove: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        variableWidth: false,
                        centerMode: false,
                        adaptiveHeight: true
                    }
                }
            ]
        });
    }

    initReviewsSlider();

    let resizeTimer;
    $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            initReviewsSlider();
        }, 250);
    });

    // Service card smooth scroll
    const initServiceCardScroll = () => {
        $('.service-card__btn').on('click', function(e) {
            e.preventDefault();

            const target = $(this).attr('href');

            $('html, body').animate({
                scrollTop: $(target).offset().top - 50
            }, 800);
        });
    };

    // Initialize Fancybox
    const initFancybox = () => {
        if (!$.fancybox) return;

        // Media reviews gallery
        $('.media-reviews__gallery')
            .find('a[href$="jpg"], a[href$="png"], a[href$="gif"]')
            .attr('rel', 'media-reviews')
            .attr('data-fancybox', 'media-reviews');

        $('a[data-fancybox="media-reviews"]').fancybox({
            minHeight: 0,
            helpers: {
                overlay: { locked: false }
            }
        });

        // Video links
        $('a.media-reviews__link--video').fancybox({
            type: 'iframe',
            minHeight: 0,
            helpers: {
                overlay: { locked: false }
            },
            iframe: { preload: false }
        });

        // General gallery
        $('.gallery-item')
            .find('a[href$="jpg"], a[href$="png"], a[href$="gif"]')
            .attr('rel', 'gallery')
            .attr('data-fancybox', 'gallery');

        $('a[rel*="album"], .fancybox, a[href$="jpg"], a[href$="png"], a[href$="gif"]').fancybox({
            minHeight: 0,
            helpers: {
                overlay: { locked: false }
            }
        });
    };

    // Form validation
    const initFormValidation = () => {
        $('#serviceForm').on('submit', function(e) {
            let isValid = true;

            $(this).find('[required]').each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!isValid) {
                e.preventDefault();

                const firstInvalid = $(this).find('.is-invalid:first');
                if (firstInvalid.length) {
                    $('html, body').animate({
                        scrollTop: firstInvalid.offset().top - 100
                    }, 500);
                }
            }
        });

        $('#serviceForm').find('input, select, textarea').on('change', function() {
            if ($(this).val()) {
                $(this).removeClass('is-invalid');
            }
        });
    };

    // Toggle extended content
    const initToggleContent = () => {
        document.querySelectorAll('.toggle-extended-content').forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-target');
                const extendedContent = document.querySelector(targetId);

                if (extendedContent.style.display === 'none') {
                    extendedContent.style.display = 'block';
                    button.classList.remove('reviews__button--plus');
                } else {
                    extendedContent.style.display = 'none';
                    button.classList.add('reviews__button--plus');
                }
            });
        });
    };

    // Initialize LazyLoad
    const initLazyLoad = () => {
        const lazyLoadInstance = new LazyLoad({
            elements_selector: 'img[data-lazy-src],.pre-lazyload',
            data_src: "lazy-src",
            data_srcset: "lazy-srcset",
            data_sizes: "lazy-sizes",
            skip_invisible: false,
            class_loading: "lazyloading",
            class_loaded: "lazyloaded",
        });

        // Update LazyLoad on DOM mutations
        window.addEventListener('LazyLoad::Initialized', () => {
            if (window.MutationObserver) {
                const observer = new MutationObserver(mutations => {
                    mutations.forEach(mutation => {
                        mutation.addedNodes.forEach(node => {
                            if (typeof node.getElementsByTagName !== 'function') return;

                            const imgs = node.getElementsByTagName('img');
                            if (imgs.length > 0) {
                                lazyLoadInstance.update();
                            }
                        });
                    });
                });

                observer.observe(document.body, { childList: true, subtree: true });
            }
        }, false);

        // Update before slider change
        $('.slick-slider').on('beforeChange', () => {
            lazyLoadInstance.update();
        });

        return lazyLoadInstance;
    };

    // Initialize ScrollOut
    const initScrollOut = () => {
        return ScrollOut({
            offset: () => window.innerHeight - 200,
            once: true,
            onShown: element => {
                if ($(element).is('.ease-order')) {
                    $(element).find('.ease-order__item').each(function(i) {
                        const $this = $(this);
                        $(this).attr('data-scroll', '');
                        setTimeout(() => {
                            $this.attr('data-scroll', 'in');
                        }, 300 * i);
                    });
                }
            }
        });
    };

    // Initialize placeholder handling
    const initPlaceholders = () => {
        $('input, textarea').each(function() {
            const $input = $(this);
            $input.data('holder', $input.attr('placeholder'));

            $input.on('focusin', function() {
                $(this).attr('placeholder', '');
            });

            $input.on('focusout', function() {
                $(this).attr('placeholder', $(this).data('holder'));
            });
        });
    };

    // Gravity Forms handling
    const initGravityForms = () => {
        // Scroll to confirmation message
        $(document).on('gform_confirmation_loaded', (event, formId) => {
            const $target = $(`#gform_confirmation_wrapper_${formId}`);
            if ($target.length) {
                $('html, body').animate({
                    scrollTop: $target.offset().top - 300,
                }, 500);
            }
        });

        // Hide validation messages on input
        $('body').on('change keyup', '.gfield input, .gfield textarea, .gfield select', function() {
            const $field = $(this).closest('.gfield');
            if ($field.hasClass('gfield_error')) {
                if ($(this).val().length) {
                    $field.find('.validation_message').hide();
                } else {
                    $field.find('.validation_message').show();
                }
            }
        });
    };

    // Drone filters AJAX functionality
    const initDroneFilters = () => {
        // Проверяем наличие ajax_object
        if (typeof ajax_object === 'undefined') {
            console.error('ajax_object is not defined');
            return;
        }

        // Load drone by filter via AJAX
        const loadDroneByFilter = (section, parent, subcat, $button) => {
            const showcaseId = section === 'size' ? '#size-showcase' : '#task-showcase';
            const taxonomy = section === 'size' ? 'drone_size' : 'drone_task_type';

            $.ajax({
                url: ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'load_drone_by_category',
                    parent_slug: parent,
                    subcat_slug: subcat,
                    taxonomy: taxonomy,
                    nonce: ajax_object.nonce
                },
                beforeSend: () => {
                    $(showcaseId).addClass('loading').css('opacity', '0.5');

                },
                success: response => {
                    if (response.success) {
                        $(showcaseId).html(response.data.html)
                            .removeClass('loading')
                            .css('opacity', '1');
                    } else {
                        console.error('AJAX response error:', response.data);
                        $(showcaseId).removeClass('loading').css('opacity', '1');
                        // Show error message to user
                        $(showcaseId).html('<p class="error-message">No drone found for the selected category.</p>');
                    }
                },
                error: (xhr, status, error) => {
                    console.error('AJAX error:', error);
                    console.error('Status:', status);
                    console.error('Response:', xhr.responseText);
                    $(showcaseId).removeClass('loading').css('opacity', '1');
                    // Show error message to user
                    $(showcaseId).html('<p class="error-message">Error loading drone data. Please try again.</p>');
                },
                complete: () => {
                    $(showcaseId).removeClass('loading').css('opacity', '1');

                    $button.removeClass('loading disabled').addClass('active');
                }
            });
        };

        // Update URL without page reload
        const updateURL = (section, parent, subcat) => {
            const urlParams = new URLSearchParams(window.location.search);

            if (section === 'size') {
                urlParams.set('size', parent);
                urlParams.set('size_subcat', subcat);
            } else if (section === 'task') {
                urlParams.set('task', parent);
                urlParams.set('task_subcat', subcat);
            }

            const newURL = window.location.pathname + '?' + urlParams.toString();
            window.history.pushState({}, '', newURL);
        };

        // Filter button click handler
        $('.filter-button').on('click', function(e) {
            e.preventDefault();

            const $this = $(this);
            const section = $this.data('section');
            const parent = $this.data('parent');
            const subcat = $this.data('subcat');

            if ($this.hasClass('active')) {
                console.log('Button already active, skipping');
                return;
            }

            // Remove active class from buttons in the same section
            if (section === 'size') {
                $('.drones-by-size .filter-button').removeClass('active loading disabled');
            } else if (section === 'task') {
                $('.drones-by-task .filter-button').removeClass('active loading disabled');
            }

            // Add active class to current button immediately
            $this.addClass('active').removeClass('loading disabled');

            // Load drone via AJAX
            loadDroneByFilter(section, parent, subcat, $this);

            // Update URL
            updateURL(section, parent, subcat);
        });

        $(document).ready(() => {
            $('.filter-button').removeClass('loading disabled');
            $('.drone-showcase').removeClass('loading').css('opacity', '1');
        });
    };

    // Initialize ACF Maps
    const initACFMaps = () => {
        $('.acf-map').each(function() {
            renderMap($(this));
        });
    };

    // Mobile menu functionality
    const initMobileMenu = () => {
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', function() {
                this.classList.toggle('active');
                mobileMenu.classList.toggle('active');
            });

            const mobileMenuLinks = mobileMenu.querySelectorAll('a');
            mobileMenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenuToggle.classList.remove('active');
                    mobileMenu.classList.remove('active');
                });
            });

            document.addEventListener('click', function(e) {
                if (!mobileMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                    mobileMenuToggle.classList.remove('active');
                    mobileMenu.classList.remove('active');
                }
            });
        }
    };


// Language modal functionality
    const initLanguageModal = () => {
        const langTrigger = document.getElementById('langTrigger');
        const langModal = document.getElementById('langModal');

        if (!langTrigger || !langModal) return;

        let overlay = document.getElementById('langOverlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'lang-overlay';
            overlay.id = 'langOverlay';
            document.body.appendChild(overlay);
        }

        const openModal = () => {
            langModal.classList.add('active');
            langTrigger.classList.add('active');
            overlay.classList.add('active');
        };

        const closeModal = () => {
            langModal.classList.remove('active');
            langTrigger.classList.remove('active');
            overlay.classList.remove('active');
        };

        langTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            if (langModal.classList.contains('active')) {
                closeModal();
            } else {
                openModal();
            }
        });

        overlay.addEventListener('click', closeModal);

        document.addEventListener('click', (e) => {
            if (!langTrigger.contains(e.target) && !langModal.contains(e.target)) {
                closeModal();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && langModal.classList.contains('active')) {
                closeModal();
            }
        });

        langModal.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    };

    document.addEventListener('DOMContentLoaded', initLanguageModal);

    // Fixed header on scroll
    const initFixedHeader = () => {
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('fixed-header');
            } else {
                header.classList.remove('fixed-header');
            }
        });
    };

    // Google Maps functions
    const renderMap = ($el) => {
        const $markers = $el.find('.marker');
        const args = {
            zoom: 16,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
        };

        const map = new google.maps.Map($el[0], args);
        map.markers = [];

        $markers.each(function() {
            addMarker($(this), map);
        });

        centerMap(map);
    };

    let infowindow;

    const addMarker = ($marker, map) => {
        const latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));

        const marker = new google.maps.Marker({
            position: latlng,
            map: map,
        });

        map.markers.push(marker);

        if ($.trim($marker.html())) {
            infowindow = new google.maps.InfoWindow();

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.close();
                infowindow.setContent($marker.html());
                infowindow.open(map, marker);
            });
        }
    };

    const centerMap = (map) => {
        const bounds = new google.maps.LatLngBounds();

        $.each(map.markers, function(i, marker) {
            const latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(latlng);
        });

        if (map.markers.length === 1) {
            map.setCenter(bounds.getCenter());
        } else {
            map.fitBounds(bounds);
        }
    };

    // Initialize responsive reviews slider
    const initResponsiveReviewsSlider = () => {
        const $slider = $('.client-reviews__slider');

        const initSlider = () => {
            if ($(window).width() <= 767) {
                if ($slider.hasClass('slick-initialized')) {
                    $slider.slick('unslick');
                }
                $slider.addClass('mobile-scroll');
            } else {
                $slider.removeClass('mobile-scroll');

                if (!$slider.hasClass('slick-initialized')) {
                    $slider.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: false,
                        infinite: true,
                        autoplay: false,
                        responsive: [
                            {
                                breakpoint: 575,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            }
                        ]
                    });
                }
            }
        };

        initSlider();
        $(window).on('resize', debounce(initSlider, 200));
    };

    // Main initialization
    let scrollOut;

    $(document).ready(function() {
        // Initialize accessibility
        handleAccessibility();

        // Initialize all components
        initHeroTabs();
        initPortfolioLoadMore();
        initHeaderSearch();
        initFAQ();
        initDroneHeroSlider();
        initSliders();
        initServiceCardScroll();
        initFancybox();
        initFormValidation();
        initToggleContent();
        initLazyLoad();
        scrollOut = initScrollOut();
        initPlaceholders();
        initGravityForms();
        initDroneFilters();
        initACFMaps();
        initMobileMenu();
        initFixedHeader();
        initResponsiveReviewsSlider();

        // Initialize object-fit polyfill for IE
        if ($('.of-cover, .stretched-img').length) {
            objectFitImages('.of-cover, .stretched-img');
        }

        // Initialize match height
        $('.matchHeight').matchHeight();

        // Resize video backgrounds
        resizeVideo();

        // Close responsive menu on orientation change
        $(window).on('orientationchange', () => {
            $('#main-menu').dropdown('hide');
        });
    });

    // Window load events
    $(window).on('load', function() {
        if (typeof scrollOut !== 'undefined' && typeof scrollOut.update === 'function') {
            scrollOut.update();
        }

        if ($('.preloader').length) {
            $('.preloader').addClass('preloader--hidden');
        }

        setTimeout(() => {
            const careersWorkList = $('.careers__work a');
            careersWorkList.each(function() {
                $(this).attr('target', '_blank');
            });
        }, 700);
    });

    // Window resize events
    const resizeVideoCallback = debounce(resizeVideo, 200);
    const closeMenuCallback = debounce(() => {
        $('#main-menu').dropdown('hide');
    }, 200);

    $(window).on('resize', function() {
        resizeVideoCallback();

        // Close responsive menu on breakpoint pass
        const $navBar = $('.header').find('.navbar');
        if ($navBar.length) {
            const classes = $.grep($navBar[0].className.split(' '), (v) => {
                return v.indexOf('navbar-expand') !== -1;
            }).join();

            if (classes.length) {
                const menuBreakpoint = classes.replace('navbar-expand-', '');
                const breakpointWidth = getComputedStyle(document.body)
                    .getPropertyValue(`--breakpoint-${menuBreakpoint}`)
                    .replace(/\D/g, '');

                if ((window.innerWidth > breakpointWidth) &&
                    ($navBar.find('.dropdown-menu').hasClass('show') || $('#main-menu').hasClass('show'))) {
                    closeMenuCallback();
                }
            }
        }
    });

}(jQuery));

document.addEventListener('DOMContentLoaded', function() {

    const setupForm = (formId) => {
        const form = document.querySelector(`#gform_${formId}`);
        if (!form || form.querySelector('.gform_column')) return;

        const fieldsContainer = form.querySelector('.gform_fields');
        const formBody = form.querySelector('.gform_body');
        const fields = fieldsContainer?.querySelectorAll('.gfield');

        if (!fieldsContainer || !formBody || !fields?.length) return;

        const leftColumn = document.createElement('div');
        leftColumn.className = 'gform_column left-column';

        const rightColumn = document.createElement('div');
        rightColumn.className = 'gform_column right-column';

        fields.forEach((field, index) => {
            const target = index < 4 ? leftColumn : rightColumn;
            target.appendChild(field.cloneNode(true));
        });

        fieldsContainer.innerHTML = '';
        formBody.innerHTML = '';
        formBody.appendChild(leftColumn);
        formBody.appendChild(rightColumn);

        const footer = form.querySelector('.gform_footer');
        if (footer) rightColumn.appendChild(footer);

        console.log(`Form ${formId} configured`);
    };

    const setupAllForms = () => {
        ['1', '2', '4', '5'].forEach(setupForm);
    };

    setTimeout(setupAllForms, 500);

    if (typeof gform !== 'undefined') {
        gform.addAction('gform_post_render', () => {
            setTimeout(setupAllForms, 100);
        });
    }

    new MutationObserver((mutations) => {
        const hasNewForm = mutations.some(m =>
            Array.from(m.addedNodes).some(n =>
                n.nodeType === 1 &&
                (n.classList?.contains('gform_wrapper') || n.querySelector?.('.gform_wrapper'))
            )
        );
        if (hasNewForm) setTimeout(setupAllForms, 100);
    }).observe(document.body, { childList: true, subtree: true });
});


/**
 * Table of Contents Generator
 */
const generateTableOfContents = () => {
    const tocContainer = document.getElementById('toc-container');
    if (!tocContainer) return;

    const headings = document.querySelectorAll('.blog-single__content h2, .blog-single__content h3, .blog-single__content h4, .blog-single__content h5, .blog-single__content h6');
    if (headings.length === 0) return;

    const tocTitle = document.createElement('div');
    tocTitle.className = 'blog-single__toc-title';
    tocTitle.textContent = 'Table of Contents:';
    tocContainer.appendChild(tocTitle);

    const toc = document.createElement('ul');
    toc.className = 'blog-single__toc-list';

    headings.forEach((heading, index) => {
        // Add ID to heading if it doesn't have one
        if (!heading.id) {
            heading.id = `heading-${index}`;
        }

        const listItem = document.createElement('li');
        listItem.className = 'blog-single__toc-item';

        const link = document.createElement('a');
        link.href = `#${heading.id}`;
        link.textContent = heading.textContent;
        link.className = 'blog-single__toc-link';

        listItem.appendChild(link);
        toc.appendChild(listItem);
    });

    tocContainer.appendChild(toc);
};

/**
 * Toast Notifications
 */
const showToast = (message, type = 'success') => {
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;

    const icon = type === 'success' ? '✓' : '✕';

    toast.innerHTML = `
        <span class="toast-icon">${icon}</span>
        <span class="toast-message">${message}</span>
        <button class="toast-close" onclick="closeToast(this)">×</button>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('show');
    }, 100);

    setTimeout(() => {
        closeToast(toast.querySelector('.toast-close'));
    }, 5000);
};

const closeToast = (button) => {
    const toast = button.closest('.toast');
    toast.classList.remove('show');
    setTimeout(() => {
        toast.remove();
    }, 300);
};

/**
 * Enhanced Gravity Forms handling
 */
jQuery(document).ready(function($) {
    $(document).on('gform_confirmation_loaded', function(event, formId) {
        const confirmationMessage = $('.gform-confirmation-message').data('message');

        if (confirmationMessage) {
            showToast(confirmationMessage, 'success');
        }

        setTimeout(() => {
            $(`#gform_confirmation_wrapper_${formId}`).hide();
            $(`#gform_wrapper_${formId}`).show();
            $(`#gform_${formId}`).show();
            $(`#gform_${formId}`)[0].reset();
            $(`#gform_${formId} .gfield_error`).removeClass('gfield_error');
            $(`#gform_${formId} .validation_message`).remove();
        }, 100);
    });
});

/**
 * Filter button scroll handling
 */
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-button');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            this.classList.add('loading');

            const isTaskSection = this.closest('.drones-by-task');
            const isSizeSection = this.closest('.drones-by-size');

            if (isTaskSection) {
                sessionStorage.setItem('scrollToSection', 'task-showcase');
            } else if (isSizeSection) {
                sessionStorage.setItem('scrollToSection', 'size-showcase');
            }
        });
    });

    const scrollToSection = sessionStorage.getItem('scrollToSection');
    if (scrollToSection) {
        const targetElement = document.getElementById(scrollToSection);
        if (targetElement) {
            setTimeout(() => {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }, 500);
        }
        sessionStorage.removeItem('scrollToSection');
    }
});

// Run table of contents generator when DOM is loaded
document.addEventListener('DOMContentLoaded', generateTableOfContents);

