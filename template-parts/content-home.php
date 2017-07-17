<?php
/**
* Template part for displaying page content in homepage.php
*/

?>

  <section id="services" class="services">
    <div class="services-wrap">
      <?php if( have_rows('services_list') ) : 
	        while( have_rows('services_list') ) : the_row(); 

            $icon = get_sub_field('services_icon');
            $heading = get_sub_field('services_heading');
            $desc = get_sub_field('services_desc');

      ?>

          <div class="services-col">
            <div class="services__icon">
              <img src="<?php echo $icon; ?>" alt="Printer Icon">
            </div>
            <p class="services__heading"><?php echo $heading; ?></p>
            <p class="services__text">
              <?php echo $desc; ?>
            </p>
          </div>

        <?php endwhile; ?>
      <?php endif; ?>
    </div><!-- .services-wrap -->
  </section>
<?php rest_url(); ?>
  <section class="newsletter" style="background-image: url(<?php echo get_field('newsletter_bg'); ?>);">
    <form action="" class="newsletter__form">
      <input class="newsletter__input" type="text" placeholder="Enter your email address for newsletter">
      <button class="btn newsletter__btn">Subscribe</button>
    </form>
  </section>

  <section id="works" class="works">
    <div class="works-wrap">
      <h1 class="works__heading"><?php the_field('works_heading'); ?></h1>
      <p class="works__desc"><?php the_field('works_desc'); ?></p>
      <div class="works__grid js-works-grid">
        <?php
          $args = array(
            'post_type'      => 'portfolio',
            'posts_per_page' => 6,
            'order'          => 'ASC'
          );
          $query = new WP_Query($args);
          $index = 0;

          while( $query->have_posts() ) : $query->the_post(); ?>
            <div class="works__img__wrap">
            <img src="<?php echo wp_get_attachment_link( ( get_post_meta( get_the_ID(), 'the_work_img', true ) ), 'portfolio' ); ?>" alt="Photo" width="360" height="360">
          
            <div class="works__overlay">
              <h2 class="works__overlay__heading"><?php the_title(); ?></h2>
              <p class="works__overlay__excerpt"><?php the_field('the_work_desc'); ?></p>
              <div class="works__overlay__button"><a href="<?php echo get_permalink(); ?>" class="btn">Show Project</a> </div>
            </div>
          </div>
          <?php endwhile;
          wp_reset_postdata();

        ?>
      </div><!-- .works__grid-->
      <a href="#" class="btn works__more__btn js-more">Show More</a>
    </div>
  </section>

  <section class="testimonial" style="background-image: url(<?php echo get_field('testimonials_bg'); ?>);">
    <div class="testimonial-wrap flexslider">
      <ul class="slides">
        <?php
          $testimonials = get_field('testimonials_list');
          foreach($testimonials as $obj) : ?>
            <li class="slides__item">
              <img src="<?php echo get_field('testimonial_photo', $obj->ID); ?>" alt="Testimonial Photo">
              <p class="testimonial__text"><?php echo $obj->post_content; ?></p>
              <p class="testimonial__author"><?php echo $obj->post_title; ?></p>
            </li>
          <?php endforeach; ?>
      </ul>
      <div class="custom-nav">
        <a href="#" class="flex-prev">
          <img src="<?php echo get_template_directory_uri() . '/images/arrow-left.png'; ?>">
        </a>
        <a href="#" class="flex-next">
          <img src="<?php echo get_template_directory_uri() . '/images/arrow-right.png'; ?>">
        </a>
      </div>
    </div><!-- .testimonial-wrap -->
  </section>

  <section class="team">
    <div class="team-wrap">
      <h1 class="team__heading"><?php the_field('team_heading'); ?></h1>
      <p class="team__desc"><?php the_field('team_desc'); ?></p>
      <div class="team__container">
          <?php 
            $classes = ['semi-active', 'active', 'inactive', 'inactive'];
            $args = array(
              'post_type'      => 'team',
              'posts_per_page' => 4,
              'order'          => 'ASC'
            );
            $query = new WP_Query($args);
            $index = 0;

            while( $query->have_posts() ) : $query->the_post(); ?>
              <div class="team__bio <?php echo $classes[$index]?>">
                <div class="img-wrap">
                  <img src="<?php echo get_field('team_photo'); ?>" alt="Team Member Photo">
                </div>
                <h2 class="team__bio__name"><?php the_title(); ?></h2>
                <div class="team__bio__social">
                  <a href="<?php echo get_field('team_facebook'); ?>" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                  <a href="<?php echo get_field('team_twitter'); ?>" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                  <a href="<?php echo get_field('team_google'); ?>" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                </div>
                <p class="team__bio__text"><?php the_content(); ?></p>
              </div>
            <?php $index++;
            endwhile;
            wp_reset_postdata();
          ?>
      </div><!--.team-container-->
      <div class="team__nav">
        <a href="#"></a>
        <a class="active" href="#"></a>
        <a href="#"></a>
        <a href="#"></a>
      </div>
    </div>
  </section>

  <section id="contact" class="contact" style="background-image: url(<?php echo get_field('contact_bg'); ?>);">
    <h1 class="contact__heading"><?php the_field('contact_heading'); ?></h1>
    <div class="contact__desc"><?php the_field('contact_desc'); ?></div>
    <div class="form-wrap">
      <form action="" class="contact__form">
        <input type="text" class="contact__form__email" placeholder="Your email">
        <input type="text" class="contact__form__subject" placeholder="Your subject">
        <textarea name="" id="" class="contact__form__msg">Your message</textarea>
        <button class="btn contact__form__btn">Hire Us</button>
      </form>
      <div class="contact__social">
        <a href="<?php echo get_field('social_facebook'); ?>" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="<?php echo get_field('social_twitter'); ?>" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="<?php echo get_field('social_google'); ?>" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
        <a href="<?php echo get_field('social_dribbble'); ?>" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
        <a href="<?php echo get_field('social_behance'); ?>" class="behance"><i class="fa fa-behance" aria-hidden="true"></i></a>
      </div>
    </div>
  </section>

<?php get_footer(); ?>