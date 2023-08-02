<?php
/*
 * Helpers for Restrict Content.
 */
function get_cfc_members($limit = 5, $offset = 0, $keywords = array()) {
  global $wpdb;

  $table_name = $wpdb->prefix . 'rcp_memberships';

  $query = "
  SELECT user_id
  FROM $table_name
  WHERE status = 'active'
  ";

  if (!empty($keywords)) {
    $keyword_conditions = array();

    foreach ($keywords as $keyword) {
      $keyword_conditions[] = "(
      user_id IN (SELECT user_id FROM {$wpdb->usermeta} WHERE meta_key = 'description' AND meta_value LIKE '%$keyword%')
      OR user_id IN (SELECT ID FROM {$wpdb->users} WHERE user_email LIKE '%$keyword%')
      OR user_id IN (SELECT ID FROM {$wpdb->users} WHERE display_name LIKE '%$keyword%')
      )";
    }

    $query .= " AND (" . implode(' OR ', $keyword_conditions) . ")";
  }

  $query .= " LIMIT $limit OFFSET $offset";

  $user_ids = $wpdb->get_col($query);
  $users_properties = array();

  if (!empty($user_ids)) {
    foreach ($user_ids as $user_id) {
      $user = get_userdata($user_id);
      $user_properties = array(
        'id' => $user->ID,
        'display_name' => $user->display_name,
        'biography' => get_user_meta($user->ID, 'description', true)
      );
      $users_properties[] = $user_properties;
    }
  }

  return $users_properties;
}
