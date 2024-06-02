<!-- product section  -->
<section class="product-tabs-section e-flex e-con-boxed e-con e-parent">
    <div class="wrapper">
        <div class="tab-wrapper">
            <ul class="tabs">
                <a href="#tab-yorem-product" class="tab-link" data-tab="yorem-product">
                    <?php
                    if( $allicon['id'] ) {
                        echo wp_get_attachment_image( $allicon['id'], [50,50] );
                    }
                    ?>
                    <span class="cate-name"><?php echo esc_html($alltitle)?></span>
                </a>
                <?php
                $tax = [
                    'taxonomy'   => 'yorem_cateogry',
                    'number'    => $number,
                    'include' => $cat,
                    'parent'   => 0,
                    'hide_empty' => true,
                ];
                $categories = get_categories( $tax );
                foreach($categories as $category) {
                    $category_name = $category->name;
                    ?>
                    <a href="#tab-<?php echo esc_attr($category->slug); ?>" class="tab-link" data-tab="<?php echo esc_attr($category->slug); ?>">
                        <?php
                        $value2 = get_field( "thumbnail", $category->taxonomy . '_' . $category->term_id );
                        if( $value2 ) {
                            echo wp_get_attachment_image( $value2, [50,50] );
                        }
                        ?>
                        <span class="cate-name"><?php echo esc_html($category_name)?></span>
                    </a>
                <?php } ?>
            </ul>
        </div>

        <div class="content-wrapper">
            <div id="tab-yorem-product" class="tab-content">
                <div class="produkte-row">
                    <?php
                    if ($wp_query->have_posts()) {
                        while ($wp_query->have_posts()) {
                            $wp_query->the_post();
                            ?>
                            <div class="produkte-item">
                                <div class="prodkte-image">
                                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail()?></a>
                                </div>
                                <div class="produkte-title">
                                    <?php the_title()?>
                                </div>
                                <?php
                                $value = get_field( "gewicht_yorem" );
                                if( $value ) {
                                    echo '<div class="produkte-weight">'.wp_kses_post( $value ).'</div>';
                                }
                                ?>
                            </div>
                            <?php
                        }
                    }  else {
                        echo __( 'No products found' );
                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
                <?php
                foreach($categories as $category) {
                $category_name = $category->name;
                ?>
                <div id="tab-<?php echo esc_attr($category->slug); ?>" class="tab-content">
                   <?php
                   $subtax = [
                       'taxonomy'   => 'yorem_cateogry',
                       'parent' => $category->term_id,
                       'hide_empty' => true,
                   ];
                   $subcategories = get_categories( $subtax );
                   if ($subcategories){
                   ?>
                    <div class="tab-wrapper">
                        <div class="tabs sub-tabs">
                           <?php foreach($subcategories as $sub) { ?>
                               <button class="sub-tab-link" data-sub-tab="<?php echo esc_attr($sub->slug); ?>">
                                   <span class="cate-name"><?php echo esc_html($sub->name)?></span>
                               </button>
                           <?php } ?>
                        </div>
                    </div>
                    <div class="content-wrapper">
                        <?php
                        $index4 = 0;
                        foreach($subcategories as $sub) {
                        ?>
                            <div id="sub-tab-<?php echo esc_attr($sub->slug); ?>" class="sub-tab-content">
                            <div class="produkte-row">
                                <?php
                                $subargs = array(
                                    'post_type' => 'yorem',
                                    'posts_per_page' => $per_page,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'yorem_cateogry',
                                            'field' => 'slug',
                                            'terms' => $sub->slug,
                                        ),
                                    ),
                                );
                                $loop2 = new \WP_Query($subargs);
                                if ($loop2->have_posts()) {
                                    while ($loop2->have_posts()) {
                                        $loop2->the_post();
                                        ?>
                                        <div class="produkte-item">
                                            <div class="prodkte-image">
                                                <a href="<?php the_permalink();?>"><?php the_post_thumbnail()?></a>
                                            </div>
                                            <div class="produkte-title">
                                                <?php the_title()?>
                                            </div>
                                            <?php
                                            $value = get_field( "gewicht_yorem" );
                                            if( $value ) {
                                                echo '<div class="produkte-weight">'.wp_kses_post( $value ).'</div>';
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                }  else {
                                    echo __( 'No products found' );
                                }
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <?php } else {?>
                    <div class="produkte-row">
                        <?php
                        $args = array(
                            'post_type' => 'yorem',
                            'posts_per_page' => $per_page,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'yorem_cateogry',
                                    'field' => 'slug',
                                    'terms' => $category->slug,
                                ),
                            ),
                        );
                        $loop = new \WP_Query($args);
                        if ($loop->have_posts()) {
                            while ($loop->have_posts()) {
                                $loop->the_post();
                                ?>
                                <div class="produkte-item">
                                    <div class="prodkte-image">
                                        <a href="<?php the_permalink();?>"><?php the_post_thumbnail()?></a>
                                    </div>
                                    <div class="produkte-title">
                                        <?php the_title()?>
                                    </div>
                                        <?php
                                        $value = get_field( "gewicht_yorem" );
                                        if( $value ) {
                                            echo '<div class="produkte-weight">'.wp_kses_post( $value ).'</div>';
                                        }
                                        ?>
                                </div>
                                <?php
                            }
                        }  else {
                            echo __( 'No products found' );
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                   <?php } ?>
                </div>
                <?php } ?>
        </div>
    </div>
</section>