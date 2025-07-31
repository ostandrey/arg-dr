<?php
/**
 * Template Name: Blog
 */
get_header();
?>

<main class="section">

    <div class="container">
        <nav aria-label="breadcrumb" class="blog-breadcrumbs mt-4">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="/">Головна</a></li>
                <li class="breadcrumb-item active" aria-current="page">Блог</li>
            </ol>
        </nav>

        <h1 class="blog-title mb-5">Блог</h1>

        <div class="row blog-grid">
            <?php
            $blog_posts = [
                [
                    'id' => 1,
                    'title' => 'Як вибрати квадрокоптер для професійного використання?',
                    'excerpt' => 'Вибір квадрокоптера для професійних завдань — це не просто питання "який дрон купити?". Це ретельний процес, що включає врахування багать...',
                    'image' => 'img/blog/drone-1.jpg',
                ],
                [
                    'id' => 2,
                    'title' => 'Як вибрати квадрокоптер для професійного використання?',
                    'excerpt' => 'Вибір квадрокоптера для професійних завдань — це не просто питання "який дрон купити?". Це ретельний процес, що включає врахування багать...',
                    'image' => 'img/blog/drone-2.jpg',
                ],
                [
                    'id' => 3,
                    'title' => 'Як вибрати квадрокоптер для професійного використання?',
                    'excerpt' => 'Вибір квадрокоптера для професійних завдань — це не просто питання "який дрон купити?". Це ретельний процес, що включає врахування багать...',
                    'image' => 'img/blog/drone-3.jpg',
                ],
                [
                    'id' => 4,
                    'title' => 'Як вибрати квадрокоптер для професійного використання?',
                    'excerpt' => 'Вибір квадрокоптера для професійних завдань — це не просто питання "який дрон купити?". Це ретельний процес, що включає врахування багать...',
                    'image' => 'img/blog/drone-4.jpg',
                ],
                [
                    'id' => 5,
                    'title' => 'Як вибрати квадрокоптер для професійного використання?',
                    'excerpt' => 'Вибір квадрокоптера для професійних завдань — це не просто питання "який дрон купити?". Це ретельний процес, що включає врахування багать...',
                    'image' => 'img/blog/drone-5.jpg',
                ],
                [
                    'id' => 6,
                    'title' => 'Як вибрати квадрокоптер для професійного використання?',
                    'excerpt' => 'Вибір квадрокоптера для професійних завдань — це не просто питання "який дрон купити?". Це ретельний процес, що включає врахування багать...',
                    'image' => 'img/blog/drone-6.jpg',
                ],
            ];

            foreach ($blog_posts as $post) :
                ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <article class="blog-card">
                        <a href="blog-post.php?id=<?php echo $post['id']; ?>" class="blog-card__link">
                            <div class="blog-card__image-wrapper">
                                <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>" class="blog-card__image">
                            </div>
                            <div class="blog-card__content">
                                <h4 class="blog-card__title"><?php echo $post['title']; ?></h4>
                                <p class="blog-card__excerpt"><?php echo $post['excerpt']; ?></p>
                            </div>
                        </a>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>

        <nav aria-label="Навігація по сторінках" class="blog-pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Попередня">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Назад</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Наступна">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Вперед</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <section class="cta">
        <div class="container">
            <div class="cta__content">
                <div class="cta__text">
                    <p class="cta__question">Маєш сумніви?</p>
                    <p class="cta__subtext">Не знаєш що тобі потрібно?</p>
                    <h3 class="cta__title">Розкажи нам свій запит і ми тобі допоможемо!</h3>
                </div>
                <div class="cta__action">
                    <a href="#form" class="cta__button">Заповнити форму</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>



