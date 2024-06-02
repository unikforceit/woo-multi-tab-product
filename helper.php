<?php
function woo_multi_product_cat($tax)
{
    $args =  [
        'taxonomy'=> $tax,
        'parent'   => 0,
        'hide_empty' => true,
    ];
    $categories_obj = get_categories($args);
    $categories = array();

    foreach ($categories_obj as $pn_cat) {
        $categories[$pn_cat->term_id] = $pn_cat->cat_name;
    }

    return $categories;
}