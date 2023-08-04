<footer class="Footer" id="main-footer">
	<section class="Newsletter">
		<article class="Newsletter__wrapper">
			<header class="Newsletter__header">Newsletter</header>
			<main class="Newsletter__input">
				<input type="email" placeholder="Your email address" />
			</main>
			<footer class="Newsletter__footer"><button>→</button></footer>
		</article>
	</section>
	<section class="Footer__navs">
		<nav class="Footer__navs--sitemap">
			<ul>
				<li>
					<article class="Footer__copyright">© <?= date("Y"); ?></article>
				</li>
				<li><a href="/about-call-for-curators/">About</a></li>
        <li>
          <a data-open-sidebar="contact-sidebar">Contact</a>
        </li>
        <li><a href="/copyright-and-legal-notices/">Copyright &amp; legal notices</a></li>
        <li><a href="/cookie-policy">Cookies policy</a></li>
			</ul>
		</nav>
		<nav class="Footer__navs--social">
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-social')) ?>
		</nav>
	</section>
</footer>
<div class="NewsletterBar" id="newsletter-widget">
	<header class="NewsletterBar__title">
		<h2>Newsletter</h2>
	</header>
	<main class="NewsletterBar__content">
		<input type="email" placeholder="Your email address" class="NewsletterBar__input" /><button class="Button Button--rounded">→</button>
	</main>
	<footer class="NewsletterBar__footer">
		<button class="Button" id="newsletter-bar-dismiss">
			<svg viewBox="0 0 30.707 30.707">
				<g fill="none" stroke="#fff" data-name="Group 17">
					<path d="m30.354.354-30 30" data-name="Line 57"></path>
					<path d="m.354.354 30 30" data-name="Line 58"></path>
				</g>
			</svg>
		</button>
	</footer>
</div>
<aside class="Login" id="sidebar-login">

	<form id="custom-login-form">

		<div class="Login__container">
			<input type="text" placeholder="User/email" class="Login__input" required="" name="username" id="username" value="" size="20" autocapitalize="off" /><input type="password" placeholder="Password" class="Login__input" required="" name="password" id="password" value="" size="20" />
		</div>
		<div class="Login__forgot"><a href="">Lost your password?</a></div>

		<label class="Login__remember"><input name="rememberme" type="checkbox" id="rememberme" value="forever" />
			<?php _e('Remember Me', 'textdomain'); ?><input type="submit" class="Login__submit" value="Login" name="wp-submit" id="wp-submit" />
			<?php wp_nonce_field('custom-login-nonce', 'security'); ?>
			<div id="custom-login-message"></div>

			<div class="Login__register">
				<span class="Login__register-text">New to the site?</span><a href="/registration" class="Login__register-link"><span class="underline">Register here</span></a>
			</div>

	</form>
</aside>

<?php get_template_part('parts/shared/sidebar-contact'); ?>

<div class="Sidebar__backdrop"></div>
</div>
<script src="<?= get_stylesheet_directory_uri() ?>/client-init.js"></script>
<script>
	jQuery(document).ready(function($) {
		$('#custom-login-form').on('submit', function(e) {
			e.preventDefault();

			var formData = $(this).serialize();
			$('#custom-login-message').html(
				'<img src="<?= get_stylesheet_directory_uri() ?>/assets/loader.gif" width="100px" />');
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: fm_user_I18n.ajaxurl,
				data: formData + '&action=custom_login&security=' + $('#security').val(),
				success: function(response) {
					if (response.success) {
						// Redirect to the same page after successful login
						window.location.href = window.location.href;
					} else {
						$('#custom-login-message').html('<h3 class="error">' + response
							.message +
							'</h3>');
					}
				}
			});
		});
	});
</script>
</body>

</html>
