<?php
$title = 'MHELBEAST NOTE';
$motto = 'Make it simple, make it usable.';

$posts = [
    [
        'label' => 'DESIGN',
        'title'  => 'Taking my time with layouts',
        'date'   => '2026-01-20',
        'image'  => 'images/designing.jpg',
        'excerpt' => 'I am not the fastest when it comes to designing. Sometimes I spend a lot of time thinking about spacing and colors. When everything feels right, it is worth it.'
    ],
    [
        'label' => 'GAMING',
        'title'  => 'Mobile Legends after a long day',
        'date'   => '2026-01-22',
        'image'  => 'images/ML.jpg',
        'excerpt' => 'After working on layouts, I play Mobile Legends to relax. It helps clear my mind, win or lose.'
    ],
    [
        'label' => 'GAMING',
        'title'  => 'Honor of Kings moments',
        'date'   => '2026-01-24',
        'image'  => 'images/HOK.jpg',
        'excerpt' => 'I play Honor of Kings when I want a different pace. I just enjoy the game and observe how everything feels.'
    ],
    [
        'label' => 'LEARNING',
        'title'  => 'Still learning step by step',
        'date'   => '2026-01-28',
        'image'  => 'images/learning.jpg',
        'excerpt' => 'I know my designs are not perfect. I still make mistakes and feel slow sometimes. Design is a process, and I am okay with that.'
    ],
];

$featured = $posts[3];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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

    <header class="border-b border-zinc-200 bg-zinc-50">
        <div class="container mx-auto px-8 py-10">
            <div class="flex items-center gap-4 mb-6">
                <a href="/" class="inline-flex items-center justify-center w-10 h-10 rounded-lg text-zinc-500 hover:text-zinc-900 hover:bg-zinc-200 transition-colors" title="Back to Job Seeker">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
            </div>
            <div class="text-center">
                <h1 class="text-7xl font-bold tracking-tight"><?= ($title) ?></h1>
                <p class="text-md text-zinc-500"><?= ($motto) ?></p>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8 grid gap-8 lg:grid-cols-12">

        <!-- LEFT COLUMN -->
        <aside class="lg:col-span-4 space-y-6 lg:sticky lg:top-8 self-start">

            <!-- Profile Card -->
            <div class="rounded-2xl bg-zinc-50 p-6 shadow-sm space-y-5">

                <div>
                    <h2 class="text-2xl font-semibold">Mhelveen Serrano</h2>
                    <p class="text-sm text-zinc-600">
                        Third Year IT Student, Major in Web System
                    </p>
                </div>

                <div class="space-y-3 text-sm">

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-zinc-500 text-xs">
                            ROLE:
                        </span>
                        <span class="px-3 py-1 border border-dashed border-zinc-300 rounded-md text-zinc-800">
                            Head Layout Artist
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-zinc-500 text-xs">
                            WORKS ON:
                        </span>
                        <span class="px-3 py-1 border border-dashed border-zinc-300 rounded-md text-zinc-800">
                            Pubmats, Layouts, Websites
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-zinc-500 text-xs">
                            GAMES:
                        </span>
                        <span class="px-3 py-1 border border-dashed border-zinc-300 rounded-md text-zinc-800">
                            ML, HOK
                        </span>
                    </div>

                </div>

            </div>


            <!-- About Me Card -->
            <div class="rounded-2xl bg-zinc-50 p-6 shadow-sm space-y-4">
                <p class="text-xs font-medium tracking-wide text-zinc-500">ABOUT ME</p>

                <p class="text-sm leading-relaxed text-zinc-700">
                    I am a layout artist, and I like designing things like pubmats, layouts, and websites. I enjoy working with visuals, spacing, and colors, even if sometimes it takes me time to think of a good design. I believe designing is a process, and I am still learning step by step.
                </p>

                <p class="text-sm leading-relaxed text-zinc-700">
                    Aside from designing, I am also a gamer. I usually play Mobile Legends and Honor of Kings. Gaming helps me relax and sometimes gives me ideas about UI, characters, and game design. I like observing how interfaces work inside games.
                </p>

                <p class="text-sm leading-relaxed text-zinc-700">
                    I am not the type of person who talks a lot. I am not very confident when speaking, especially in front of other people. But I am more comfortable expressing myself through design and visuals. I may be slow sometimes, but I try my best to improve and learn from my mistakes.
                </p>

                <p class="text-sm leading-relaxed text-zinc-700">
                    This blog is where I share my designs, thoughts, and progress. I do not aim to be perfect. I just want to grow, learn, and show my journey as a designer.
                </p>
            </div>

        </aside>

        <!-- RIGHT COLUMN -->
        <div class="lg:col-span-8 space-y-6">

            <!-- Featured Post -->
            <section
                class="group rounded-2xl border border-zinc-200 bg-zinc-50 overflow-hidden shadow-sm
            transition-all duration-100 hover:-translate-y-1 hover:shadow-lg">

                <div class="overflow-hidden">
                    <img
                        src="<?= ($featured['image']) ?>"
                        alt="Featured image"
                        class="w-full h-80 object-cover bg-zinc-200
                transition-transform duration-100 group-hover:scale-105">
                </div>

                <div class="p-6">
                    <p class="text-xs font-medium tracking-wide text-zinc-500">
                        LATEST • <?= ($featured['label']) ?>
                    </p>

                    <h3 class="mt-3 text-3xl font-semibold transition-colors duration-100 group-hover:text-zinc-700">
                        <?= ($featured['title']) ?>
                    </h3>

                    <p class="mt-1 text-sm text-zinc-500"><?= ($featured['date']) ?></p>

                    <p class="mt-4 text-sm leading-relaxed text-zinc-700">
                        <?= ($featured['excerpt']) ?>
                    </p>
                </div>
            </section>


            <!-- Posts -->
            <section>
                <p class="text-xs font-medium tracking-wide text-zinc-500">POSTS</p>

                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <?php foreach ($posts as $p): ?>
                        <article
                            class="group rounded-2xl border border-zinc-200 bg-zinc-50 overflow-hidden shadow-sm
                  transition-all duration-100 hover:-translate-y-1 hover:shadow-md">

                            <div class="overflow-hidden">
                                <img
                                    src="<?= ($p['image']) ?>"
                                    alt="Post image"
                                    class="w-full h-80 object-cover bg-zinc-200
                      transition-transform duration-100 group-hover:scale-105">
                            </div>

                            <div class="p-5">
                                <p class="text-[11px] font-medium tracking-wide text-zinc-500">
                                    <?= ($p['label']) ?>
                                </p>

                                <h4 class="mt-2 text-lg font-semibold transition-colors duration-100 group-hover:text-zinc-700">
                                    <?= ($p['title']) ?>
                                </h4>

                                <p class="mt-1 text-xs text-zinc-500"><?= ($p['date']) ?></p>

                                <p class="mt-3 text-sm leading-relaxed text-zinc-700">
                                    <?= ($p['excerpt']) ?>
                                </p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>

        </div>

    </main>

    <footer class="mt-12 border-t border-zinc-200 py-8 text-center text-xs text-zinc-500">
        © 2026 <?= ($title) ?>
    </footer>

</body>

</html>