<?php
/**
 * Template Name: Home Page Template
 *
 */

get_header(); ?>

<div id="primary" class="content-area">
    <section id="main" class="site-main" role="main">

        <?php
        if (get_field('home_page')):
            // loop through the rows of data
            while (have_rows('home_page')) : the_row();
                switch (get_row_layout()) {
                    case 'hero_block':
                        get_template_part('template-parts/hero_block');
                        break;
                    case 'advantages':
                        get_template_part('template-parts/advantages');
                        break;
                    case 'about':
                        get_template_part('template-parts/about');
                        break;
                    case 'consultation':
                        get_template_part('template-parts/consultation');
                        break;

                }
            endwhile;
        endif;
        ?>
        <div class="two_side_container">
            <?php
            while ( have_posts() ) : the_post();

                the_content();

            endwhile; // End of the loop.
            ?>
            <br clear="all"/>
        </div>
    </section><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
