$(document).ready(function() {
    setTimeout(function() {
        $('.loader').css('display', 'none');
        $('.all_container').css('display', 'block');
    }, 100);

    function convert(number) {
        let vnd = number.toLocaleString('vi', { style: 'currency', currency: 'VND' });
        vnd = vnd.replace('.', ',');
        return vnd;
    }

    // App
    let slider = $('.slider .list');
    let items = slider.find('.item');
    let next = $('#next');
    let prev = $('#prev');
    let dots = $('.slider .dots li');

    let lengthItems = items.length - 1;
    let active = 0;
    let refreshInterval = setInterval(() => { next.click(); }, 23000);

    next.on('click', function() {
      active = active + 1 <= lengthItems ? active + 1 : 0;
      reloadSlider();
    });

    prev.on('click', function() {
      active = active - 1 >= 0 ? active - 1 : lengthItems;
      reloadSlider();
    });

    function reloadSlider() {
      slider.css('left', -items[active].offsetLeft + 'px');

      let lastActiveDot = $('.slider .dots li.active');
      lastActiveDot.removeClass('active');
      dots.eq(active).addClass('active');

      clearInterval(refreshInterval);
      refreshInterval = setInterval(() => { next.click(); }, 23000);
    }

    dots.on('click', function() {
      active = $(this).index();
      reloadSlider();
    });

    $(window).on('resize', function(event) {
      reloadSlider();
    });
  

    // Slider 2
    let prev_sl2 = $('#slider_second_prev');
    let next_sl2 = $('#slider_second_next');
    let image = $('.slider_second .images');
    let items_sl2 = $('.slider_second .images .item');

    let rotate = 0;
    let active_sl2 = 0;
    let countItem = items_sl2.length;
    let rotateAdd = 360 / countItem;

    function nextSlider() {
        active_sl2 = active_sl2 + 1 > countItem - 1 ? 0 : active_sl2 + 1;
        rotate = rotate + rotateAdd;
        show();
    }

    function prevSlider() {
        active_sl2 = active_sl2 - 1 < 0 ? countItem - 1 : active_sl2 - 1;
        rotate = rotate - rotateAdd;
        show();
    }

    function show() {
        image.css('--rotate', rotate + 'deg');
    }

    next_sl2.click(nextSlider);
    prev_sl2.click(prevSlider);

    const autoNext = setInterval(nextSlider, 3000);

    
});