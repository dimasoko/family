
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.slider__slide');
    const indicators = slider.querySelectorAll('.slider__indicator');
    const prevBtn = slider.querySelector('.slider__control--prev');
    const nextBtn = slider.querySelector('.slider__control--next');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    let autoplayInterval;

    // Функция показа слайда
    function showSlide(index) {
        // Убираем активный класс у всех слайдов
        slides.forEach(slide => {
            slide.classList.remove('slider__slide--active');
        });
        
        // Убираем активный класс у всех индикаторов
        indicators.forEach(indicator => {
            indicator.classList.remove('slider__indicator--active');
        });
        
        // Добавляем активный класс нужному слайду и индикатору
        slides[index].classList.add('slider__slide--active');
        indicators[index].classList.add('slider__indicator--active');
    }

    // Следующий слайд
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    // Предыдущий слайд
    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    // Переход к конкретному слайду
    function goToSlide(index) {
        currentSlide = index;
        showSlide(currentSlide);
    }

    // Автопрокрутка
    function startAutoplay() {
        autoplayInterval = setInterval(nextSlide, 5000); // Каждые 5 секунд
    }

    function stopAutoplay() {
        clearInterval(autoplayInterval);
    }

    // Обработчики событий
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            stopAutoplay();
            startAutoplay(); // Перезапускаем автопрокрутку
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            prevSlide();
            stopAutoplay();
            startAutoplay();
        });
    }

    // Клик по индикаторам
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', () => {
            goToSlide(index);
            stopAutoplay();
            startAutoplay();
        });
    });

    // Пауза при наведении на слайдер
    slider.addEventListener('mouseenter', stopAutoplay);
    slider.addEventListener('mouseleave', startAutoplay);

    // Свайп на мобильных устройствах
    let touchStartX = 0;
    let touchEndX = 0;

    slider.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });

    slider.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        if (touchEndX < touchStartX - 50) {
            // Свайп влево
            nextSlide();
            stopAutoplay();
            startAutoplay();
        }
        if (touchEndX > touchStartX + 50) {
            // Свайп вправо
            prevSlide();
            stopAutoplay();
            startAutoplay();
        }
    }

    // Навигация клавиатурой
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') {
            prevSlide();
            stopAutoplay();
            startAutoplay();
        } else if (e.key === 'ArrowRight') {
            nextSlide();
            stopAutoplay();
            startAutoplay();
        }
    });

    // Запуск автопрокрутки
    startAutoplay();
});

document.addEventListener('DOMContentLoaded', function() {
    const reviewsSlider = document.querySelector('.reviews-slider__track');
    if (!reviewsSlider) return;

    const cards = reviewsSlider.querySelectorAll('.review-card');
    let currentIndex = 0;

    // Автоматическая прокрутка отзывов
    setInterval(() => {
        currentIndex = (currentIndex + 1) % cards.length;
        const scrollAmount = cards[currentIndex].offsetLeft;
        reviewsSlider.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
        });
    }, 6000); // Каждые 6 секунд
});

