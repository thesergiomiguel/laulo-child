<?php
require_once __DIR__ . '/../inc/queries.php';

$podcasts_query = get_query_podcasts(3, array('posts_per_page' => 0));

if (!$podcasts_query->have_posts()) {
  exit;
}
?>

<section class="PageSection PodcastsSection">
  <header class="PageSection__header">
    <h2 class="PageSection__title">Podcasts</h2>
  </header>

  <main class="PageSection__content">
    <?php
    while ($podcasts_query->have_posts()) {
        $podcasts_query->the_post();
        echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
        echo '<div>' . get_the_excerpt() . '</div>';
    }

    wp_reset_postdata();
    ?>
  </main>

  <footer class="PageSection__footer">
    <button>Load More ↓</button>
  </footer>
</section>
