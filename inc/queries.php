<?php
function get_query_blog($limit = 5, $extra_args = array()) {
  $args = array(
    'post_type' => 'blog',
    'posts_per_page' => $limit,
    'tax_query' => array(
      array(
        'taxonomy' => 'tag-blog',
        'field' => 'slug',
        'terms' => 'podcast',
        'operator' => 'NOT IN',
      ),
    ),
  );

  $merged = array_merge($args, $extra_args);

  return new WP_Query($merged);
}

function get_query_podcasts($limit = 5, $extra_args = array()) {
  $args = array(
    'post_type' => 'blog',
    'posts_per_page' => $limit,
    'tax_query' => array(
      array(
        'taxonomy' => 'tag-blog',
        'field' => 'slug',
        'terms' => 'podcast',
      )
    )
  );

  $merged = array_merge($args, $extra_args);

  return new WP_Query($merged);
}

function get_query_events($limit = 5, $extra_args = array()) {
  $args = array(
    'post_type' => 'blog',
    'posts_per_page' => $limit,
    'tax_query' => array(
      array(
        'taxonomy' => 'tag-blog',
        'field' => 'slug',
        'terms' => 'talks',
      ),
    ),
  );

  $merged = array_merge($args, $extra_args);

  return new WP_Query($merged);
}
