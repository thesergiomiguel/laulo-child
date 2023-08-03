<?php
get_header('newtheme');
?>

<main class="Page">
  <?php if (have_posts()): while (have_posts()) : the_post(); ?>

  <header class="Page__heading">
    <h1><?php the_title(); ?></h1>
  </header>

  <main class="Page__content">
    <?php the_content(); ?>
  </main>

  <?php endwhile; endif; ?>
</main>

<?php
get_footer('newtheme');
?>
