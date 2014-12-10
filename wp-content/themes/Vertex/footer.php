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
			

                        <div >
				<?php if ( function_exists('cn_social_icon') ) echo cn_social_icon(); ?>
				<div class="menu-logo-nome-r box-footer">
					
						<p class="menu-logo-nome">Desenvolvido por</p>
					
					<div class="footer-nome">
					<img src="http://localhost/Harpia/wp-content/uploads/2014/12/acensbranco-footer.png">
					</div>
				</div>
		</div> <!-- .container -->
</div>
	</footer> <!-- #main-footer -->

	<?php wp_footer(); ?>
</body>
</html>