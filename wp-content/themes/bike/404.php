<?php
/**
 * The template for displaying the 404 template in the Bike theme.
 *
 * @package WordPress
 * @subpackage bike
 * @since 1.0.0
 */

get_header();
?>

    <main id="site-content" role="main">

        <div class="section-inner thin error404-content page-space">
            <div class="page__container">
                <h1 class="entry-title"><?php _e( 'Page Not Found', 'bike' ); ?></h1>

                <div class="intro-text"><p><?php _e( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'bike' ); ?></p></div>

                <?php
                get_search_form(
                    array(
                        'label' => __( '404 not found', 'bike' ),
                    )
                );
                ?>
            </div>
        </div><!-- .section-inner -->

    </main><!-- #site-content -->
<?php
get_footer();
