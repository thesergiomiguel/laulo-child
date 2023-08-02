<?php
require_once __DIR__ . '/../inc/rcp-helpers.php';

$users = get_cfc_members();

if (empty($users)) {
  exit;
}
?>

<section class="PageSection Members">
  <header class="PageSection__header">
    <h2 class="PageSection__title">Find talent</h2>

    <div class="Members__filter">
      <form>
        <input type="text" placeholder="Filter by keyword or location" />
        <input type="submit" value="Submit" />
      </form>
    </div>
  </header>

  <main class="PageSection__content Members__content">
    <?php
      foreach ($users as $user) {
        echo '<pre>' . $user['display_name'] . '</pre>';
      }
    ?>
  </main>

  <footer class="PageSection__footer">
    <button>Load More ↓</button>
  </footer>
</section>
