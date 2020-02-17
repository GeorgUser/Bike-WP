<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.01.2020
 * Time: 21:07
 */

$slider = get_sub_field('slider');
?>

<section id="hero_block" class="hero_block">
    <?php

    if( $slider ): ?>
        <div class="slick_hero">
            <?php foreach( $slider as $image ): ?>
                <div>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>