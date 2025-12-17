<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php#auth');
    exit;
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

$bookingSuccess = '';
$bookingError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['competition'])) {
    $competitionId = (int)$_POST['competition'];
    $participants = (int)$_POST['participants'];
    
    if ($competitionId && $participants > 0) {
        $stmt = $pdo->prepare("INSERT INTO registrations (user_id, competition_id, participants_count, status) VALUES (?, ?, ?, 'pending')");
        if ($stmt->execute([$userId, $competitionId, $participants])) {
            $bookingSuccess = 'Вы успешно записались на конкурс! Ожидайте подтверждения.';
        } else {
            $bookingError = 'Ошибка при записи. Попробуйте позже.';
        }
    } else {
        $bookingError = 'Заполните все поля корректно.';
    }
}

$competitions = $pdo->query("SELECT * FROM competitions ORDER BY date_event ASC")->fetchAll();

$stmt = $pdo->prepare("
    SELECT r.*, c.title, c.date_event, c.time_start, c.time_end 
    FROM registrations r 
    JOIN competitions c ON r.competition_id = c.id 
    WHERE r.user_id = ? 
    ORDER BY r.created_at DESC
");
$stmt->execute([$userId]);
$userBookings = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя семья – мой космос | Личный кабинет</title>
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
                            <a href="account.php" class="header__nav-link header__nav-link--active">Личный кабинет</a>
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
                            <a href="index.php#search" class="header__nav-link">Поиск</a>
                        </li>
                        <li class="header__nav-item">
                            <a href="#contacts" class="header__nav-link">Контакты</a>
                        </li>
                    </ul>
                </nav>
                
                <button class="header__theme-toggle" aria-label="Переключить тему">
                    <span class="theme-toggle__icon">🌙</span>
                </button>
                
                <a href="logout.php" class="btn btn--logout">Выйти</a>
            </div>
        </div>
    </header>


    <main class="main">
        <section class="section section--account">
            <div class="container">
                <div class="account-header">
                    <div class="account-header__info">
                        <img src="media/images/user-avatar.jpg" alt="Аватар пользователя" class="account-header__avatar">
                        <div class="account-header__text">
                            <h1 class="account-header__title">Добро пожаловать!</h1>
                            <p class="account-header__subtitle"><?php echo htmlspecialchars($user['full_name']); ?></p>
                            <p class="account-header__email"><?php echo htmlspecialchars($user['email']); ?></p>
                        </div>
                    </div>
                </div>


                <div class="account-content">
                    <h2 class="section__title">Запись на конкурс</h2>
                    
                    <?php if ($bookingSuccess): ?>
                    <div class="form__message form__message--success" style="display: block; margin-bottom: 20px;">
                        <span class="form__message-icon">✓</span>
                        <p class="form__message-text"><?php echo htmlspecialchars($bookingSuccess); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($bookingError): ?>
                    <div class="form__message form__message--error" style="display: block; margin-bottom: 20px;">
                        <span class="form__message-icon">⚠</span>
                        <p class="form__message-text"><?php echo htmlspecialchars($bookingError); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <form class="form form--booking" method="POST" action="account.php">
                        <div class="form__group">
                            <label for="competition" class="form__label">
                                Конкурс <span class="form__required">*</span>
                            </label>
                            <select id="competition" name="competition" class="form__select" required>
                                <option value="">Выберите конкурс</option>
                                <?php foreach ($competitions as $comp): ?>
                                <option value="<?php echo $comp['id']; ?>">
                                    <?php echo htmlspecialchars($comp['title']); ?> 
                                    (<?php echo date('d.m.Y', strtotime($comp['date_event'])); ?>)
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="form__error" id="competition-error">Выберите конкурс</span>
                        </div>
                        
                        <div class="form__group">
                            <label for="participants" class="form__label">
                                Количество участников <span class="form__required">*</span>
                            </label>
                            <input type="number" 
                                   id="participants" 
                                   name="participants" 
                                   class="form__input" 
                                   min="1" 
                                   max="10" 
                                   value="1" 
                                   placeholder="Введите количество" 
                                   required>
                            <span class="form__hint">От 1 до 10 человек</span>
                            <span class="form__error" id="participants-error">Укажите количество участников</span>
                        </div>
                        
                        <button type="submit" class="btn btn--primary btn--large">Записаться на конкурс</button>
                    </form>
                </div>


                <div class="account-bookings">
                    <h2 class="section__title">Мои записи</h2>
                    
                    <?php if (empty($userBookings)): ?>
                    <p style="text-align: center; padding: 40px; color: var(--color-text-secondary);">
                        У вас пока нет записей на конкурсы
                    </p>
                    <?php else: ?>
                    <div class="bookings-list">
                        <?php foreach ($userBookings as $booking): 
                            $statusText = $booking['status'] === 'confirmed' ? 'Подтверждена' : 'Ожидает подтверждения';
                            $statusClass = $booking['status'] === 'confirmed' ? 'confirmed' : 'pending';
                            $dateFormatted = date('d.m.Y', strtotime($booking['date_event']));
                        ?>
                        <article class="booking-card">
                            <div class="booking-card__header">
                                <h3 class="booking-card__title"><?php echo htmlspecialchars($booking['title']); ?></h3>
                                <span class="booking-card__status booking-card__status--<?php echo $statusClass; ?>">
                                    <?php echo $statusText; ?>
                                </span>
                            </div>
                            <div class="booking-card__info">
                                <div class="booking-card__detail">
                                    <span class="booking-card__icon">📅</span>
                                    <span class="booking-card__text"><?php echo $dateFormatted; ?></span>
                                </div>
                                <div class="booking-card__detail">
                                    <span class="booking-card__icon">🕐</span>
                                    <span class="booking-card__text">
                                        <?php echo substr($booking['time_start'], 0, 5); ?> - 
                                        <?php echo substr($booking['time_end'], 0, 5); ?>
                                    </span>
                                </div>
                                <div class="booking-card__detail">
                                    <span class="booking-card__icon">👥</span>
                                    <span class="booking-card__text"><?php echo $booking['participants_count']; ?> участника</span>
                                </div>
                            </div>
                            <div class="booking-card__actions">
                                <a href="competition.php?id=<?php echo $booking['competition_id']; ?>" class="btn btn--secondary btn--small">Подробнее</a>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                                <div class="account-reviews" style="margin-top: var(--spacing-3xl);">
                    <h2 class="section__title">Мои отзывы</h2>
                    
                    <?php
                    $reviewSuccess = '';
                    $reviewError = '';
                    
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_content'])) {
                        $competitionId = !empty($_POST['review_competition']) ? (int)$_POST['review_competition'] : null;
                        $content = trim($_POST['review_content']);
                        $rating = (int)($_POST['rating'] ?? 0);
                        
                        if (!empty($content) && $rating >= 1 && $rating <= 5) {
                            $stmt = $pdo->prepare("INSERT INTO reviews (user_id, competition_id, content, rating, is_approved) VALUES (?, ?, ?, ?, 0)");
                            if ($stmt->execute([$userId, $competitionId, $content, $rating])) {
                                $reviewSuccess = 'Спасибо за отзыв! Он будет опубликован после модерации.';
                            } else {
                                $reviewError = 'Ошибка при отправке отзыва.';
                            }
                        } else {
                            $reviewError = 'Заполните все поля корректно.';
                        }
                    }
                    
                    $stmt = $pdo->prepare("
                        SELECT r.*, c.title as competition_title 
                        FROM reviews r 
                        LEFT JOIN competitions c ON r.competition_id = c.id 
                        WHERE r.user_id = ? 
                        ORDER BY r.created_at DESC
                    ");
                    $stmt->execute([$userId]);
                    $userReviews = $stmt->fetchAll();
                    ?>
                    
                    <?php if ($reviewSuccess): ?>
                    <div class="form__message form__message--success" style="display: block; margin-bottom: var(--spacing-xl);">
                        <span class="form__message-icon">✓</span>
                        <p class="form__message-text"><?php echo htmlspecialchars($reviewSuccess); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($reviewError): ?>
                    <div class="form__message form__message--error" style="display: block; margin-bottom: var(--spacing-xl);">
                        <span class="form__message-icon">⚠</span>
                        <p class="form__message-text"><?php echo htmlspecialchars($reviewError); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <form class="form form--review" method="POST" action="account.php" style="max-width: 700px;">
                        <div class="form__group">
                            <label for="review_competition" class="form__label">
                                Конкурс (необязательно)
                            </label>
                            <select id="review_competition" name="review_competition" class="form__select">
                                <option value="">Общий отзыв о мероприятии</option>
                                <?php foreach ($competitions as $comp): ?>
                                <option value="<?php echo $comp['id']; ?>">
                                    <?php echo htmlspecialchars($comp['title']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form__group">
                            <label class="form__label">
                                Оценка <span class="form__required">*</span>
                            </label>
                            <div class="rating-input-wrapper" style="display: flex; gap: var(--spacing-sm);">
                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                <label style="cursor: pointer; font-size: 2rem; color: #d1d5db; transition: color var(--transition-fast);" 
                                       onmouseover="highlightStars(this, <?php echo $i; ?>)" 
                                       onmouseout="resetStars()">
                                    <input type="radio" name="rating" value="<?php echo $i; ?>" required style="display: none;" 
                                           onclick="setRating(<?php echo $i; ?>)">
                                    <span class="star" data-value="<?php echo $i; ?>">★</span>
                                </label>
                                <?php endfor; ?>
                            </div>
                            <span class="form__hint">Выберите оценку от 1 до 5 звёзд</span>
                        </div>
                        
                        <div class="form__group">
                            <label for="review_content" class="form__label">
                                Ваш отзыв <span class="form__required">*</span>
                            </label>
                            <textarea id="review_content" 
                                      name="review_content" 
                                      class="form__textarea" 
                                      rows="5" 
                                      placeholder="Поделитесь своими впечатлениями..." 
                                      required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn--primary btn--large">Отправить отзыв</button>
                    </form>
                    
                    <h3 style="margin-top: var(--spacing-3xl); margin-bottom: var(--spacing-xl); font-size: 1.5rem;">
                        История моих отзывов
                    </h3>
                    
                    <?php if (empty($userReviews)): ?>
                    <div style="text-align: center; padding: var(--spacing-3xl); color: var(--color-text-secondary); background-color: var(--color-bg-secondary); border-radius: var(--radius-lg); border: 1px solid var(--color-border);">
                        <p style="font-size: 1.125rem; margin: 0;">Вы ещё не оставляли отзывов</p>
                    </div>
                    <?php else: ?>
                    <div class="bookings-list">
                        <?php foreach ($userReviews as $review): 
                            $statusText = $review['is_approved'] ? 'Опубликован' : 'На модерации';
                            $statusClass = $review['is_approved'] ? 'confirmed' : 'pending';
                            $dateFormatted = date('d.m.Y', strtotime($review['created_at']));
                            $stars = str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']);
                        ?>
                        <article class="booking-card">
                            <div class="booking-card__header">
                                <h3 class="booking-card__title">
                                    <?php echo $review['competition_title'] ? htmlspecialchars($review['competition_title']) : 'Общий отзыв'; ?>
                                </h3>
                                <span class="booking-card__status booking-card__status--<?php echo $statusClass; ?>">
                                    <?php echo $statusText; ?>
                                </span>
                            </div>
                            <div class="booking-card__info" style="margin-bottom: var(--spacing-lg);">
                                <div class="booking-card__detail">
                                    <span class="booking-card__icon">📅</span>
                                    <span class="booking-card__text"><?php echo $dateFormatted; ?></span>
                                </div>
                                <div class="rating">
                                    <span class="rating__stars"><?php echo $stars; ?></span>
                                </div>
                            </div>
                            <p style="color: var(--color-text-secondary); line-height: 1.7; margin: 0;">
                                <?php echo nl2br(htmlspecialchars($review['content'])); ?>
                            </p>
                        </article>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <script>
                let selectedRating = 0;
                
                function highlightStars(label, rating) {
                    const stars = document.querySelectorAll('.star');
                    stars.forEach(star => {
                        const value = parseInt(star.getAttribute('data-value'));
                        star.style.color = value <= rating ? '#fbbf24' : '#d1d5db';
                    });
                }
                
                function resetStars() {
                    if (selectedRating === 0) {
                        document.querySelectorAll('.star').forEach(star => {
                            star.style.color = '#d1d5db';
                        });
                    } else {
                        highlightStars(null, selectedRating);
                    }
                }
                
                function setRating(rating) {
                    selectedRating = rating;
                    highlightStars(null, rating);
                }
                </script>

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
