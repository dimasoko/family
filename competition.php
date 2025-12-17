<?php 
require_once 'db.php';

$competition_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

try {
    $stmt = $pdo->prepare("SELECT * FROM competitions WHERE id = ?");
    $stmt->execute([$competition_id]);
    $competition = $stmt->fetch();
    
    if (!$competition) {
        header('Location: 404.html');
        exit;
    }
    
    $dateObj = new DateTime($competition['date_event']);
    $formattedDate = $dateObj->format('d.m.Y');
    
} catch(PDOException $e) {
    die("Ошибка: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя семья – мой космос | <?php echo htmlspecialchars($competition['title']); ?></title>
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
                            <a href="index.php#auth" class="header__nav-link">Авторизация</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="account.php" class="header__nav-link">Личный кабинет</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="index.php#about" class="header__nav-link">О нас</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="index.php#competitions" class="header__nav-link">Конкурсы</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="schedule.php" class="header__nav-link">Расписание</a>
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
        <section class="section section--competition">
            <div class="container">
                <div class="competition-header">
                    <h1 class="competition__title"><?php echo htmlspecialchars($competition['title']); ?></h1>
                </div>


                <div class="competition-content">
                    <div class="competition__image-wrapper">
                        <img src="<?php echo htmlspecialchars($competition['image_url']); ?>" 
                             alt="<?php echo htmlspecialchars($competition['title']); ?>" 
                             class="competition__image">
                    </div>


                    <div class="competition__description">
                        <h2 class="competition__subtitle">О конкурсе</h2>
                        <p class="competition__text">
                            <?php echo nl2br(htmlspecialchars($competition['full_text'])); ?>
                        </p>
                        
                        <h2 class="competition__subtitle">Условия участия</h2>
                        <p class="competition__text">
                            Для участия необходима предварительная регистрация. Команда может состоять <?php echo htmlspecialchars($competition['participants_limit']); ?>. Длительность – <?php echo htmlspecialchars($competition['duration']); ?>.
                        </p>
                        
                        <div class="competition__actions no-print">
                            <a href="account.php?competition_id=<?php echo $competition['id']; ?>" class="btn btn--primary btn--large">Записаться на конкурс</a>
                            <a href="schedule.php" class="btn btn--secondary btn--large">Посмотреть расписание</a>
                        </div>
                    </div>
                </div>


                <div class="competition-review print-only">
                    <h2 class="competition-review__title">Отзыв участника</h2>
                    <blockquote class="competition-review__quote">
                        <p class="competition-review__text">
                            "Замечательное мероприятие! Мы с детьми участвовали в семейной викторине и получили массу положительных эмоций. Вопросы были интересными и разнообразными, каждый член нашей семьи смог проявить себя. Организация на высшем уровне! Обязательно придём ещё!"
                        </p>
                        <footer class="competition-review__author">
                            ite>Анна Петрова</cite>
                            <time datetime="2024-06-15">15 июня 2024</time>
                        </footer>
                    </blockquote>
                </div>


                <div class="competition-info no-print">
                    <h2 class="competition__subtitle">Дополнительная информация</h2>
                    <div class="info-cards">
                        <div class="info-card">
                            <span class="info-card__icon">🕐</span>
                            <h3 class="info-card__title">Продолжительность</h3>
                            <p class="info-card__text"><?php echo htmlspecialchars($competition['duration']); ?></p>
                        </div>
                        
                        <div class="info-card">
                            <span class="info-card__icon">👨‍👩‍👧‍👦</span>
                            <h3 class="info-card__title">Размер команды</h3>
                            <p class="info-card__text"><?php echo htmlspecialchars($competition['participants_limit']); ?></p>
                        </div>
                    </div>
                </div>

                <div class="related-competitions no-print">
                    <h2 class="competition__subtitle">Другие конкурсы</h2>
                    <div class="grid grid--3cols">
                        <?php
                        // Получаем 3 случайных конкурса (кроме текущего)
                        $stmt = $pdo->prepare("SELECT * FROM competitions WHERE id != ? ORDER BY RAND() LIMIT 3");
                        $stmt->execute([$competition_id]);
                        
                        while ($related = $stmt->fetch()) {
                        ?>
                        <article class="card card--small">
                            <img src="<?php echo htmlspecialchars($related['image_url']); ?>" alt="<?php echo htmlspecialchars($related['title']); ?>" class="card__image">
                            <div class="card__content">
                                <h3 class="card__title"><?php echo htmlspecialchars($related['title']); ?></h3>
                                <p class="card__description"><?php echo htmlspecialchars($related['description']); ?></p>
                            </div>
                            <div class="card__footer">
                                <a href="competition.php?id=<?php echo $related['id']; ?>" class="btn btn--secondary btn--small">Подробнее</a>
                            </div>
                        </article>
                        <?php } ?>
                    </div>
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
