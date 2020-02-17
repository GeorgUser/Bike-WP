<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.01.2020
 * Time: 21:08
 */

$title = get_sub_field('title');
?>

<section class="advantages">
    <div class="page__container">
        <h2 class="title"><?php echo $title; ?></h2>
        <?php if( have_rows('advantage') ): ?>
        <div class="content">
            <div class="page__row">
                <?php while( have_rows('advantage') ): the_row();
                    // vars
                    $icon = get_sub_field('icon');
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    ?>

                    <div class="advantage__col">
                        <div class="advantage">
                            <?php if( $icon ): ?>
                                <div class="icon">
                                    <img src="<?php echo $icon['url'] ?>" alt="<?php echo $icon['alt'] ?>">
                                </div>
                            <?php endif; ?>

                            <div class="description">
                                <?php if( $title ): ?>
                                    <h4 class="title title-22"><?php echo  $title ?></h4>
                                <?php endif; ?>
                                <?php if( $description ): ?>
                                    <p><?php echo  $description ?></p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                <?php endwhile; ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
