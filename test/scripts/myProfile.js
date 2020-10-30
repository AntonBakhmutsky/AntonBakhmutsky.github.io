'use strict'

window.addEventListener('load', () => {
    //profile or settings
    const btnProfile = document.querySelector('#profile');
    const btnSettings = document.querySelector('#settings');
    const profile = document.querySelector('.myProfile');
    const settings = document.querySelector('.settings');

    const showProfile = () => {
        btnProfile.classList.add('myProfile__headerButtonsItem_active');
        btnSettings.classList.remove('myProfile__headerButtonsItem_active');
        profile.classList.remove('myProfile_disabled');
        settings.classList.remove('settings_active')
    }
    const showSettings = () => {
        btnProfile.classList.remove('myProfile__headerButtonsItem_active');
        btnSettings.classList.add('myProfile__headerButtonsItem_active');
        profile.classList.add('myProfile_disabled');
        settings.classList.add('settings_active');
    }

    btnProfile.addEventListener('click', showProfile);
    btnSettings.addEventListener('click', showSettings);

    //my profile tabItems
    const tabItems = document.querySelectorAll('.myProfile__aboutTabContentItem');
    const toggleActive = (event) => {
        event.target.closest('.myProfile__aboutTabContentItem').classList.toggle('myProfile__aboutTabContentItem_active');
        event.currentTarget.childNodes[5].toggleAttribute('checked');
    }

    tabItems.forEach((el) => el.addEventListener('click', toggleActive));

    //autocomplete
    new autoComplete({
        selector: 'input[name="country"]',
        minChars: 2,
        source: function(term, suggest) {
            term = term.toLowerCase();
            var choices = ['Россия', 'Сербия', 'Великобритания', 'США', 'Китай', 'Финляндия', 'Япония'];
            var matches = [];
            for (let i = 0; i < choices.length; i++)
                if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
            suggest(matches);
        }
    });
    new autoComplete({
        selector: 'input[name="city"]',
        minChars: 2,
        source: function(term, suggest) {
            term = term.toLowerCase();
            var choices = ['Москва', 'Самара', 'Санкт-Петербург', 'Кингисепп', 'Великий Новгород'];
            var matches = [];
            for (let i = 0; i < choices.length; i++)
                if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
            suggest(matches);
        }
    });
});