<?php 
/**
 * Template Name: Custom Post Type Template
 *
 * This is a custom template for displaying content from a custom post type.
 * Note: don't forget to add the comment section!!!
 */

<div class="main-container">

    </?php

    if( have_posts() )
        while( have_post() ): the_post(); ?>
            <p><?php the_content(); ?></p>
            <h3><?php the_title(); ?></h3>
            <hr>
            <?php if( has_post_thumbnail() ): ?>
                <div> <?php the_post_thumbnail('thumbnail'); ?> </div>
            <?php endif; ?>
            <small><?php 
                $terms_list = wp_get_post_terms($post->ID, 'category'); 

                $i = 0;
                foreach( $terms_list as $term) { $i++;
                    if( $i > 1 ){echo ', ';}
                    echo $term->name;
                }
            ?> || 
            <?php 
                $terms_list = wp_get_post_terms($post->ID, 'tag'); 

                $i = 0;
                foreach( $terms_list as $term) { $i++;
                    if( $i > 1 ){echo ', ';}
                    echo $term->name;
                }
            ?> </small>
        <?php endwhile;
    endif;
    ?>

    <!-- Comment Section -->
    <?php 
        if( comments_open() ){ 
            comments_template(); 
        } else {
            echo '<h5 class="text-center"> Sorry, comments is not available right now! </h5>';
        }
    ?>

</div>
