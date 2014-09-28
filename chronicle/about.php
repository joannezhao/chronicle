<?php
/*
Template Name: About Page
*/

get_header();
?>

<!--Parallax images-->
<div class="wrapper-parallax-image wrapper-parallax-image-full"
    data-anchor-target="#gap0"
  data-bottom-top="transform: translate3d(0px, 1200px, 0px);"
  data-top-bottom="transform: translate3d(0px, 0px, 0px);">
    
  <div class="parallax-image parallax-image-full"
    data-anchor-target="#gap0"
    style="background-image:url('http://thedartmouthchronicle.com/wp-content/uploads/2014/10/Team-1-copy.jpg'); background-position:50% 20%;"
    data-bottom-top="transform: translate3d(0px, -300px, 0px);"
    data-top-bottom="transform: translate3d(0px, 220px, 0px);">
  </div>
</div>

<div id="content" class="content">
  <div class="gap gap-full shadow-inset-sm" id="gap0"></div>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
    <div class="about-bar">
      <div class="about-wrapper">

        <div class="about-link active" data-id="about">
          About
        </div><div class="about-link" data-id="write">
          Write
        </div><div class="about-link" data-id="team">
          Team
        </div>

      </div>
    </div>

    <div class="page-wrapper">
      <div class="page-center-thin">
        <?php the_content(); ?>
      </div>
    </div>

  <?php endwhile; endif; ?>
</div>

<?php
	get_footer();
?>