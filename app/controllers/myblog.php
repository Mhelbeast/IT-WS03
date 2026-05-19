<?php
$title = 'MHELBEAST NOTE';
$motto = 'Make it simple, make it usable.';

$posts = [
    [
        'id' => 0,
        'label' => 'DESIGN',
        'title'  => 'Taking my time with layouts',
        'date'   => '2026-01-20',
        'image'  => 'images/designing.jpg',
        'excerpt' => 'I am not the fastest when it comes to designing. Sometimes I spend a lot of time thinking about spacing and colors. When everything feels right, it is worth it.',
        'content' => 'I am not the fastest when it comes to designing. Sometimes I spend a lot of time thinking about spacing and colors. When everything feels right, it is worth it. Designing is not just about making things look pretty—it\'s about creating a visual language that communicates clearly and feels intuitive. Every element has a purpose, every color is chosen, and every space is considered. That\'s what makes good design.'
    ],
    [
        'id' => 1,
        'label' => 'GAMING',
        'title'  => 'Mobile Legends after a long day',
        'date'   => '2026-01-22',
        'image'  => 'images/ML.jpg',
        'excerpt' => 'After working on layouts, I play Mobile Legends to relax. It helps clear my mind, win or lose.',
        'content' => 'After working on layouts, I play Mobile Legends to relax. It helps clear my mind, win or lose. Gaming is my way of unwinding from the intensity of design work. The fast-paced gameplay, strategic thinking, and teamwork required make it the perfect counterbalance to creative problem-solving. Whether we win or lose, the important thing is the time away from screens and pixels.'
    ],
    [
        'id' => 2,
        'label' => 'GAMING',
        'title'  => 'Honor of Kings moments',
        'date'   => '2026-01-24',
        'image'  => 'images/HOK.jpg',
        'excerpt' => 'I play Honor of Kings when I want a different pace. I just enjoy the game and observe how everything feels.',
        'content' => 'I play Honor of Kings when I want a different pace. I just enjoy the game and observe how everything feels. This game offers a different kind of gameplay compared to other MOBAs, with unique mechanics and character designs. What fascinates me most is observing the UI design, the visual hierarchy, and how the interface guides player actions. It\'s both relaxing and educational from a design perspective.'
    ],
    [
        'id' => 3,
        'label' => 'LEARNING',
        'title'  => 'Still learning step by step',
        'date'   => '2026-01-28',
        'image'  => 'images/learning.jpg',
        'excerpt' => 'I know my designs are not perfect. I still make mistakes and feel slow sometimes. Design is a process, and I am okay with that.',
        'content' => 'I know my designs are not perfect. I still make mistakes and feel slow sometimes. Design is a process, and I am okay with that. Every mistake is a lesson, every iteration brings me closer to my vision. I don\'t compare my progress to others—I compare it to where I was yesterday. Growth doesn\'t happen overnight, but it happens consistently. This blog is a testament to my journey, and I\'m proud of every step.'
    ],
];

// Get post ID from query string if viewing a single post
$viewPostId = isset($_GET['post']) ? (int) $_GET['post'] : null;
$viewPost = null;

if ($viewPostId !== null) {
    foreach ($posts as $post) {
        if ($post['id'] === $viewPostId) {
            $viewPost = $post;
            break;
        }
    }
}

$featured = $posts[3];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <title><?= ($title) ?></title>
</head>

