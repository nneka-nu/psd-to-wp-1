jQuery(document).ready(function($) {
  // Flexlider settings for testimonials
  $('.flexslider').flexslider({
    controlNav: false,
    slideshowSpeed: 8000,
    customDirectionNav: $('.custom-nav a')
  });

  // Add class to homepage menu only
  $('.home li.contact-link').last().find('a').addClass('js-scroll');
  $('.home li.works-link').last().find('a').addClass('js-scroll');

  // Scroll to page sections
  $('.js-scroll').on('click', function(evt) {
    evt.preventDefault();
    var theHash = this.hash;

    if (theHash === '#contact' || theHash === '#works') {
      $('body').removeClass('js-overlay');
      $('.nav-overlay').addClass('js-hide').removeClass('js-show');
    }

    $('html, body').animate({
      scrollTop: $(theHash).offset().top
    }, 800);
  });

  // Slide main menu on menu bars click
  $('.js-menu').on('click', '.fa-bars', function() {
    $('.nav-overlay').addClass('js-show').removeClass('js-hide');
    $('body').addClass('js-overlay');
  });

  $('.js-menu-close').on('click', function(evt) {
    evt.preventDefault();
    $('.nav-overlay').addClass('js-hide').removeClass('js-show');
    $('body').removeClass('js-overlay');
  });

  // Show more works
  $currentPage = 3;
  $('.js-more').on('click', function(evt) {
    evt.preventDefault();
    $(this).text('Loading...');

    $.ajax({
      method: 'GET',
      url: 'wp-json/wp/v2/portfolio?per_page=3&page=' + $currentPage + '&order=asc'
    })
    .done(function(data) {
      var html = '';
      for(var i = 0; i < data.length; i++) {
        html += 
        '<div class="works__img__wrap">' +
            '<img src="' + data[i].img + '" alt="Photo" width="360" height="360">' +
            '<div class="works__overlay">' +
              '<h2 class="works__overlay__heading">' + data[i].title.rendered + '</h2>' +
              '<p class="works__overlay__excerpt">' + data[i].desc + '</p>' +
              '<div class="works__overlay__button"><a href="' + data[i].link + '" class="btn">Show Project</a></div>' +
            '</div>' +
        '</div>';
      }

      $('.js-works-grid').append(html);
      $('.js-more').text('Show More');
    })
    .fail(function(errorObj) {
      var msg = JSON.parse(errorObj.responseText);

      if (msg.code === 'rest_post_invalid_page_number') {
        $('.js-more').css('visibility', 'hidden');
        return;
      }

      console.log('There was an error with your request', errorObj);
    });

    $currentPage++;
  });

  // Team slideshow
  var slideInterval;
  var slideTimer;
  var classes = [
    ['semi-active', 'active', 'inactive', 'inactive'],
    ['inactive', 'semi-active', 'active', 'inactive'],
    ['inactive', 'inactive', 'semi-active', 'active'],
    ['active','inactive', 'inactive', 'semi-active']
  ]; // element clases for each team bio

  // Stop slideshow when device width is less than 700px
  if ($('.team').outerWidth() > 720) {
    startSlideShow();

    // Set active team member on hover
    $('.team__bio').on('mouseenter', function() {
      setActiveBio($(this).index())
    })
    .on('mouseleave', function() {
      startSlideShow();
    });


    // Set active team member on team navigation click
    $('.team__nav').on('click', 'a', function(evt) {
      evt.preventDefault();
      clearTimeout(slideTimer);
      setActiveBio($(this).index())
      slideTimer = setTimeout(startSlideShow, 3000);
    });
  } else {
    $('.team__nav').hide();
    $('.team__bio').removeClass('active inactive semi-active');
    $('.team__bio__social').addClass('small-device');
    $('.team__bio').css('float', 'none');
    $('.team__bio').css('width', 'auto');
    $('.team__bio').css('filter', 'none');
    $('.team__bio').css('margin-bottom', '20px');
    $('.team__container').addClass('small-device');
    $('.team__container').css('min-height', 'auto');
    $('.team__container__inner').css('position', 'static');
  }

  function startSlideShow() {
    slideInterval = setInterval(slideTeam, 5000);
  }

  function slideTeam() {
    var activeIndex = $('.team__bio.active').index();
    setTeamClasses(activeIndex);
  }

  function setActiveBio(currIndex) {
    clearInterval(slideInterval);
    currIndex > 0 ? setTeamClasses(currIndex - 1) : setTeamClasses(classes.length - 1);
  }

  function setTeamClasses(activeIndex) {
     $('.team__bio').each(function(index) {  
      $(this).removeClass('semi-active active inactive');
      $(this).addClass(classes[activeIndex][index]);
      $('.team__nav a').removeClass('active');

      if (activeIndex < 3) {
        $('.team__nav a').eq(activeIndex + 1).addClass('active');
      } else {
        $('.team__nav a').eq(0).addClass('active');
      }
    });
  }

});