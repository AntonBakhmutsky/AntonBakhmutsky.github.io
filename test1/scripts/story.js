window.addEventListener('load', () => {
    //task or prizes 
    const tasks = document.querySelector('.tasks');
    const prizes =  document.querySelector('.prizes'); 
    const tasksBtn = document.querySelector('#tasks');
    const prizesBtn = document.querySelector('#prizes');
    
    const showTasks = () => {
        tasks.classList.remove('tasks_disabled');
        prizes.classList.add('prizes_disabled');
        tasksBtn.classList.add('tab__btn_active_gradientTheme');
        prizesBtn.classList.remove('tab__btn_active_gradientTheme');
    }
    const showPrizes = () => {
        prizes.classList.remove('prizes_disabled');
        tasks.classList.add('tasks_disabled');
        tasksBtn.classList.remove('tab__btn_active_gradientTheme');
        prizesBtn.classList.add('tab__btn_active_gradientTheme');
    }

    tasksBtn.addEventListener('click', showTasks);
    prizesBtn.addEventListener('click', showPrizes);
});