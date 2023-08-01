<?php
function get_query_blog() {}

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

  // var_dump($merged);

  return new WP_Query($merged);
}

function get_query_events() {}
