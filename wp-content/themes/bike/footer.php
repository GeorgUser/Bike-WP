
<footer class="footer">
    <div class="page__container">
        <div class="page__row">
            <div class="logo__col">
                <div class="logo">
                    <?php $logo = get_field('logo', 'option');?>
                    <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['alt'];?>" title="<?php echo $logo['title'];?>">
                </div>
            </div>
            <div class="social__col">
                <?php echo bike_social('social footer__social') ?>
                <p class="copyright">Bike Sport 2011-2018</p>
            </div>
            <div class="nav__col">
                <div class="nav">
                    <?php wp_nav_menu(array('theme_location'=>'footer_menu', 'menu_class'=>'block', 'container'=>false, 'depth'=> 10, 'walker'=> new custom_walker_nav_menu) ); ?>
                    <div class="contact">
                        <p><a href="tel: <?php echo get_field('phone', 'option');?>"><?php echo get_field('phone', 'option');?></a></p>

                        <?php if( have_rows('time_work', 'option') ):
                        while( have_rows('time_work', 'option') ): the_row();

                        // Get sub field values.
                        $open_time = get_sub_field('open_time');
                        $closing_time = get_sub_field('closing_time');
                        $text_after = get_sub_field('text_after');
                        endwhile;
                        endif;
                        ?>
                        <p>с  <?php echo $open_time;?> до  <?php echo $closing_time;?>  <?php echo $text_after;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer();?>
</body>
</html>