document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.querySelector('.header__theme-toggle');
    const body = document.body;
    const icon = document.querySelector('.theme-toggle__icon');

    if (!themeToggle) return;

    // Проверяем сохраненную тему
    const savedTheme = localStorage.getItem('theme') || 'dark';
    body.className = `theme-${savedTheme}`;
    updateIcon(savedTheme);

    themeToggle.addEventListener('click', () => {
        const currentTheme = body.classList.contains('theme-dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        body.className = `theme-${newTheme}`;
        localStorage.setItem('theme', newTheme);
        updateIcon(newTheme);
    });

    function updateIcon(theme) {
        if (icon) {
            icon.textContent = theme === 'dark' ? '🌙' : '☀️';
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const inputs = form.querySelectorAll('[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value.trim()) {
                    isValid = false;
                    input.style.borderColor = 'var(--color-error)';
                } else {
                    input.style.borderColor = 'var(--color-success)';
                }
            });

            if (isValid) {
                // Показываем сообщение об успехе
                const successMsg = form.querySelector('.form__message--success');
                const errorMsg = form.querySelector('.form__message--error');
                
                if (successMsg) {
                    successMsg.style.display = 'block';
                    if (errorMsg) errorMsg.style.display = 'none';
                    
                    // Скрываем через 5 секунд
                    setTimeout(() => {
                        successMsg.style.display = 'none';
                    }, 5000);
                }
            } else {
                // Показываем сообщение об ошибке
                const errorMsg = form.querySelector('.form__message--error');
                const successMsg = form.querySelector('.form__message--success');
                
                if (errorMsg) {
                    errorMsg.style.display = 'block';
                    if (successMsg) successMsg.style.display = 'none';
                    
                    setTimeout(() => {
                        errorMsg.style.display = 'none';
                    }, 5000);
                }
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const ageRange = document.getElementById('age-range');
    const ageNumber = document.getElementById('age-number');
    const ageOutput = document.querySelector('output[for="age-range"]');

    if (ageRange && ageNumber) {
        // Синхронизация range -> number
        ageRange.addEventListener('input', () => {
            ageNumber.value = ageRange.value;
            if (ageOutput) {
                ageOutput.textContent = ageRange.value;
            }
        });

        // Синхронизация number -> range
        ageNumber.addEventListener('input', () => {
            ageRange.value = ageNumber.value;
            if (ageOutput) {
                ageOutput.textContent = ageNumber.value;
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('photo');
    const fileName = document.querySelector('.form__file-name');

    if (fileInput && fileName) {
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                fileName.textContent = e.target.files[0].name;
            } else {
                fileName.textContent = 'Файл не выбран';
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const addMemberBtn = document.querySelector('.btn--add-member');
    const familyMembers = document.getElementById('family-members');
    
    if (!addMemberBtn || !familyMembers) return;

    let memberCount = 2; // У нас уже есть 2 члена семьи

    addMemberBtn.addEventListener('click', () => {
        memberCount++;
        
        const newMember = document.createElement('div');
        newMember.className = 'family-member';
        newMember.innerHTML = `
            <h3 class="family-member__title">Член семьи ${memberCount}</h3>
            <button type="button" class="family-member__remove" aria-label="Удалить члена семьи">✕</button>
            
            <div class="form__row">
                <div class="form__group">
                    <label for="member-${memberCount}-first-name" class="form__label">Имя</label>
                    <input type="text" 
                           id="member-${memberCount}-first-name" 
                           name="member-${memberCount}-first-name" 
                           class="form__input" 
                           placeholder="Имя">
                </div>
                
                <div class="form__group">
                    <label for="member-${memberCount}-last-name" class="form__label">Фамилия</label>
                    <input type="text" 
                           id="member-${memberCount}-last-name" 
                           name="member-${memberCount}-last-name" 
                           class="form__input" 
                           placeholder="Фамилия">
                </div>
            </div>
            
            <div class="form__row">
                <div class="form__group">
                    <label for="member-${memberCount}-age" class="form__label">Возраст</label>
                    <input type="number" 
                           id="member-${memberCount}-age" 
                           name="member-${memberCount}-age" 
                           class="form__input" 
                           min="1" 
                           max="120" 
                           placeholder="Возраст">
                </div>
                
                <div class="form__group">
                    <label for="member-${memberCount}-gender" class="form__label">Пол</label>
                    <select id="member-${memberCount}-gender" 
                            name="member-${memberCount}-gender" 
                            class="form__select">
                        <option value="">Выберите пол</option>
                        <option value="male">Мужской</option>
                        <option value="female">Женский</option>
                    </select>
                </div>
            </div>
        `;
        
        familyMembers.appendChild(newMember);
        
        // Добавляем обработчик удаления
        const removeBtn = newMember.querySelector('.family-member__remove');
        removeBtn.addEventListener('click', () => {
            newMember.remove();
        });
    });

    // Обработчики для существующих кнопок удаления
    const removeButtons = document.querySelectorAll('.family-member__remove');
    removeButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.target.closest('.family-member').remove();
        });
    });
});
