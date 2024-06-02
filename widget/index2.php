<?php

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class woo_multi_tab_product2 extends Widget_Base {

    public function get_name()
    {
        return 'velanto-tab-product2';
    }

    public function get_title()
    {
        return __('Tab Product 2', 'velanto');
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_icon()
    {
        return 'eicon-posts-group';
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Blog', 'velanto'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cat_query',
            [
                'label' => __('Category', 'velanto'),
                'type' => Controls_Manager::SELECT2,
                'options' => woo_multi_product_cat('ozyorem_category'),
                'multiple' => true,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'velanto'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );
        $this->add_control(
            'terms',
            [
                'label' => __('Terms', 'velanto'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );
        $this->add_control(
            'alltitle',
            [
                'label' => __('All Product Title', 'velanto'),
                'type' => Controls_Manager::TEXT,
                'default' => __('All Products', 'velanto'),
            ]
        );
        $this->add_control(
            'allicon',
            [
                'label' => __('All Product Icon', 'velanto'),
                'type' => \Elementor\Controls_Manager::MEDIA
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'content_sty',
            [
                'label' => __('Style', 'velanto'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        ); // start style section
        $this->add_control(
            'tab_color',
            [
                'label' => __('Tab Color', 'velanto'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .tab-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'taba_color',
            [
                'label' => __('Tab Active Color', 'velanto'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .tab-link.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttt',
                'label' => __('Tab Typography', 'velanto'),
                'selector' => '{{WRAPPER}} .tabs .tab-link',
            ]
        );
        $this->add_control(
            'tabbg',
            [
                'label' => __('Tab BG', 'velanto'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .tab-link' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabbga',
            [
                'label' => __('Tab Active BG', 'velanto'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .tab-link.active' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_color',
            [
                'label' => __('Sub Tab Color', 'velanto'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs.sub-tabs .sub-tab-link' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabas_color',
            [
                'label' => __('Sub Tab Active Color', 'velanto'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs.sub-tabs .sub-tab-link.active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ttts',
                'label' => __('Sub Tab Typography', 'velanto'),
                'selector' => '{{WRAPPER}} .tabs.sub-tabs .sub-tab-link',
            ]
        );
        $this->add_control(
            'tabbgs',
            [
                'label' => __('Sub Tab BG', 'velanto'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs.sub-tabs .sub-tab-link' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabbgas',
            [
                'label' => __('Sub Tab Active BG', 'velanto'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs.sub-tabs .sub-tab-link.active' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        $per_page = $settings['posts_per_page'];
        $cat = $settings['cat_query'];
        $number = $settings['terms'];
        $alltitle = $settings['alltitle'];
        $allicon = $settings['allicon'];
        $query_args = array(
            'post_type' => 'ozyorem',
            'posts_per_page' => $per_page,
            'tax_query' => array(
                array(
                    'taxonomy' => 'ozyorem_category',
                    'field' => 'term_id',
                    'terms' => $cat,
                    'operator' => 'IN',
                ),
            ),
        );

        $wp_query = new \WP_Query($query_args);
        include dirname(__FILE__) . '/layout2.php';
    }

}

Plugin::instance()->widgets_manager->register(new woo_multi_tab_product2());