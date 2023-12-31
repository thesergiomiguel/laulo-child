<?php
require_once __DIR__ . '/queries.php';
require_once __DIR__ . '/rcp-helpers.php';

function get_offset() {
  return isset($_GET['offset']) ? absint($_GET['offset']) : 0;
}

function custom_get_podcasts() {
  $offset = get_offset();
  $query = get_query_podcasts(5, array('offset' => $offset));
  $posts = array();

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $post_item = array(
        'title' => get_the_title(),
        'link' => get_permalink(),
      );
      $posts[] = $post_item;
    }
  }

  wp_reset_postdata();

  return $posts;
}

function custom_get_blog() {
  $offset = get_offset();
  $query = get_query_blog(5, array('offset' => $offset));
  $posts = array();

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $post_item = array(
        'title' => get_the_title(),
        'link' => get_permalink(),
      );
      $posts[] = $post_item;
    }
  }

  wp_reset_postdata();

  return $posts;
}

function custom_get_events() {
  $offset = get_offset();
  $query = get_query_events(5, array('offset' => $offset));
  $posts = array();

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $post_item = array(
        'title' => get_the_title(),
        'link' => get_permalink(),
      );
      $posts[] = $post_item;
    }
  }

  wp_reset_postdata();

  return $posts;
}

function custom_get_members($request) {
  $offset = get_offset();
  $raw_keywords = $request->get_param('search');

  if (is_string($raw_keywords)) {
    $sanitized_keywords = sanitize_text_field($raw_keywords);
    $keywords = explode(',', $sanitized_keywords);
  } else {
    $keywords = array();
  }

  $members = get_cfc_members(5, $offset, $keywords);

  return $members;
}

function custom_register_rest_routes() {
  register_rest_route('custom/v1', '/podcasts', array(
    'methods' => 'GET',
    'callback' => 'custom_get_podcasts',
  ));

  register_rest_route('custom/v1', '/events', array(
    'methods' => 'GET',
    'callback' => 'custom_get_events',
  ));

  register_rest_route('custom/v1', '/blog', array(
    'methods' => 'GET',
    'callback' => 'custom_get_blog',
  ));

  register_rest_route('custom/v1', '/members', array(
    'methods' => 'GET',
    'callback' => 'custom_get_members',
  ));
}

add_action('rest_api_init', 'custom_register_rest_routes');
