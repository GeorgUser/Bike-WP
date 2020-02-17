<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 27.01.2020
 * Time: 21:09
 */

$title = get_sub_field('title');
$description = get_sub_field('content');
?>

<section class="about">
    <div class="page__container">
        <h2 class="title"><?php echo $title ?></php></h2>
        <div class="description">
            <?php echo $description ?>
        </div>

    </div>
</section>
