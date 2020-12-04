window.addEventListener('load', () => {
    //shop or prizes
    const shop = document.querySelector('.shop');
    const prizes =  document.querySelector('.myPrizes'); 
    const shopBtn = document.querySelector('#shop');
    const prizesBtn = document.querySelector('#myPrizes');
    
    const showShop = () => {
        shop.classList.remove('shop_disabled');
        prizes.classList.add('myPrizes_disabled');
        shopBtn.classList.add('tab__btn_active_gradientTheme');
        prizesBtn.classList.remove('tab__btn_active_gradientTheme');
    }
    const showPrizes = () => {
        prizes.classList.remove('myPrizes_disabled');
        shop.classList.add('shop_disabled');
        shopBtn.classList.remove('tab__btn_active_gradientTheme');
        prizesBtn.classList.add('tab__btn_active_gradientTheme');
    }

    shopBtn.addEventListener('click', showShop);
    prizesBtn.addEventListener('click', showPrizes);
});