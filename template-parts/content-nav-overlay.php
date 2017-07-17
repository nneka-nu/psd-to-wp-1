<div class="nav-overlay">
  <div class="nav-wrap">
    <a href="#" class="nav-close js-menu-close"><img src="<?php echo get_template_directory_uri() . '/images/close.png'; ?>" alt="close button"></a>
    <nav class="main-menu <?php echo !is_front_page() ? 'js-not-home' : ''; ?>" role="navigation">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'menu-1',
            'menu_id'        => 'primary-menu',
          ) );
        ?>
    </nav><!-- #site-navigation -->
    <div class="nav-social contact__social">
      <a href="<?php echo get_field('social_facebook', 5); ?>" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
      <a href="<?php echo get_field('social_twitter', 5); ?>" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
      <a href="<?php echo get_field('social_google', 5); ?>" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
      <a href="<?php echo get_field('social_dribbble', 5); ?>" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
      <a href="<?php echo get_field('social_behance', 5); ?>" class="behance"><i class="fa fa-behance" aria-hidden="true"></i></a>
    </div>
  </div><!-- .nav-wrap -->	
</div><!-- .nav-overlay -->