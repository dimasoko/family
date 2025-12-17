<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя семья – мой космос | Расписание конкурсов</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="theme-dark">
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a href="index.html" class="header__logo">
                    <img src="media/images/logo.png" alt="Моя семья – мой космос">
                    <span class="header__logo-text">Моя семья – мой космос</span>
                </a>
                
                <nav class="header__nav">
                    <ul class="header__nav-list">
                        <li class="header__nav-item">
                            <a href="registration.html" class="header__nav-link">Регистрация</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="index.html#auth" class="header__nav-link">Авторизация</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="account.html" class="header__nav-link">Личный кабинет</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="index.html#about" class="header__nav-link">О нас</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="index.html#competitions" class="header__nav-link">Конкурсы</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="index.html#search" class="header__nav-link">Поиск</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="#contacts" class="header__nav-link">Контакты</a>
                        </li>
                    </ul>
                </nav>
                
                <button class="header__theme-toggle" aria-label="Переключить тему">
                    <span class="theme-toggle__icon">🌙</span>
                </button>
            </div>
        </div>
    </header>

    <main class="main">
        <section class="section section--schedule">
            <div class="container">
                <h1 class="section__title">Расписание конкурсов</h1>
                <p class="section__subtitle">8 июля 2024 года</p>
                
                <div class="schedule-legend">
                    <div class="schedule-legend__item">
                        <span class="schedule-legend__badge schedule-legend__badge--available"></span>
                        <span class="schedule-legend__text">Есть свободные места</span>
                    </div>
                    <div class="schedule-legend__item">
                        <span class="schedule-legend__badge schedule-legend__badge--booked"></span>
                        <span class="schedule-legend__text">Регистрация завершена</span>
                    </div>
                </div>
                
                <div class="schedule-wrapper">
                    <table class="table table--schedule">
                        <thead class="table__header">
                            <tr class="table__row">
                                <th class="table__cell table__cell--header">Конкурс / Время</th>
                                <th class="table__cell table__cell--header">9:00-10:00</th>
                                <th class="table__cell table__cell--header">10:00-11:00</th>
                                <th class="table__cell table__cell--header">11:00-12:00</th>
                                <th class="table__cell table__cell--header">12:00-13:00</th>
                                <th class="table__cell table__cell--header">13:00-14:00</th>
                                <th class="table__cell table__cell--header">14:00-15:00</th>
                                <th class="table__cell table__cell--header">15:00-16:00</th>
                                <th class="table__cell table__cell--header">16:00-17:00</th>
                                <th class="table__cell table__cell--header">17:00-18:00</th>
                                <th class="table__cell table__cell--header">18:00-19:00</th>
                                <th class="table__cell table__cell--header">19:00-20:00</th>
                                <th class="table__cell table__cell--header">20:00-21:00</th>
                            </tr>
                        </thead>
                        <tbody class="table__body">
                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Семейная викторина</td>
                                <td class="table__cell table__cell--available">15</td>
                                <td class="table__cell table__cell--available">12</td>
                                <td class="table__cell table__cell--available">8</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">5</td>
                                <td class="table__cell table__cell--available">18</td>
                                <td class="table__cell table__cell--available">20</td>
                                <td class="table__cell table__cell--available">14</td>
                                <td class="table__cell table__cell--available">9</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">7</td>
                                <td class="table__cell table__cell--available">11</td>
                            </tr>

                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Космическая фотосессия</td>
                                <td class="table__cell table__cell--available">6</td>
                                <td class="table__cell table__cell--available">4</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">3</td>
                                <td class="table__cell table__cell--available">8</td>
                                <td class="table__cell table__cell--available">5</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">7</td>
                                <td class="table__cell table__cell--available">4</td>
                                <td class="table__cell table__cell--available">6</td>
                                <td class="table__cell table__cell--available">2</td>
                                <td class="table__cell table__cell--available">5</td>
                            </tr>

                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Кулинарный батл</td>
                                <td class="table__cell table__cell--available">10</td>
                                <td class="table__cell table__cell--available">12</td>
                                <td class="table__cell table__cell--available">15</td>
                                <td class="table__cell table__cell--available">8</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">6</td>
                                <td class="table__cell table__cell--available">9</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">13</td>
                                <td class="table__cell table__cell--available">11</td>
                                <td class="table__cell table__cell--available">7</td>
                                <td class="table__cell table__cell--available">4</td>
                            </tr>

                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Спортивная эстафета</td>
                                <td class="table__cell table__cell--available">25</td>
                                <td class="table__cell table__cell--available">20</td>
                                <td class="table__cell table__cell--available">18</td>
                                <td class="table__cell table__cell--available">22</td>
                                <td class="table__cell table__cell--available">16</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">24</td>
                                <td class="table__cell table__cell--available">19</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">21</td>
                                <td class="table__cell table__cell--available">15</td>
                                <td class="table__cell table__cell--available">12</td>
                            </tr>

                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Творческая мастерская</td>
                                <td class="table__cell table__cell--available">14</td>
                                <td class="table__cell table__cell--available">16</td>
                                <td class="table__cell table__cell--available">10</td>
                                <td class="table__cell table__cell--available">12</td>
                                <td class="table__cell table__cell--available">9</td>
                                <td class="table__cell table__cell--available">15</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">11</td>
                                <td class="table__cell table__cell--available">8</td>
                                <td class="table__cell table__cell--available">13</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">7</td>
                            </tr>

                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Музыкальный конкурс</td>
                                <td class="table__cell table__cell--available">8</td>
                                <td class="table__cell table__cell--available">10</td>
                                <td class="table__cell table__cell--available">6</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">12</td>
                                <td class="table__cell table__cell--available">9</td>
                                <td class="table__cell table__cell--available">7</td>
                                <td class="table__cell table__cell--available">11</td>
                                <td class="table__cell table__cell--available">5</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">8</td>
                                <td class="table__cell table__cell--available">4</td>
                            </tr>

                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Танцевальный батл</td>
                                <td class="table__cell table__cell--available">18</td>
                                <td class="table__cell table__cell--available">22</td>
                                <td class="table__cell table__cell--available">20</td>
                                <td class="table__cell table__cell--available">15</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">19</td>
                                <td class="table__cell table__cell--available">24</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">17</td>
                                <td class="table__cell table__cell--available">21</td>
                                <td class="table__cell table__cell--available">16</td>
                                <td class="table__cell table__cell--available">13</td>
                            </tr>

                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Семейный квест</td>
                                <td class="table__cell table__cell--available">12</td>
                                <td class="table__cell table__cell--available">14</td>
                                <td class="table__cell table__cell--available">11</td>
                                <td class="table__cell table__cell--available">9</td>
                                <td class="table__cell table__cell--available">16</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">13</td>
                                <td class="table__cell table__cell--available">10</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">15</td>
                                <td class="table__cell table__cell--available">8</td>
                                <td class="table__cell table__cell--available">6</td>
                            </tr>

                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Конкурс рисунков</td>
                                <td class="table__cell table__cell--available">20</td>
                                <td class="table__cell table__cell--available">18</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">15</td>
                                <td class="table__cell table__cell--available">22</td>
                                <td class="table__cell table__cell--available">17</td>
                                <td class="table__cell table__cell--available">19</td>
                                <td class="table__cell table__cell--available">16</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">14</td>
                                <td class="table__cell table__cell--available">12</td>
                                <td class="table__cell table__cell--available">10</td>
                            </tr>

                            <tr class="table__row">
                                <td class="table__cell table__cell--competition">Научное шоу</td>
                                <td class="table__cell table__cell--available">30</td>
                                <td class="table__cell table__cell--available">28</td>
                                <td class="table__cell table__cell--available">25</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">32</td>
                                <td class="table__cell table__cell--available">29</td>
                                <td class="table__cell table__cell--booked">0</td>
                                <td class="table__cell table__cell--available">27</td>
                                <td class="table__cell table__cell--available">24</td>
                                <td class="table__cell table__cell--available">26</td>
                                <td class="table__cell table__cell--available">22</td>
                                <td class="table__cell table__cell--available">20</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="schedule-info">
                    <p class="schedule-info__text">Для записи на конкурс перейдите в <a href="account.html" class="schedule-info__link">личный кабинет</a></p>
                </div>
            </div>
        </section>
    </main>

    <footer id="contacts" class="footer">
        <div class="container">
            <div class="footer__content">
                <div class="footer__contacts">
                    <h3 class="footer__title">Контакты</h3>
                    <ul class="footer__contacts-list">
                        <li>
                            <a href="tel:+74842234567" class="footer__link">+7 (4842) 23-45-67</a>
                        </li>
                        <li>
                            <a href="mailto:family@cosmos.ru" class="footer__link">family@cosmos.ru</a>
                        </li>
                    </ul>
                </div>
                
                <nav class="footer__nav">
                    <h3 class="footer__title">Навигация</h3>
                    <ul class="footer__nav-list">
                        <li class="footer__nav-item">
                            <a href="index.html" class="footer__link">Главная</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="index-light.html" class="footer__link">Главная-светлая</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="registration.html" class="footer__link">Регистрация</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="competition.html" class="footer__link">Конкурс</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="account.html" class="footer__link">Личный кабинет</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="404.html" class="footer__link">Страница не найдена</a>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <div class="footer__bottom">
                <p class="footer__copyright">&copy; 2024 Моя семья – мой космос. Все права защищены.</p>
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
