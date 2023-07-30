<?php
/* Template Name: New Home */
get_header('newtheme');
?>

<main class="Homepage">
  <?php if (!is_user_logged_in()): ?>
    <section class="Hero">
        <header class="Hero__header">
            <h1><?php the_title(); ?></h1>
        </header>
        <main class="Hero__main">
            <aside class="Hero__animation">
                <div class="Hero__animation__window">
                    <p class="Hero__animation-item">
                        Find curatorial residencies,<br />grants, jobs and more.
                    </p>
                    <p class="Hero__animation-item">
                        Share exciting calls and<br />engage a wide audience.
                    </p>
                </div>
            </aside>
            <div class="Hero__getstarted">
                <a href="/" class="Button Button--l">Get Started</a>
            </div>
            <aside class="Hero__details">
                30-day free trial<br />€2.95/month
            </aside>
        </main>
    </section>
  <?php endif; ?>


    <? $args_destacadas = array(
		'posts_per_page'	=> 8,
		'post_type'			=> 'call',
		'meta_query' => array(
			array(
				'key'     => 'opportunity_destacada',
				'value'   => 'on',
				'compare' => '=',
			),
		),
	);

	$the_query_destacada = new WP_Query($args_destacadas); ?>

    <?php if ($the_query_destacada->have_posts()) : ?>
    <section class="Featured">
        <header class="SectionHeader">
            <h1 class="SectionHeader__heading">Featured opportunities</h1>
            <div class="SectionHeader__carousel" data-carousel="true" data-distance="1000"
                data-target="#featured-block">
                <button data-left="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="m254-469 242 241-16 16-268-268 268-268 16 16-242 241h494v22H254Z"></path>
                    </svg></button><button data-right="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="M706-469H212v-22h494L465-732l15-16 268 268-268 268-15-16 241-241Z"></path>
                    </svg>
                </button>
            </div>
        </header>
        <main class="Featured__content">
            <div id="featured-block" class="Featured__window">

                <?php
					while ($the_query_destacada->have_posts()) : $the_query_destacada->the_post();
						global $contador;
						$deadline = get_post_meta(get_the_ID(), 'opportunity_deadline', true);

						$imaxe = '<img src="' . get_template_directory_uri() . '/img/restricted.png" class="img-fluid w-100" />';
						if (rcp_is_restricted_content(get_the_ID())) {
							if (is_user_logged_in()) {
								if (rcp_user_can_access(get_current_user_id(), get_the_ID())) {
									$imaxe = get_the_post_thumbnail(get_the_ID(), 'col-3', array('class' => 'img-fluid w-100 b-w'));
								}
							}
						} else {
							$imaxe = get_the_post_thumbnail(get_the_ID(), 'col-3', array('class' => 'img-fluid w-100 b-w'));
						}

						$clase = 'col-xl-3 col-md-4 col-6 pb-4 list-post';
						if ($contador > 6) {
							$clase = 'col-xl-3 col-md-4 col-6 pb-4 list-post maior_de_seis';
						}
						if ($contador > 9) {
							$clase = 'col-xl-3 col-md-4 col-6 pb-4 list-post maior_de_seis maior_de_nove';
						}
					?>
                <article class="Call">
                    <a href="<?php echo get_permalink(); ?>">
                        <header class="Call__header">
                            <div class="Call__title">
                                <?php the_title(); ?>
                            </div>
                            <div class="Call__location capitalise"><?php $taxonomy = 'city'; // Replace 'your_custom_taxonomy' with the name of your custom taxonomy.

																			// Get the terms for the given post and custom taxonomy.
																			$terms = wp_get_post_terms(get_the_ID(), $taxonomy);

																			// Check if there are any terms for the post.
																			if (!empty($terms) && !is_wp_error($terms)) {
																				$term_names = array();
																				foreach ($terms as $term) {
																					$term_names[] = $term->name;
																				}
																				echo implode(', ', $term_names);
																			} else {
																				//echo 'No City found for this post.';
																			} ?></div>
                        </header>
                        <main class="Call__thumbnail">
                            <?= $imaxe ?>
                        </main>
                        <footer class="Call__footer">

                            <div class="Call__type capitalise"><?php $taxonomy = 'type'; // Replace 'your_custom_taxonomy' with the name of your custom taxonomy.

																		// Get the terms for the given post and custom taxonomy.
																		$terms = wp_get_post_terms(get_the_ID(), $taxonomy);

																		// Check if there are any terms for the post.
																		if (!empty($terms) && !is_wp_error($terms)) {
																			$term_names = array();
																			foreach ($terms as $term) {
																				$term_names[] = $term->name;
																			}
																			echo implode(', ', $term_names);
																		} else {
																			//echo 'No terms found for this post.';
																		} ?></div>
                            <div class="Call__timestamp">
                                <?php if ($deadline) { ?>
                                <?php if (laulo_deadline_ended($deadline)) { ?>

                                <span class="capitalise">Deadline Ended</span>

                                <?php } else { ?>

                                <?php echo laulo_get_time_left($deadline); ?>

                                <?php } ?>
                                <?php } else { ?>

                                <?php _e('No deadline'); ?>

                                <?php } ?>


                            </div>
                        </footer>
                    </a>
                </article>
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>

            </div>
        </main>
        <footer class="SectionFooter">
            <h2><a href="<?php echo home_url(); ?>/call">More opportunities →</a></h2>
        </footer>
    </section>
    <?php endif; ?>

    <?php
	$args = array(
		'post_type'			=> 'blog',
		'posts_per_page'	=> 4,
	);

	$the_query = new WP_Query($args); ?>

    <?php if ($the_query->have_posts()) : ?>
    <section class="Editorial">
        <header class="SectionHeader">
            <h1 class="SectionHeader__heading">Editorial</h1>
            <div class="SectionHeader__carousel" data-carousel="true" data-distance="1000"
                data-target="#editorial-block">
                <button data-left="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="m254-469 242 241-16 16-268-268 268-268 16 16-242 241h494v22H254Z"></path>
                    </svg></button><button data-right="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="M706-469H212v-22h494L465-732l15-16 268 268-268 268-15-16 241-241Z"></path>
                    </svg>
                </button>
            </div>
        </header>
        <main class="Editorial__content">
            <div id="editorial-block" class="Editorial__window">




                <?php while ($the_query->have_posts()) : $the_query->the_post();
						$thumbnail_url = get_the_post_thumbnail_url(); ?>
                <article class="BlogPost">
                    <a href="<?php echo get_permalink(); ?>">
                        <div class="BlogPost__title"
                            <?php if ($thumbnail_url != '') { ?>style="--post-img-src: url(<?= $thumbnail_url ?>)"
                            <?php } ?>>
                            <?php the_title(); ?>
                        </div>
                    </a>
                    <div class="BlogPost__author">
                        <?php // Get the post author's display name
								echo $author_display_name = get_the_author_meta('display_name', $post_id);
								?>
                        <span class="BlogPost__tags">

                            <?php $taxonomy = 'tag-blog'; // Replace 'your_custom_taxonomy' with the name of your custom taxonomy.

									// Get the terms for the given post and custom taxonomy.
									$terms = wp_get_post_terms(get_the_ID(), $taxonomy);

									// Check if there are any terms for the post.

									if (!empty($terms) && !is_wp_error($terms)) {

										foreach ($terms as $term) {
											echo '<a href="' . esc_url(get_term_link($term)) . '">#' . $term->name . '</a>';
										}
									} else {
										//echo 'No terms found for this post.';
									}
									?>


                        </span>
                    </div>
                </article>
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>
            </div>
        </main>
        <footer class="SectionFooter">
            <a href="/blog">
                <h2>All Editorials →</h2>
            </a>
        </footer>
    </section>

    <?php endif; ?>
    <?php
	$args = array(
		'post_type'			=> 'testimony',
		'posts_per_page'	=> 4,
		'meta_query' => array(
			array(
				'key'     => 'testimonio_empresa',
				'value'   => 'on',
				'compare' => 'NOT EXISTS',
			),
		),
	);

	$the_query = new WP_Query($args); ?>

    <?php if ($the_query->have_posts()) : ?>
    <section class="Testimonials">
        <header class="SectionHeader">
            <h1 class="SectionHeader__heading">Testimonials</h1>
            <div class="SectionHeader__carousel" data-carousel="true" data-distance="block"
                data-target="#testimony-block">
                <button data-left="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="m254-469 242 241-16 16-268-268 268-268 16 16-242 241h494v22H254Z"></path>
                    </svg></button><button data-right="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                        <path d="M706-469H212v-22h494L465-732l15-16 268 268-268 268-15-16 241-241Z"></path>
                    </svg>
                </button>
            </div>
        </header>

        <main class="Testimonials__content">
            <div id="testimony-block" class="Testimonials__window">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <article class="TestimonialPost">
                    <div class="TestimonialPost__content">
                        <?php the_content(); ?>
                        <article class="TestimonialPost__author">
                          <?php the_title(); ?>
                        </article>
                    </div>
                </article>
                <?php endwhile; ?>
            </div>
        </main>


        <?php wp_reset_postdata(); ?>

    </section>

    <section class="Institutions">
      <header class="SectionHeader">
        <h1 class="SectionHeader__heading">Institutions we help</h1>
      </header>
      <main class="Institutions__content">
        <div class="Institutions__container">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/institutions/apexart.png" alt="apexart">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/institutions/harvard.png" alt="Harvard">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/institutions/node.png" alt="NODE">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/institutions/tate.png" alt="Tate">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/institutions/barbican.png" alt="Barbican">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/institutions/CCOA.png" alt="CCOA">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/institutions/hammer.png" alt="Hammer">
        </div>
      </main>
    </section>
    <?php endif; ?>
</main>

<?php get_footer('newtheme'); ?>
