(function() {
    tinymce.PluginManager.add('yablocks', function(editor, url) {
        editor.addButton('yablocks', {
            text: 'Яндекс.Блоки',
            title: 'HTML-заготовки Яндекс.Блоков (редактировать в режиме "Текст").',
            icon: 'yablocks',
            type: 'menubutton',
            menu: [{
                    text: 'Таблица',
                    onclick: function() {
                        editor.insertContent(`
<table style="border-collapse: collapse;" border="1">
    <tr><!--Заголовок таблицы-->
        <th>Первый столбец</th>
        <th>Второй столбец</th>
    </tr>
    <tr><!--Строка таблицы-->
        <th>Первый столбец</th>
        <th>Второй столбец</th>
    </tr>
</table><br>
`);
                    }
                },
                {
                    text: 'Прозрачная таблица',
                    onclick: function() {
                        editor.insertContent(`
<table data-invisible="true">
    <tr><!--Заголовок таблицы-->
        <th>Первый столбец</th>
        <th>Второй столбец</th>
    </tr>
    <tr><!--Строка таблицы-->
        <th>Первый столбец</th>
        <th>Второй столбец</th>
    </tr>
</table><br>
`);
                    }
                },
                {
                    text: 'Аккордеон',
                    onclick: function() {
                        editor.insertContent(`
<div data-block="accordion">
    <div data-block="item" data-title="Москва">Содержимое первого блока</div>
    <div data-block="item" data-title="Санкт-Петербург" data-expanded="true">Содержимое второго блока</div>
</div><br>
`);
                    }
                },
                {
                    text: 'Слайдер',
                    onclick: function() {
                        editor.insertContent(`
<div data-block="slider" data-view="landscape">
    <img src="ссылка на картинку"/>
    <img src="ссылка на картинку"/>
</div><br>
`);
                    }
                },
                {
                    text: 'Читайте также',
                    onclick: function() {
                        editor.insertContent(`
<div data-block="feed" data-layout="horizontal" data-title="Читайте также">
    <div data-block="feed-item"
        data-href="https://adelaide.au.com"
        data-title="Welcome"
        data-thumb="https://u24.services/media/service/poster/None/750eb2a4d7f9355bfcaabb19d3019ee388e26101.jpg"
        data-thumb-position="top"
        data-thumb-ratio="3x2"
        data-description="5 reasons to visit the capital of South Australia">
    </div>
    <div data-block="feed-item"
        data-thumb="https://u24.services/media/service/poster/None/750eb2a4d7f9355bfcaabb19d3019ee388e26101.jpg"
        data-thumb-position="left"
        data-thumb-ratio="16x10"
        data-href="https://sydney.au.com"
        data-title="The best city in the world and the capital of New South Wales">
    </div>
</div><br>
`);
                    }
                },
                {
                    text: 'Кнопка',
                    onclick: function() {
                        editor.insertContent(`
<button
    formaction="tel:+7(800)123-45-67"
    data-background-color="black"
    data-color="white"
    data-primary="true">8 800 123-45-67</button><br><br>
`);
                    }
                },
                {
                    text: 'Обратная связь',
                    onclick: function() {
                        editor.insertContent(`
<div data-block="widget-feedback" data-title="Обратная связь" data-stick="false">
    <div data-type="call" data-url="+7 012 345-67-89"></div>
    <div data-type="telegram" data-url="https://t.me/example"></div>
    <div data-type="mail" data-url="mailto:mail@example.com"></div>
    <div data-type="callback" data-send-to="mail@example.com"></div>
</div><br>
`);
                    }
                },
                {
                    text: 'Поделиться',
                    onclick: function() {
                        editor.insertContent(`
<div data-block="share" data-network="vkontakte,twitter, facebook,odnoklassniki,telegram"></div><br>
`);
                    }
                },
                {
                    text: 'Форма обратной связи',
                    onclick: function() {
                        editor.insertContent(`
<form data-type="callback"
    data-send-to="mail@example.com">
</form><br>
`);
                    }
                },
                {
                    text: 'Кнопка формы обратной связи',
                    onclick: function() {
                        editor.insertContent(`
<button formaction="mailto:mail@example.com"
    data-background-color="white"
    data-color="black"
    data-primary="true"
    data-send-to="mail@example.com">Оставить заявку</button><br><br>
`);
                    }
                },
                {
                    text: 'Карточки (вертикальные)',
                    onclick: function() {
                        editor.insertContent(`
<div data-block="cards">
    <div data-block="card">
        <header>
            <img src="ссылка на картинку">
            <h2>Заголовок 1</h2>
        </header>
        <!-- Начало содержимого карточки. -->
        <img src="ссылка на картинку">
        <p>Контент 1</p>
        <!-- Конец содержимого карточки. -->
        <footer>
            <a href="https://example.com/page-1.html">Читать дальше...</a>
        </footer>
    </div>
    <div data-block="card">
        <header>
            <img src="ссылка на картинку">
            <h2>Заголовок 2</h2>
        </header>
        <!-- Начало содержимого карточки. -->
        <img src="ссылка на картинку">
        <p>Контент 2</p>
        <!-- Конец содержимого карточки. -->
        <footer>
            <a href="https://example.com/page-2.html">Читать дальше...</a>
        </footer>
        <div data-block="more">
            <a data-block="button" href="https://example.com">Главная</a>
        </div>
    </div>
</div>
`);
                    }
                },
                {
                    text: 'Карточки (горизонтальные)',
                    onclick: function() {
                        editor.insertContent(`
<div data-block="cards">
    <div data-block="carousel">
        <header>Заголовок</header>
        <div data-block="snippet"
             data-title="Карточка 1"
             data-img="ссылка на картинку"
             data-url="https://example.com/page1.html">
        </div>
        <div data-block="snippet"
             data-title="Карточка 2"
             data-img="ссылка на картинку"
             data-url="https://example.com/page2.html">
        </div>
        <div data-block="snippet"
             data-title="Карточка 3"
             data-img="ссылка на картинку"
             data-url="https://example.com/page3.html">
        </div>
    </div>
</div>
`);
                    }
                },


            ]
        });
    });
})();