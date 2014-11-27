<?php if ( is_home() ) : ?>
	<div id="pre-footer">
		<div class="container">

			<br />

			<?php et_vertex_action_button(); ?>
		</div> <!-- .container -->
	</div> <!-- #pre-footer -->
<?php endif; ?>
	<footer id="main-footer">
		<div class="container">
			<?php get_sidebar( 'footer' ); ?>
			

                        <div>
				<p class="footer-icones"><?php if ( function_exists('cn_social_icon') ) echo cn_social_icon(); ?> </p>
				<p class="footer-text">Desenvolvido por <img src="http://localhost/Harpia/wp-content/uploads/2014/11/acens-email.png"></p>
			
		</div> <!-- .container -->
</div>
	</footer> <!-- #main-footer -->

	<?php wp_footer(); ?>
</body>
</html>