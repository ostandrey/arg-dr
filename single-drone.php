<?php
/**
 * Single
 *
 * Loop container for single post content
 */
get_header(); ?>

<main>
    <?php
    // product-detail.php
    ?>
    <div class="product-detail">
        <div class="breadcrumbs">
            <div class="container">
                <ul class="breadcrumbs__list">
                    <li class="breadcrumbs__item"><a href="/" class="breadcrumbs__link">Головна</a></li>
                    <li class="breadcrumbs__item"><a href="/drones" class="breadcrumbs__link">Дрони</a></li>
                    <li class="breadcrumbs__item">8 shooter</li>
                </ul>
            </div>
        </div>

        <section class="product-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-gallery">
                            <div class="product-gallery__main">
                                <img src="img/products/8-shooter-main.jpg" alt="8 shooter" class="img-fluid" id="mainProductImage">
                                <div class="product-gallery__nav">
                                    <button class="product-gallery__arrow product-gallery__arrow--prev">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="product-gallery__arrow product-gallery__arrow--next">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="product-gallery__thumbs">
                                <div class="product-gallery__thumb active" data-image="img/products/8-shooter-main.jpg">
                                    <img src="img/products/8-shooter-thumb-1.jpg" alt="8 shooter thumbnail 1">
                                </div>
                                <div class="product-gallery__thumb" data-image="img/products/8-shooter-angle-1.jpg">
                                    <img src="img/products/8-shooter-thumb-2.jpg" alt="8 shooter thumbnail 2">
                                </div>
                                <div class="product-gallery__thumb" data-image="img/products/8-shooter-angle-2.jpg">
                                    <img src="img/products/8-shooter-thumb-3.jpg" alt="8 shooter thumbnail 3">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="product-info">
                            <h1 class="product-info__title">8 shooter</h1>
                            <div class="product-info__description">
                                <p>FPV-дрон з діагоналлю 8 дюймів, висотою до 4500 м, швидкістю до 120 км/год. Призначений для ураження повітряних цілей. Має підвищену стійкість до РЕБ, тривалий час автономної роботи та високу дальність дії.</p>
                            </div>

                            <div class="product-info__specs">
                                <div class="product-info__spec">
                                    <div class="product-info__spec-label">Стійкість до перешкод (РЕБ)</div>
                                    <div class="product-info__spec-value">Висока</div>
                                </div>
                                <div class="product-info__spec">
                                    <div class="product-info__spec-label">Час польоту (при повному заряді)</div>
                                    <div class="product-info__spec-value">15 хв</div>
                                </div>
                                <div class="product-info__spec">
                                    <div class="product-info__spec-label">Дальність</div>
                                    <div class="product-info__spec-value">10 км</div>
                                </div>
                            </div>

                            <div class="product-info__actions">
                                <button class="btn btn-primary btn-lg product-info__buy">Замовити</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="product-description">
            <div class="container">
                <h2 class="section-title">Опис</h2>

                <div class="product-features">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="product-feature">
                                <div class="product-feature__icon">
                                    <i class="fas fa-cogs"></i>
                                </div>
                                <h3 class="product-feature__title">Багатофункціональність</h3>
                                <p class="product-feature__text">Використовується як для розвідки та коригування вогню, так і для ураження повітряних цілей. Може бути оснащений різними типами корисного навантаження в залежності від завдання.</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-feature">
                                <div class="product-feature__icon">
                                    <i class="fas fa-video"></i>
                                </div>
                                <h3 class="product-feature__title">FPV-управління з камерою</h3>
                                <p class="product-feature__text">Оснащений HD-камерою з передачею відеосигналу в реальному часі. Оператор бачить все, що бачить дрон, що дозволяє точно маневрувати та ефективно виконувати бойові завдання.</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-feature">
                                <div class="product-feature__icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h3 class="product-feature__title">Стійкість до РЕБ</h3>
                                <p class="product-feature__text">Спеціальне програмне забезпечення та апаратні рішення забезпечують високу стійкість до засобів радіоелектронної боротьби. Дрон зберігає керованість навіть в умовах активної протидії.</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="product-feature">
                                <div class="product-feature__icon">
                                    <i class="fas fa-broadcast-tower"></i>
                                </div>
                                <h3 class="product-feature__title">Висока дальність дії</h3>
                                <p class="product-feature__text">Радіус дії до 10 км дозволяє виконувати завдання на значній відстані від оператора, що підвищує безпеку особового складу та ефективність бойового застосування.</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-feature">
                                <div class="product-feature__icon">
                                    <i class="fas fa-gamepad"></i>
                                </div>
                                <h3 class="product-feature__title">Простота керування</h3>
                                <p class="product-feature__text">Інтуїтивно зрозуміле керування дозволяє швидко освоїти роботу з дроном. Навчання оператора займає мінімальний час, що особливо важливо в умовах бойових дій.</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="product-feature">
                                <div class="product-feature__icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <h3 class="product-feature__title">Надійність у польових умовах</h3>
                                <p class="product-feature__text">Конструкція дрона розрахована на експлуатацію в складних погодних та бойових умовах. Висока надійність забезпечує стабільне виконання завдань.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-gallery-additional">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="product-gallery-additional__item">
                                <img src="img/products/8-shooter-large-1.jpg" alt="8 shooter view 1" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-gallery-additional__item">
                                <img src="img/products/8-shooter-large-2.jpg" alt="8 shooter view 2" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="product-gallery-additional__item">
                                <img src="img/products/8-shooter-large-3.jpg" alt="8 shooter view 3" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="product-gallery-additional__item">
                                <img src="img/products/8-shooter-large-4.jpg" alt="8 shooter view 4" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="product-specs">
            <div class="container">
                <h2 class="section-title">Характеристики</h2>

                <div class="product-specs__table">
                    <div class="product-specs__group">
                        <h3 class="product-specs__group-title">Основні характеристики</h3>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Тип</div>
                            <div class="product-specs__cell product-specs__cell--value">Квадрокоптер FPV</div>
                            <div class="product-specs__cell product-specs__cell--name">Маса у спорядженому стані</div>
                            <div class="product-specs__cell product-specs__cell--value">800 г</div>
                        </div>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Діагональ рами</div>
                            <div class="product-specs__cell product-specs__cell--value">8 дюймів</div>
                            <div class="product-specs__cell product-specs__cell--name">Максимальна висота польоту</div>
                            <div class="product-specs__cell product-specs__cell--value">4500 м</div>
                        </div>
                    </div>

                    <div class="product-specs__group">
                        <h3 class="product-specs__group-title">Управління</h3>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Тип</div>
                            <div class="product-specs__cell product-specs__cell--value">FPV</div>
                            <div class="product-specs__cell product-specs__cell--name">Частота</div>
                            <div class="product-specs__cell product-specs__cell--value">2.4 ГГц, 5.8 ГГц (автоматичний вибір 915 МГц)</div>
                        </div>
                    </div>

                    <div class="product-specs__group">
                        <h3 class="product-specs__group-title">Відеосистема</h3>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Прошивка</div>
                            <div class="product-specs__cell product-specs__cell--value">Betaflight / Inav / Ardupilot</div>
                            <div class="product-specs__cell product-specs__cell--name">Роздільна здатність</div>
                            <div class="product-specs__cell product-specs__cell--value">1080p HD</div>
                        </div>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Передавач</div>
                            <div class="product-specs__cell product-specs__cell--value">Регульований</div>
                            <div class="product-specs__cell product-specs__cell--name">Затримка</div>
                            <div class="product-specs__cell product-specs__cell--value">25-30 мс</div>
                        </div>
                    </div>

                    <div class="product-specs__group">
                        <h3 class="product-specs__group-title">Двигуни</h3>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Тип</div>
                            <div class="product-specs__cell product-specs__cell--value">Безколекторні</div>
                            <div class="product-specs__cell product-specs__cell--name">Розмір</div>
                            <div class="product-specs__cell product-specs__cell--value">2306-2450KV</div>
                        </div>
                    </div>

                    <div class="product-specs__group">
                        <h3 class="product-specs__group-title">Регулятор</h3>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Тип</div>
                            <div class="product-specs__cell product-specs__cell--value">ESC 4-in-1 35A</div>
                            <div class="product-specs__cell product-specs__cell--name">Розмір</div>
                            <div class="product-specs__cell product-specs__cell--value">30.5x30.5 мм</div>
                        </div>
                    </div>

                    <div class="product-specs__group">
                        <h3 class="product-specs__group-title">Фізичні характеристики</h3>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Матеріал рами</div>
                            <div class="product-specs__cell product-specs__cell--value">Карбон / пластик / алюміній</div>
                            <div class="product-specs__cell product-specs__cell--name">Тримачі акумулятора</div>
                            <div class="product-specs__cell product-specs__cell--value">Ремінці</div>
                        </div>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Розміри (ДхШхВ)</div>
                            <div class="product-specs__cell product-specs__cell--value">220x220x50 мм</div>
                            <div class="product-specs__cell product-specs__cell--name">Колір</div>
                            <div class="product-specs__cell product-specs__cell--value">Чорний / Сірий</div>
                        </div>
                    </div>

                    <div class="product-specs__group">
                        <h3 class="product-specs__group-title">Електроніка</h3>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Польотний контролер</div>
                            <div class="product-specs__cell product-specs__cell--value">F7 / H7</div>
                            <div class="product-specs__cell product-specs__cell--name">Захист від перенапруги</div>
                            <div class="product-specs__cell product-specs__cell--value">Так</div>
                        </div>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Конфігурація мотора</div>
                            <div class="product-specs__cell product-specs__cell--value">4S-6S</div>
                            <div class="product-specs__cell product-specs__cell--name">Підтримка на борту</div>
                            <div class="product-specs__cell product-specs__cell--value">GPS, Buzzer</div>
                        </div>

                        <div class="product-specs__row">
                            <div class="product-specs__cell product-specs__cell--name">Максимальна потужність</div>
                            <div class="product-specs__cell product-specs__cell--value">2700 Вт</div>
                            <div class="product-specs__cell product-specs__cell--name">Робоча напруга</div>
                            <div class="product-specs__cell product-specs__cell--value">14.8В - 22.2В</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    </main>
<?php $footer = get_field('footer');
$location_footer = get_field('location_footer', 'options');
if ($footer) { ?>
    <footer class="location-footer">
        <div class="container">
            <?php echo $location_footer; ?>
        </div>
    </footer>
    <?php wp_footer(); ?>
    <?php if ($ada_script = get_field('ada', 'options')) : ?>
        <?php echo $ada_script; ?>
    <?php endif; ?>
    </body>
    </html>
<?php } else { ?>
    <?php get_footer(); ?>
<?php } ?>
