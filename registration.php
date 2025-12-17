<?php 
require_once 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $firstName = trim($_POST['first-name']);
    $lastName = trim($_POST['last-name']);
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password-confirm'];
    $phone = trim($_POST['phone'] ?? '');
    
    // Валидация
    if (empty($email) || empty($firstName) || empty($lastName) || empty($password)) {
        $error = 'Заполните все обязательные поля';
    } elseif ($password !== $passwordConfirm) {
        $error = 'Пароли не совпадают';
    } elseif (strlen($password) < 6) {
        $error = 'Пароль должен содержать минимум 6 символов';
    } else {
        // Проверка на существующий email
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $error = 'Пользователь с таким email уже зарегистрирован';
        } else {
            // Регистрация
            $fullName = $firstName . ' ' . $lastName;
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare("INSERT INTO users (email, password, full_name, phone) VALUES (?, ?, ?, ?)");
            
            if ($stmt->execute([$email, $hashedPassword, $fullName, $phone])) {
                $success = 'Регистрация успешно завершена! Добро пожаловать в "Моя семья – мой космос".';
                // Можно перенаправить: header('Location: index.php#auth');
            } else {
                $error = 'Ошибка при регистрации. Попробуйте позже.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Моя семья – мой космос | Регистрация</title>
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
                            <a href="registration.php" class="header__nav-link header__nav-link--active">Регистрация</a>
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
            </div>
        </div>
    </header>


    <main class="main">
        <section class="section section--registration">
            <div class="container">
                <h1 class="section__title">Регистрация на сайте</h1>
                <p class="section__subtitle">Заполните форму, чтобы принять участие в мероприятии</p>
                
                <?php if ($error): ?>
                <div class="form__message form__message--error" style="display: block;">
                    <span class="form__message-icon">⚠</span>
                    <p class="form__message-text"><?php echo htmlspecialchars($error); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                <div class="form__message form__message--success" style="display: block;">
                    <span class="form__message-icon">✓</span>
                    <p class="form__message-text"><?php echo htmlspecialchars($success); ?></p>
                    <p style="margin-top: 10px;"><a href="index.php#auth" class="btn btn--primary">Войти в систему</a></p>
                </div>
                <?php endif; ?>
                
                <form class="form form--registration" id="registration-form" method="POST" action="registration.php">
                    <fieldset class="form__fieldset">
                        <legend class="form__legend">Личные данные</legend>
                        
                        <div class="form__group">
                            <label for="email" class="form__label">
                                Email <span class="form__required">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form__input" 
                                   placeholder="example@mail.ru" 
                                   value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                                   required>
                            <span class="form__error" id="email-error">Введите корректный email</span>
                        </div>
                        
                        <div class="form__row">
                            <div class="form__group">
                                <label for="first-name" class="form__label">
                                    Имя <span class="form__required">*</span>
                                </label>
                                <input type="text" 
                                       id="first-name" 
                                       name="first-name" 
                                       class="form__input" 
                                       placeholder="Иван" 
                                       value="<?php echo htmlspecialchars($_POST['first-name'] ?? ''); ?>"
                                       required>
                                <span class="form__error" id="first-name-error">Поле обязательно для заполнения</span>
                            </div>
                            
                            <div class="form__group">
                                <label for="last-name" class="form__label">
                                    Фамилия <span class="form__required">*</span>
                                </label>
                                <input type="text" 
                                       id="last-name" 
                                       name="last-name" 
                                       class="form__input" 
                                       placeholder="Иванов" 
                                       value="<?php echo htmlspecialchars($_POST['last-name'] ?? ''); ?>"
                                       required>
                                <span class="form__error" id="last-name-error">Поле обязательно для заполнения</span>
                            </div>
                        </div>
                        
                        <div class="form__group">
                            <label for="phone" class="form__label">
                                Телефон
                            </label>
                            <input type="tel" 
                                   id="phone" 
                                   name="phone" 
                                   class="form__input" 
                                   placeholder="+7 (999) 123-45-67"
                                   value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                        </div>
                        
                        <div class="form__row">
                            <div class="form__group">
                                <label for="age-number" class="form__label">
                                    Возраст
                                </label>
                                <input type="number" 
                                       id="age-number" 
                                       name="age" 
                                       class="form__input" 
                                       min="1" 
                                       max="120" 
                                       placeholder="25">
                                <span class="form__hint">Укажите возраст числом</span>
                                <span class="form__error" id="age-error">Введите корректный возраст</span>
                            </div>
                            
                            <div class="form__group">
                                <label for="age-range" class="form__label">
                                    Возраст (слайдер)
                                </label>
                                <input type="range" 
                                       id="age-range" 
                                       name="age-range" 
                                       class="form__range" 
                                       min="1" 
                                       max="120" 
                                       value="25">
                                <output for="age-range" class="form__output">25</output>
                            </div>
                        </div>
                        
                        <div class="form__group">
                            <label class="form__label">
                                Пол
                            </label>
                            <div class="form__radio-group">
                                <div class="form__radio-wrapper">
                                    <input type="radio" 
                                           id="gender-male" 
                                           name="gender" 
                                           value="male" 
                                           class="form__radio">
                                    <label for="gender-male" class="form__label form__label--radio">Мужской</label>
                                </div>
                                <div class="form__radio-wrapper">
                                    <input type="radio" 
                                           id="gender-female" 
                                           name="gender" 
                                           value="female" 
                                           class="form__radio">
                                    <label for="gender-female" class="form__label form__label--radio">Женский</label>
                                </div>
                            </div>
                            <span class="form__error" id="gender-error">Выберите пол</span>
                        </div>
                        
                        <div class="form__row">
                            <div class="form__group">
                                <label for="password" class="form__label">
                                    Пароль <span class="form__required">*</span>
                                </label>
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       class="form__input" 
                                       placeholder="••••••••" 
                                       minlength="6" 
                                       required>
                                <span class="form__hint">Минимум 6 символов</span>
                                <span class="form__error" id="password-error">Пароль должен содержать минимум 6 символов</span>
                            </div>
                            
                            <div class="form__group">
                                <label for="password-confirm" class="form__label">
                                    Повторите пароль <span class="form__required">*</span>
                                </label>
                                <input type="password" 
                                       id="password-confirm" 
                                       name="password-confirm" 
                                       class="form__input" 
                                       placeholder="••••••••" 
                                       minlength="6" 
                                       required>
                                <span class="form__error" id="password-confirm-error">Пароли не совпадают</span>
                            </div>
                        </div>
                        
                        <div class="form__group">
                            <label for="photo" class="form__label">
                                Семейная фотография
                            </label>
                            <div class="form__file-wrapper">
                                <input type="file" 
                                       id="photo" 
                                       name="photo" 
                                       class="form__file" 
                                       accept="image/*">
                                <label for="photo" class="form__file-label">
                                    <span class="form__file-icon">📁</span>
                                    <span class="form__file-text">Выберите файл</span>
                                </label>
                                <span class="form__file-name">Файл не выбран</span>
                            </div>
                            <span class="form__hint">Форматы: JPG, PNG, максимум 5 МБ</span>
                            <span class="form__error" id="photo-error">Загрузите семейную фотографию</span>
                        </div>
                    </fieldset>


                    <fieldset class="form__fieldset">
                        <legend class="form__legend">Члены семьи</legend>
                        <p class="form__description">Добавьте информацию о членах вашей семьи</p>
                        
                        <div class="family-members" id="family-members">
                            <div class="family-member">
                                <h3 class="family-member__title">Член семьи 1</h3>
                                <button type="button" class="family-member__remove" aria-label="Удалить члена семьи">✕</button>
                                
                                <div class="form__row">
                                    <div class="form__group">
                                        <label for="member-1-first-name" class="form__label">Имя</label>
                                        <input type="text" 
                                               id="member-1-first-name" 
                                               name="member-1-first-name" 
                                               class="form__input" 
                                               placeholder="Имя">
                                    </div>
                                    
                                    <div class="form__group">
                                        <label for="member-1-last-name" class="form__label">Фамилия</label>
                                        <input type="text" 
                                               id="member-1-last-name" 
                                               name="member-1-last-name" 
                                               class="form__input" 
                                               placeholder="Фамилия">
                                    </div>
                                </div>
                                
                                <div class="form__row">
                                    <div class="form__group">
                                        <label for="member-1-age" class="form__label">Возраст</label>
                                        <input type="number" 
                                               id="member-1-age" 
                                               name="member-1-age" 
                                               class="form__input" 
                                               min="1" 
                                               max="120" 
                                               placeholder="Возраст">
                                    </div>
                                    
                                    <div class="form__group">
                                        <label for="member-1-gender" class="form__label">Пол</label>
                                        <select id="member-1-gender" 
                                                name="member-1-gender" 
                                                class="form__select">
                                            <option value="">Выберите пол</option>
                                            <option value="male">Мужской</option>
                                            <option value="female">Женский</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="family-member">
                                <h3 class="family-member__title">Член семьи 2</h3>
                                <button type="button" class="family-member__remove" aria-label="Удалить члена семьи">✕</button>
                                
                                <div class="form__row">
                                    <div class="form__group">
                                        <label for="member-2-first-name" class="form__label">Имя</label>
                                        <input type="text" 
                                               id="member-2-first-name" 
                                               name="member-2-first-name" 
                                               class="form__input" 
                                               placeholder="Имя">
                                    </div>
                                    
                                    <div class="form__group">
                                        <label for="member-2-last-name" class="form__label">Фамилия</label>
                                        <input type="text" 
                                               id="member-2-last-name" 
                                               name="member-2-last-name" 
                                               class="form__input" 
                                               placeholder="Фамилия">
                                    </div>
                                </div>
                                
                                <div class="form__row">
                                    <div class="form__group">
                                        <label for="member-2-age" class="form__label">Возраст</label>
                                        <input type="number" 
                                               id="member-2-age" 
                                               name="member-2-age" 
                                               class="form__input" 
                                               min="1" 
                                               max="120" 
                                               placeholder="Возраст">
                                    </div>
                                    
                                    <div class="form__group">
                                        <label for="member-2-gender" class="form__label">Пол</label>
                                        <select id="member-2-gender" 
                                                name="member-2-gender" 
                                                class="form__select">
                                            <option value="">Выберите пол</option>
                                            <option value="male">Мужской</option>
                                            <option value="female">Женский</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn--secondary btn--add-member">
                            <span class="btn__icon">+</span>
                            Добавить члена семьи
                        </button>
                    </fieldset>


                    <div class="form__footer">
                        <div class="form__group form__group--checkbox">
                            <input type="checkbox" 
                                   id="consent" 
                                   name="consent" 
                                   class="form__checkbox" 
                                   required>
                            <label for="consent" class="form__label form__label--checkbox">
                                Я согласен на обработку персональных данных <span class="form__required">*</span>
                            </label>
                            <span class="form__error" id="consent-error">Необходимо согласие на обработку данных</span>
                        </div>
                        
                        <button type="submit" class="btn btn--primary btn--large">Зарегистрироваться</button>
                    </div>
                </form>
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
