$(document).ready(function() {
    const quantity_icon = $('.quantity__cart-infor');
    const list_cart_menu = $('.list__cart');
    
    const quantityCart = $('.quantity__cart');
    const cartContainer = $('.cart');
    const overlay = $('.overlay');
    const backCart_button = $('.button__back');
    const animateItems = $('.animation_item');
    const listMenuItem = $('.menu_item a');
    const priceProduct = $('.cart__total-content');
    const numberProduct = $('.cart__quanlity .quanlity');
    const select_nav_mobile = $('.select_nav_mobile');
    const remove_moble_button = $('.select_nav_mobile .remove');
    const bar_mobile_icon = $('.bar_mobile_icon');
    const infor_icon = $('.infor_account .account');
    const option_account = $('.option_account');

    $(window).scroll(checkAnimate);

    let cartItems_menu = localStorage.getItem('cartItems');

    function updateQuantityMenu() {
        cartItems_menu = localStorage.getItem('cartItems');
        if (cartItems_menu) {
            cartItems_menu = JSON.parse(cartItems_menu);
            quantity_icon.text(cartItems_menu.length);
            inforCartMenu(cartItems_menu);
            totalMenu(cartItems_menu);
        }
    }

    function inforCartMenu(cartItems_menu) {
        if (cartItems_menu) {
            cartMenu(cartItems_menu, list_cart_menu);
        }
    }

    function cartMenu(list, menu) {
        const htmls = list.map((pizza, index) => {
            return renderListCart(pizza, index);
        });
        menu.html(htmls.join(''));
    }

    function renderListCart(pizza, index) {
        return `
            <div class="item__cart">
                <div class="item__cart-content">
                    <div class="item__cart-img">
                        <img src="${pizza.product.img}" alt="">
                    </div>
                    <div class="item__cart-info">
                        <div class="cart__info-name">${pizza.product.name}</div>
                        <div class="cart__info-subname">${pizza.product.subName}</div>
                        <div class="cart__info-price">${convert(pizza.product.price)}</div>
                    </div>
                </div>
                <div class="setting__quantily">
                    <div class="setting__quantily-btn">
                        <div class="number__quantily">x${pizza.quantity_item}</div>
                    </div>
                    <div class="setting__quantily-remove">
                        <button class="btn__remove" 
                            onclick="deleteProductMenu(${pizza.product.tag}, ${pizza.product.id}, event)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    function deleteProductMenu(tag, id, event) {
        cartItems_menu = localStorage.getItem('cartItems');
        cartItems_menu = JSON.parse(cartItems_menu);
        cartItems_menu.forEach((item, index) => {
            if (item.product.id == id && item.product.tag == tag) {
                let cartItems_temp = localStorage.getItem('cartItems');
                cartItemsArray = JSON.parse(cartItems_temp);
                cartItemsArray.splice(index, 1);
                event.target.closest('.item__cart').remove();
                localStorage.setItem('cartItems', JSON.stringify(cartItemsArray));

                updateQuantityMenu();

                return;
            }
        });
    }

    function convert(number) {
        let vnd = number.toLocaleString('vi', { style: 'currency', currency: 'VND' });
        vnd = vnd.replace('.', ',');
        return vnd;
    }

    function totalMenu(cartItems_menu) {
        let itemsCartMenu = $('.item__cart');
        let tong = 0;
        itemsCartMenu.each(function(index, item) {
            tong += parseInt($(item).find('.item__cart-info .cart__info-price').text()) *
                parseInt($(item).find('.number__quantily').text().substring(1));
        });
        let sizeOfProduct = 0;
        cartItems_menu.forEach((item) => {
            sizeOfProduct += parseInt(item.quantity_item);
        });

        priceProduct.text(convert(tong * 1000));
        numberProduct.text(sizeOfProduct);
    }

    quantityCart.click(function() {
        cartContainer.addClass('active');
        overlay.addClass('active');
    });

    function hideCart() {
        cartContainer.removeClass('active');
        overlay.removeClass('active');
    }

    overlay.click(hideCart);
    backCart_button.click(hideCart);

    function checkAnimate() {
        animateItems.each(function(index, item) {
            const triggerPoint = window.innerHeight;
            const itemTop = $(item).get(0).getBoundingClientRect().top;
            if (itemTop < triggerPoint - 100) {
                $(item).addClass('animate_item-show');
            } else {
                $(item).removeClass('animate_item-show');
            }
        });
    }

    bar_mobile_icon.click(function() {
        select_nav_mobile.css('display', 'flex');
    });

    remove_moble_button.click(function() {
        select_nav_mobile.css('display', 'none');
    });

    infor_icon.click(function() {
        option_account.toggleClass('active');
    });
    // Item menu
    var activeItem = localStorage.getItem('active_item');
    if(activeItem != "") {
        $('.main_menu .menu_item a .active').removeClass('active');
        $('.main_menu .menu_item a[data-menu-item="'+activeItem+'"]').addClass('active');
    }else {
        $('.main_menu .menu_item a[data-menu-item="item1"]').addClass('active');
    }
    $('.main_menu .menu_item a').click(function(e) {    
        localStorage.setItem('active_item', $(this).data('menu-item'));        
        $(this).addClass('active');
    })
});