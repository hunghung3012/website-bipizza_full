$(document).ready(function() {
    setTimeout(function() {
        $('.loader').css('display', 'none');
        $('.all_container').css('display', 'block');
    }, 100);

    let list_pizza = [
        {
            id: 1,
            name: "Pizza Thập Cẩm",
            subName: "Pizza",
            price: 12000,
            quantity: 10,
            img: "images/menu/pizza/pizza (5).png",
            tag: 2
        },
        // ... (các mục khác)
    ];

    const menu_pizza = $('.intro_menu');

    function renderAll() {
        renderProduct(list_pizza, menu_pizza);
    }

    function renderProduct(list, menu) {
        const htmls = list.map((pizza, index) => {
            return renderListProduct(pizza, index);
        });

        let a = `
            <div class="menu_item col l-4 m-6 c-12">
                <div class="item_pizza item_pizza_sp">
                    <div class="img_item_pizza_sp">
                        <img src="images/menu/menu2.jpg" alt="">
                    </div>
                    <p class="text_item_pizza_sp"><a href="menu.html">Xem thêm</a></p>
                </div>
            </div>`;

        let temp = htmls.join('');
        menu.html(temp + a);
    }

    function renderListProduct(pizza, index) {
        return `
            <div class="menu_item col l-4 m-6 c-12">
                <div class="item_pizza">
                    <div class="item_pizza_img">
                        <img src="${pizza.img}" alt="" />
                    </div>
                    <div class="item_pizza_text display_flex">
                        <div class="pizza_costname">
                            <p class="pizza_cost_name"><span>${pizza.name.split(" ")[0]}</span>${pizza.name.replace(pizza.name.split(" ")[0], "")}</p>
                            <p class="pizza_cost_text">${convert(pizza.price)}</p>
                        </div>
                        <div class="pizza_heart_icon">
                            <i class="fa-solid fa-heart"></i>
                        </div>
                    </div>
                    <div class="pizza_star-container">
                        <ul class="pizza_star">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                    </div>
                </div>
            </div>`;
    }

    function convert(number) {
        let vnd = number.toLocaleString('vi', { style: 'currency', currency: 'VND' });
        vnd = vnd.replace('.', ',');
        return vnd;
    }

    // App
    let slider = $('.slider .list');
    let items = slider.find('.list .item');
    let next = $('#next');
    let prev = $('#prev');
    let dots = $('.slider .dots li');

    let lengthItems = items.length - 1;
    let active = 0;
    next.click(function() {
        active = active + 1 <= lengthItems ? active + 1 : 0;
        reloadSlider();
    });
    prev.click(function() {
        active = active - 1 >= 0 ? active - 1 : lengthItems;
        reloadSlider();
    });

    let refreshInterval = setInterval(function() { next.click() }, 23000);

    function reloadSlider() {
        slider.css('left', -items[active].offsetLeft + 'px');
        let last_active_dot = $('.slider .dots li.active');
        last_active_dot.removeClass('active');
        dots[active].addClass('active');

        clearInterval(refreshInterval);
        refreshInterval = setInterval(function() { next.click() }, 23000);
    }

    dots.each(function(key, li) {
        $(li).click(function() {
            active = key;
            reloadSlider();
        });
    });

    $(window).resize(function(event) {
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