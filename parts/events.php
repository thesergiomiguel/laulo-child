<?php
$args = array(
    'post_type' => 'blog',
    'posts_per_page' => 5,
    'tax_query' => array(
        array(
            'taxonomy' => 'tag-blog',
            'field' => 'slug',
            'terms' => 'talks',
        ),
    ),
);

$events_query = new WP_Query($args);

if (!$events_query->have_posts()) {
  exit;
}
?>

<section class="PageSection EventsSection">
  <header class="PageSection__header">
    <h2 class="PageSection__title">Events</h2>
  </header>

  <main class="PageSection__content">
    <?php
    while ($events_query->have_posts()) {
        $events_query->the_post();
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
