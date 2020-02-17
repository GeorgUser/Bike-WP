<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.01.2020
 * Time: 21:10
 */

$title = get_sub_field('title');
$sub_title = get_sub_field('sub_title');
$form = get_sub_field('form');
?>

<section class="consultation">
    <div class="page__container">
        <h2 class="title"><?php echo $title ?></h2>
        <p class="sub-title"><?php echo $sub_title ?></p>
        <form action="#" method="post" class="form">
            <?php echo $form ?>
        </form>
    </div>
</section>
