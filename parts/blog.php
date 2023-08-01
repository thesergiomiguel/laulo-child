<?php
$args = array(
    'post_type' => 'blog',
    'posts_per_page' => 5,
    'tax_query' => array(
        array(
            'taxonomy' => 'tag-blog',
            'field' => 'slug',
            'terms' => 'podcast',
            'operator' => 'NOT IN',
        ),
    ),
);

$blog_query = new WP_Query($args);

if (!$blog_query->have_posts()) {
  exit;
}
?>

<section class="PageSection BlogSection">
  <header class="PageSection__header">
    <h2 class="PageSection__title">Blog</h2>
  </header>

  <main class="PageSection__content">
    <?php
    while ($blog_query->have_posts()) {
        $blog_query->the_post();
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

