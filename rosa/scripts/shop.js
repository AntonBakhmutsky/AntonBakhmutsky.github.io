window.addEventListener('load', () => {
    //shop or prizes
    const shop = document.querySelector('.shop');
    const prizes =  document.querySelector('.myPrizes'); 
    const shopBtn = document.querySelector('#shop');
    const prizesBtn = document.querySelector('#myPrizes');
    
    const showShop = () => {
        shop.classList.remove('shop_disabled');
        prizes.classList.add('myPrizes_disabled');
        shopBtn.classList.add('tab__btn_active_darkTheme');
        prizesBtn.classList.remove('tab__btn_active_darkTheme');
    }
    const showPrizes = () => {
        prizes.classList.remove('myPrizes_disabled');
        shop.classList.add('shop_disabled');
        shopBtn.classList.remove('tab__btn_active_darkTheme');
        prizesBtn.classList.add('tab__btn_active_darkTheme');
    }

    shopBtn.addEventListener('click', showShop);
    prizesBtn.addEventListener('click', showPrizes);
});