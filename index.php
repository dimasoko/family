<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя семья – мой космос | Главная</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="theme-dark">
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <a href="index.php" class="header__logo">
                    <img src="media/images/logo.png" alt="Моя семья – мой космос">
                    <span class="header__logo-text">Моя семья – мой космос</span>
                </a>
                
                <nav class="header__nav">
                    <ul class="header__nav-list">
                        <li class="header__nav-item">
                            <a href="registration.php" class="header__nav-link">Регистрация</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="#auth" class="header__nav-link">Авторизация</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="account.php" class="header__nav-link">Личный кабинет</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="#about" class="header__nav-link">О нас</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="#competitions" class="header__nav-link">Конкурсы</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="#search" class="header__nav-link">Поиск</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="#contacts" class="header__nav-link">Контакты</a>
                        </li>
                    </ul>
                </nav>
                
                <button class="header__theme-toggle" aria-label="Переключить тему">
                    <a href="index-light.php"><span class="theme-toggle__icon">☀️</span></a>
                </button>
            </div>
        </div>
    </header>


    <section class="section hero">
        <div class="container">
            <div class="slider">
                <div class="slider__track">
                    <?php
                    $stmt = $pdo->query("SELECT * FROM competitions ORDER BY date_event ASC LIMIT 3");
                    $slides = $stmt->fetchAll();
                    $first = true;
                    
                    foreach ($slides as $slide) {
                    ?>
                    <div class="slider__slide <?php echo $first ? 'slider__slide--active' : ''; ?>">
                        <img src="<?php echo htmlspecialchars($slide['image_url']); ?>" alt="<?php echo htmlspecialchars($slide['title']); ?>" class="slider__image">
                        <div class="slider__content">
                            <h2 class="slider__title"><?php echo htmlspecialchars($slide['title']); ?></h2>
                            <p class="slider__description"><?php echo htmlspecialchars($slide['description']); ?></p>
                            <div class="slider__meta">
                                <a href="competition.php?id=<?php echo $slide['id']; ?>" class="btn btn--primary">Подробнее</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        $first = false;
                    } 
                    ?>
                </div>
                
                <div class="slider__controls">
                    <button class="slider__control slider__control--prev" aria-label="Предыдущий слайд">‹</button>
                    <button class="slider__control slider__control--next" aria-label="Следующий слайд">›</button>
                </div>
                
                <div class="slider__indicators">
                    <?php for ($i = 0; $i < count($slides); $i++) { ?>
                    <span class="slider__indicator <?php echo $i === 0 ? 'slider__indicator--active' : ''; ?>"></span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>


    <section id="auth" class="section section--auth">
        <div class="container">
            <h2 class="section__title">Вход в личный кабинет</h2>
<?php
if (isset($_GET['error'])) {
    if ($_GET['error'] === 'invalid') {
        echo '<div class="form__message form__message--error" style="display: block; margin-bottom: 20px;">
                <span class="form__message-icon">⚠</span>
                <p class="form__message-text">Неверный email или пароль</p>
              </div>';
    } elseif ($_GET['error'] === 'empty') {
        echo '<div class="form__message form__message--error" style="display: block; margin-bottom: 20px;">
                <span class="form__message-icon">⚠</span>
                <p class="form__message-text">Заполните все поля</p>
              </div>';
    }
}
?>

            <form class="form form--auth" method="POST" action="login.php">
                <div class="form__group">
                    <label for="email-auth" class="form__label">Электронная почта</label>
                    <input type="email" id="email-auth" name="email" class="form__input" placeholder="example@mail.ru" required>
                </div>
                
                <div class="form__group">
                    <label for="password-auth" class="form__label">Пароль</label>
                    <input type="password" id="password-auth" name="password" class="form__input" placeholder="••••••••" required>
                </div>
                
                <div class="form__actions">
                    <button type="submit" class="btn btn--primary btn--large">Войти</button>
                    <a href="#" class="form__link">Забыли пароль?</a>
                </div>
            </form>
        </div>
    </section>


    <section id="about" class="section section--about">
        <div class="container">
            <h2 class="section__title">О нас</h2>
            <div class="about__content">
                <div class="about__text">
                    <p>Мы создаём незабываемые семейные мероприятия, которые объединяют поколения и укрепляют связи между близкими людьми. Наш проект "Моя семья – мой космос" – это уникальная возможность провести время с семьёй, участвуя в увлекательных конкурсах и активностях.</p>
                    <p>За годы работы мы организовали более 50 мероприятий, в которых приняли участие тысячи семей. Наша миссия – сделать каждое семейное событие особенным и запоминающимся.</p>
                </div>
                <div class="about__image">
                    <img src="media/images/about.jpg" alt="О нашей компании">
                </div>
            </div>
        </div>
    </section>


    <section class="section section--welcome">
        <div class="container">
            <h2 class="section__title">Приветствие от организаторов</h2>
            <div class="video-container">
                <video controls class="video" poster="media/images/video-poster.jpg">
                    <source src="media/video/hello.mp4" type="video/mp4">
                    Ваш браузер не поддерживает воспроизведение видео.
                </video>
            </div>
        </div>
    </section>


    <section id="competitions" class="section section--competitions">
        <div class="container">
            <h2 class="section__title">Конкурсы</h2>
            
            <div class="grid grid--3cols">
                <?php
                $stmt = $pdo->query("SELECT * FROM competitions ORDER BY date_event ASC");
                
                while ($comp = $stmt->fetch()) {
                ?>
                <article class="card">
                    <img src="<?php echo htmlspecialchars($comp['image_url']); ?>" alt="<?php echo htmlspecialchars($comp['title']); ?>" class="card__image">
                    <div class="card__content">
                        <h3 class="card__title"><?php echo htmlspecialchars($comp['title']); ?></h3>
                        <p class="card__description"><?php echo htmlspecialchars($comp['description']); ?></p>
                        <div class="card__meta">
                            <div class="card__info">
                                <span class="badge">
                                    <span class="badge__icon">👥</span>
                                    <span class="badge__text">45 записей</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card__footer">
                        <a href="account.php?competition_id=<?php echo $comp['id']; ?>" class="btn btn--primary btn--small">Записаться</a>
                    </div>
                </article>
                <?php } ?>
            </div>
        </div>
    </section>


    <section id="search" class="section section--search">
        <div class="container">
            <h2 class="section__title">Найти конкурс</h2>
            <form class="search-form">
                <div class="search-form__input-wrapper">
                    <input type="search" 
                           class="search-form__input" 
                           placeholder="Введите название или описание конкурса..." 
                           list="search-hints">
                    <datalist id="search-hints">
                        <?php
                        // Подсказки для поиска из БД
                        $stmt = $pdo->query("SELECT title FROM competitions");
                        while ($hint = $stmt->fetch()) {
                            echo '<option value="' . htmlspecialchars($hint['title']) . '">';
                        }
                        ?>
                    </datalist>
                </div>
                <button type="submit" class="btn btn--primary">Поиск</button>
            </form>
        </div>
    </section>


    <section class="section section--reviews">
        <div class="container">
            <h2 class="section__title">Отзывы участников</h2>
            
            <div class="reviews-slider">
                <div class="reviews-slider__track">
                    <?php
                    $stmt = $pdo->query("SELECT r.*, u.full_name, c.title as competition_title, c.id as competition_id 
                                        FROM reviews r 
                                        JOIN users u ON r.user_id = u.id 
                                        LEFT JOIN competitions c ON r.competition_id = c.id 
                                        WHERE r.is_approved = 1 
                                        ORDER BY r.created_at DESC 
                                        LIMIT 3");
                    $reviews = $stmt->fetchAll();
                    $firstReview = true;
                    
                    foreach ($reviews as $review) {
                        $dateObj = new DateTime($review['created_at']);
                        $formattedDate = $dateObj->format('d.m.Y');
                    ?>
                    <article class="review-card <?php echo $firstReview ? 'review-card--active' : ''; ?>">
                        <img src="media/images/user1.jpg" alt="<?php echo htmlspecialchars($review['full_name']); ?>" class="review-card__avatar">
                        <div class="review-card__content">
                            <h3 class="review-card__author"><?php echo htmlspecialchars($review['full_name']); ?></h3>
                            <p class="review-card__text"><?php echo htmlspecialchars($review['content']); ?></p>
                            <time class="review-card__date" datetime="<?php echo $review['created_at']; ?>"><?php echo $formattedDate; ?></time>
                            <?php if ($review['competition_id']) { ?>
                            <a href="competition.php?id=<?php echo $review['competition_id']; ?>" class="review-card__link">О конкурсе →</a>
                            <?php } ?>
                        </div>
                    </article>
                    <?php 
                        $firstReview = false;
                    } 
                    ?>
                </div>
            </div>
        </div>
    </section>

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
                            <a href="index.php" class="footer__link">Главная</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="index-light.php" class="footer__link">Главная-светлая</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="registration.php" class="footer__link">Регистрация</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="competition.php" class="footer__link">Конкурс</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="account.php" class="footer__link">Личный кабинет</a>
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