<body class="bg-zinc-100 text-zinc-900 font-sans">

    <!-- Navigation Bar -->
    <nav class="blog-nav" <?php if ($viewPost) echo 'style="display: none;"'; ?>>
        <div class="container mx-auto px-6 blog-nav-container">
            <a href="/" class="blog-nav-back" title="Back to Home">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
            <div class="flex-1 text-center">
                <p class="blog-nav-label">BLOG</p>
            </div>
            <div class="w-10"></div>
        </div>
    </nav>

    <!-- Header -->
    <header class="blog-header" <?php if ($viewPost) echo 'style="display: none;"'; ?>>
        <div class="container mx-auto px-6">
            <h1 class="blog-header-title"><?= ($title) ?></h1>
            <p class="blog-header-subtitle"><?= ($motto) ?></p>
        </div>
    </header>

    <main class="container mx-auto px-6 blog-main">

        <?php if ($viewPost): ?>
            <!-- SINGLE POST VIEW -->
            <div class="blog-single-post" style="grid-column: span 12;">
                <a href="/myblog" class="blog-back-link" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--primary); text-decoration: none; margin-bottom: 2rem; font-weight: 500;">
                    <i class="fas fa-arrow-left"></i> Back to Posts
                </a>

                <article class="blog-card" style="overflow: hidden;">
                    <div class="blog-featured-image" style="height: 32rem;">
                        <img src="<?= ($viewPost['image']) ?>" alt="<?= ($viewPost['title']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>

                    <div class="blog-featured-content" style="padding: 3rem;">
                        <p class="blog-featured-label">
                            <span class="blog-featured-label-dot"></span><?= ($viewPost['label']) ?>
                        </p>

                        <h1 class="blog-post-single-title" style="font-size: 2.5rem; font-weight: 900; color: var(--foreground); margin: 1rem 0;">
                            <?= ($viewPost['title']) ?>
                        </h1>

                        <p class="blog-featured-date">
                            <i class="far fa-calendar-alt mr-2"></i><?= ($viewPost['date']) ?>
                        </p>

                        <div class="blog-post-single-content" style="font-size: 1.125rem; line-height: 1.8; color: var(--foreground); margin-top: 2rem;">
                            <p><?= ($viewPost['content']) ?></p>
                        </div>
                    </div>
                </article>
            </div>
        <?php else: ?>
            <!-- BLOG LIST VIEW -->

            <!-- LEFT COLUMN -->
            <aside class="blog-sidebar">

                <!-- Profile Card -->
                <div class="blog-card blog-card-padding">

                    <div class="blog-card-divider">
                        <h2 class="blog-card-title">Mhelveen Serrano</h2>
                        <p class="blog-card-subtitle">
                            Third Year IT Student, Major in Web System
                        </p>
                    </div>

                    <div class="space-y-3 text-sm">

                        <div class="blog-info-row">
                            <span class="blog-info-label">
                                Role
                            </span>
                            <span class="blog-info-badge">
                                Head Layout Artist
                            </span>
                        </div>

                        <div class="blog-info-row">
                            <span class="blog-info-label">
                                Works On
                            </span>
                            <span class="blog-info-badge">
                                Pubmats, Layouts, Websites
                            </span>
                        </div>

                        <div class="blog-info-row">
                            <span class="blog-info-label">
                                Games
                            </span>
                            <span class="blog-info-badge">
                                ML, HOK
                            </span>
                        </div>

                    </div>

                </div>


                <!-- About Me Card -->
                <div class="blog-card blog-card-padding">
                    <div class="blog-card-divider">
                        <p class="blog-card-title" style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; margin: 0;">About Me</p>
                    </div>

                    <div class="space-y-4">
                        <p style="font-size: 0.875rem; line-height: 1.5; color: var(--muted-foreground);">
                            I am a layout artist who loves designing pubmats, layouts, and websites. I enjoy working with visuals, spacing, and colors. Even if it takes me time, I believe that when everything feels right, it is worth it.
                        </p>

                        <p style="font-size: 0.875rem; line-height: 1.5; color: var(--muted-foreground);">
                            Besides design, I am also a gamer. I play Mobile Legends and Honor of Kings to relax. Gaming gives me ideas about UI and game design, and I enjoy observing how interfaces work inside games.
                        </p>

                        <p style="font-size: 0.875rem; line-height: 1.5; color: var(--muted-foreground);">
                            I may not be the most confident when speaking, but I express myself best through design and visuals. I'm always learning and trying to improve from my mistakes.
                        </p>
                    </div>
                </div>

            </aside>

            <!-- RIGHT COLUMN -->
            <div class="blog-content">

                <!-- Featured Post -->
                <section class="blog-card blog-featured">

                    <div class="blog-featured-image">
                        <img
                            src="<?= ($featured['image']) ?>"
                            alt="Featured image">
                    </div>

                    <div class="blog-featured-content">
                        <p class="blog-featured-label">
                            <span class="blog-featured-label-dot"></span>Latest • <?= ($featured['label']) ?>
                        </p>

                        <h3 class="blog-featured-title">
                            <?= ($featured['title']) ?>
                        </h3>

                        <p class="blog-featured-date">
                            <i class="far fa-calendar-alt mr-2"></i><?= ($featured['date']) ?>
                        </p>

                        <p class="blog-featured-excerpt">
                            <?= ($featured['excerpt']) ?>
                        </p>

                        <a href="/myblog?post=<?= ($featured['id']) ?>" class="blog-featured-link">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </section>


                <!-- Posts Section -->
                <section>
                    <div class="blog-posts-header">
                        <h2 class="blog-posts-title">All Posts</h2>
                        <div class="blog-posts-divider"></div>
                    </div>

                    <div class="blog-posts-grid">
                        <?php foreach ($posts as $p): ?>
                            <article class="blog-card blog-post-article">

                                <div class="blog-post-image">
                                    <img
                                        src="<?= ($p['image']) ?>"
                                        alt="Post image">
                                </div>

                                <div class="blog-post-content">
                                    <p class="blog-post-label">
                                        <span class="blog-post-label-dot"></span><?= ($p['label']) ?>
                                    </p>

                                    <h4 class="blog-post-title">
                                        <?= ($p['title']) ?>
                                    </h4>

                                    <p class="blog-post-date">
                                        <i class="far fa-calendar-alt mr-1"></i><?= ($p['date']) ?>
                                    </p>

                                    <p class="blog-post-excerpt">
                                        <?= ($p['excerpt']) ?>
                                    </p>

                                    <a href="/myblog?post=<?= ($p['id']) ?>" class="blog-post-link">
                                        Read More →
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </section>

            </div>

        <?php endif; ?>

    </main>

    <footer class="blog-footer">
        <div class="container mx-auto px-6">
            <p class="blog-footer-text">© 2026 <?= ($title) ?> — All rights reserved</p>
        </div>
    </footer>

</body>

</html>