<?php if ( is_home() ) : ?>
	<div id="pre-footer">
		<div class="container">
			<p class="tagline"><?php bloginfo( 'description' ); ?></p>

			<br />

			<?php et_vertex_action_button(); ?>
		</div> <!-- .container -->
	</div> <!-- #pre-footer -->
<?php endif; ?>

	<footer id="main-footer">
		<div class="container">
			<?php get_sidebar( 'footer' ); ?>

                        <div>
				
				<p class="footer-text">Desenvolvido por <img src="http://localhost/Harpia/wp-content/uploads/2014/11/acens-email.png"></p>
			</div>
		</div> <!-- .container -->
	</footer> <!-- #main-footer -->

	<?php wp_footer(); ?>
</body>
</html>