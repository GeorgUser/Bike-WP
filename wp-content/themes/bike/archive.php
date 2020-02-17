<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <?php if (have_posts()) : ?>
                <header class="page-header">
                    <?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    ?>
                </header><!-- .page-header -->
                    <input class="of" name="of" type="date" >
                    <input class="and" name="and" type="date">
                <div class="posts_archive">
                    <?php
                    // Start the Loop.
                    while (have_posts()) :

                        the_post();

                        get_template_part('template-parts/content');

                    endwhile; ?>
                </div>
            <?php
            else :
                get_template_part('template-parts/content', 'none');

            endif;
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
