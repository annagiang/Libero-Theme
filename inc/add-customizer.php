<?php
	// type use: text, checkbox, radio, select, textarea, color, image, gallery, font, rsbackground
	
	$libero_widgets = libero_get_widgets();	
	
	// General
	rs::addCustomizePanel(array(
		'name' => 'panel_general',
		'title' => 'General',
		'priority' => 21,
	));
	
	// General > Banner Default
	rs::addCustomizeTab(array(
		'title' => 'Banner Default', 
		'name' => 'rst_customize_banner',
		'panel' => 'panel_general',
		'controls' => array(
			array(
				'label' 		=> 'Background Image',
				'type' 			=> 'image',
				'name' 			=> 'banner_background'
			),
			array(
				'label' 		=> 'Banner Title',
				'type' 			=> 'text',
				'name' 			=> 'banner_title',
				'default_value'	=> 'Welcome to Libero'
			),
			array(
				'label' 		=> 'Banner Description',
				'type' 			=> 'textarea',
				'name' 			=> 'banner_description'
			)
		)
	) );
	
	// General > Sidebar Setting
	rs::addCustomizeTab(array(
		'title' => 'Sidebar Setting', 
		'name' => 'rst_customize_sidebar_setting',
		'panel' => 'panel_general',
		'controls' => array(
			array(
				'label' 		=> 'Disable Sidebar Sticky',
				'type' 			=> 'checkbox',
				'name' 			=> 'disable_sidebar_sticky'
			),
			array(
				'label' 		=> 'Title Widget Style',
				'type' 			=> 'select',
				'name' 			=> 'sidebar_title_style',
				'items'			=> array(
					'1'		=> 'Align Left',
					'2'		=> 'Align Center',
				)
			)
		)
	) );
	
	// General > Loading Content Setting
	rs::addCustomizeTab(array(
		'title' => 'Loading Content', 
		'name' => 'rst_customize_loading_content_setting',
		'panel' => 'panel_general',
		'controls' => array(
			array(
				'label' 		=> 'Disable Loading Content',
				'type' 			=> 'checkbox',
				'name' 			=> 'disable_loading_content'
			)
		)
	) );
	
	
	// Header
	rs::addCustomizePanel(array(
		'name' => 'panel_header',
		'title' => 'Header & Logo',
		'priority' => 21,
	));
	
	// Header > Header Setting
	rs::addCustomizeTab(array(
		'title' => 'Header Setting', 
		'name' => 'libero_customize_header_setting',
		'panel'	=> 'panel_header',
		'controls' => array(
			array(
				'label' 		=> 'Header Layout',
				'type' 			=> 'radio-image',
				'name' 			=> 'libero_header_layout',
				'default_value'	=> '2',
				'items'			=> array(
					'1' => get_template_directory_uri() .'/inc/images/header-1.jpg',
					'2' => get_template_directory_uri() .'/inc/images/header-2.jpg',
					'3' => get_template_directory_uri() .'/inc/images/header-3.jpg',
					'4' => get_template_directory_uri() .'/inc/images/header-4.jpg',
					'5' => get_template_directory_uri() .'/inc/images/header-5.jpg',
					'6' => get_template_directory_uri() .'/inc/images/header-6.jpg',
				)
			),
			array(
				'label' 		=> 'Hidden Header Sticky',
				'type' 			=> 'checkbox',
				'name' 			=> 'disable_header_sticky'
			)
		)
	));
	
	// Header > Logo
	rs::addCustomizeTab(array(
		'title' => 'Logo', 
		'name' => 'libero_customize_header_logo',
		'panel'	=> 'panel_header',
		'controls' => array(
			array(
				'label' 		=> 'Select Logo Type',
				'type' 			=> 'select',
				'name' 			=> 'libero_logo_type',
				'default_value'	=> 'image',
				'items'			=> array(
					'image'	=> 'Image',
					'text'	=> 'Text'
				)
			),
			array(
				'label' 		=> 'Logo Images',
				'type' 			=> 'image',
				'name' 			=> 'libero_logo',
				'conditional_logic' => array(
					'items' => array(
						'libero_logo_type' => 'image'
					)
				)
			),
			array(
				'label' 		=> 'Logo Text',
				'type' 			=> 'text',
				'name' 			=> 'libero_logo_text',
				'default_value'	=> 'Libero',
				'conditional_logic' => array(
					'items' => array(
						'libero_logo_type' => 'text'
					)
				)
			),
			array(
				'label' 		=> 'Logo Font',
				'type'			=> 'font',
				'name'			=> 'libero_font_logo',
				'css_selector'	=> '.libero-logo a',
				'default_value'	=> array(
					'font-size'		=> '60px',
					'font-family' 	=> 'Playfair Display',
					'font-weight' 	=> '600',
					'font-style' 	=> 'italic',
				),
				'conditional_logic' => array(
					'items' => array(
						'libero_logo_type' => 'image'
					)
				)
			),
			array(
				'label' 		=> 'Max Width',
				'type' 			=> 'text',
				'name' 			=> 'libero_logo_max_width',
				'css'			=> '.libero-logo img { max-width: $value }',
				'conditional_logic' => array(
					'items' => array(
						'libero_logo_type' => 'image'
					)
				)
			),
			array(
				'label' 		=> 'Max Height',
				'type' 			=> 'text',
				'name' 			=> 'libero_logo_max_height',
				'css'			=> '.site-brand .logo img { max-height: $value }',
				'conditional_logic' => array(
					'items' => array(
						'libero_logo_type' => 'image'
					)
				)
			),
			array(
				'label' 		=> 'Padding Top',
				'type' 			=> 'text',
				'name' 			=> 'libero_logo_padding_top',
				'default_value'	=> '',
				'css'			=> '.libero-logo { margin-top: $value }'
			),
			array(
				'label' 		=> 'Padding Bottom',
				'type' 			=> 'text',
				'name' 			=> 'libero_logo_padding_bottom',
				'default_value'	=> '',
				'css'			=> '.site-brand { margin-bottom: $value }'
			),
			array(
				'label' 		=> 'Padding Left',
				'type' 			=> 'text',
				'name' 			=> 'libero_logo_padding_left',
				'default_value'	=> '',
				'css'			=> '.site-brand { margin-left: $value }'
			),
			array(
				'label' 		=> 'Padding Right',
				'type' 			=> 'text',
				'name' 			=> 'libero_logo_padding_right',
				'default_value'	=> '',
				'css'			=> '.site-brand { margin-right: $value }'
			)
		)
	));
	
	
	
	// Footer	
	rs::addCustomizePanel(array(
		'name' => 'panel_footer',
		'title' => 'Footer',
		'priority' => 21,
	));
	
	// Footer > Top Footer
	rs::addCustomizeTab(array(
		'title' => 'Top Footer',
		'panel'	=> 'panel_footer',
		'name' 	=> 'libero_customize_footer_top',
		'controls' => array(
			array(
				'label' 		=> 'Show Top Footer',
				'type' 			=> 'checkbox',
				'name' 			=> 'libero_show_top_footer'
			),
			array(
				'label' 		=> 'Footer Top Layout',
				'type' 			=> 'radio-image',
				'name'			=> 'libero_top_footer_layout',
				'default_value'	=> 1,
				'items'			=> array(
					'1' => get_template_directory_uri() .'/inc/images/footer-1.jpg',
					'2' => get_template_directory_uri() .'/inc/images/footer-2.jpg',
					'3' => get_template_directory_uri() .'/inc/images/footer-3.png',
				)
			),
			array(
				'label' 		=> 'Background',
				'type' 			=> 'rsbackground',
				'name' 			=> 'libero_top_footer_background',
				'css_selector'	=> '.rst-footer-content, .libero-top-footer .widget-title span',
				'default_value' => array(
					'background-color' => '#363636'
				)
			),
			array(
				'label' 		=> 'Padding Top',
				'type' 			=> 'text',
				'name'			=> 'libero_top_footer_padding_top',
				'default_value'	=> '70px',
				'css'			=> '.libero-top-footer { padding-top: $value }'
			),
			array(
				'label' 		=> 'Padding Bottom',
				'type' 			=> 'text',
				'name'			=> 'libero_top_footer_padding_bottom',
				'default_value'	=> '10px',
				'css'			=> '.libero-top-footer { padding-bottom: $value }'
			)
		)
	) );		
	
	// Footer > Main Footer 
	rs::addCustomizeTab(array(
		'title' => 'Main Footer',		'panel'	=> 'panel_footer',
		'name' 	=> 'libero_customize_footer_main',
		'controls' => array(
			array(
				'label' 		=> 'Footer Layout',
				'type' 			=> 'radio-image',
				'name'			=> 'libero_main_footer_layout',
				'default_value'	=> 1,
				'items'			=> array(
					'1' => get_template_directory_uri() .'/inc/images/footer-main-1.jpg',
					'2' => get_template_directory_uri() .'/inc/images/footer-main-2.jpg',
				)
			),			array(
				'label' 		=> 'Copyright',
				'type' 			=> 'textarea',
				'name'			=> 'libero_footer_copyright',
				'default_value'	=> '&copy; 2015 Libero Magazine - LiberThemes. All Rights Reserved.',
				'conditional_logic' => array(
					'items' => array(
						'libero_main_footer_layout' => '1'
					)
				)
			),			array(
				'label' 		=> 'Logo Footer',
				'type' 			=> 'image',
				'name'			=> 'libero_footer_logo',
				'conditional_logic' => array(
					'items' => array(
						'libero_main_footer_layout' => '2'
					)
				)
			),			array(
				'label' 		=> 'Partner',
				'type' 			=> 'repeater',
				'name'			=> 'libero_footer_partner',
				'controls'		=> array(
					array(
						'label'	=> 'Logo',
						'type'	=> 'image',
						'name'	=> 'logo'
					),
					array(
						'label'	=> 'Link',
						'type'	=> 'text',
						'name'	=> 'link'
					)
				),
				'conditional_logic' => array(
					'items' => array(
						'libero_main_footer_layout' => '2'
					)
				)
			),
			array(
				'label' 		=> 'Background',
				'type' 			=> 'rsbackground',
				'name' 			=> 'libero_main_footer_background',
				'css_selector'	=> '.libero-main-footer',
				'default_value' => array(
					'background-color' => '#262626'
				)
			),
			array(
				'label' 		=> 'Text Color',
				'type' 			=> 'color',
				'name' 			=> 'libero_main_footer_color',
				'default_value' => '#a5a5a5',
				'css'			=> '.libero-main-footer { color: $value }'
			),
			array(
				'label' 		=> 'Padding Top',
				'type' 			=> 'text',
				'name'			=> 'libero_main_footer_padding_top',
				'default_value'	=> '25px',
				'css'			=> '.libero-main-footer { padding-top: $value }'
			),
			array(
				'label' 		=> 'Padding Bottom',
				'type' 			=> 'text',
				'name'			=> 'libero_main_footer_padding_bottom',
				'default_value'	=> '25px',
				'css'			=> '.libero-main-footer { padding-bottom: $value }'
			)
		)
	) );
	
	
	// Background Body
	rs::addCustomizeTab(array(
		'title' => 'Background Body', 
		'name' => 'libero_customize_bg_body',		
		'priority' => 21,
		'controls' => array(
			array(
				'label' 		=> 'Background Body',
				'type' 			=> 'rsbackground',
				'name' 			=> 'libero_bg_body',
				'css_selector' 	=> 'body,.widget-title span,.libero-sidebar-center .widget-title span,#sidebar.libero-sidebar-center .widget-title span',
				'default_value' => array(
					'background-color' => '#ffffff'
				)
			)
		)
	));
	
	
	//Typography 
	rs::addCustomizePanel(array(
		'name' => 'panel_typography',
		'title' => 'Typography',
		'priority' => 22,
	));
	
	//Typography > General
	rs::addCustomizeTab(array(
		'title' => 'General', 
		'name' => 'libero_customize_typography_general',
		'panel'	=> 'panel_typography',
		'controls' => array(
			array(
				'label' 		=> 'Font Smoothing',
				'type'			=> 'checkbox',
				'name'			=> 'libero_is_smothing',
				'description'	=> 'Enable font-smoothing site wide. This makes fonts look a little "skinner".'
			),
			array(
				'label' 		=> 'latin',
				'type'			=> 'checkbox',
				'name'			=> 'libero_is_latin'
			),
			array(
				'label' 		=> 'latin-ext',
				'type'			=> 'checkbox',
				'name'			=> 'libero_is_latin_ext'
			),
			array(
				'label' 		=> 'cyrillic',
				'type'			=> 'checkbox',
				'name'			=> 'libero_is_cyrillic'
			),
			array(
				'label' 		=> 'cyrillic-ext',
				'type'			=> 'checkbox',
				'name'			=> 'libero_is_cyrillic_ext'
			),
			array(
				'label' 		=> 'greek',
				'type'			=> 'checkbox',
				'name'			=> 'libero_is_greek'
			),
			array(
				'label' 		=> 'greek-ext',
				'type'			=> 'checkbox',
				'name'			=> 'libero_is_greek_ext'
			),
			array(
				'label' 		=> 'vietnamese',
				'type'			=> 'checkbox',
				'name'			=> 'libero_is_vietnamese'
			),
		)
	));
	
	//Typography > Body
	rs::addCustomizeTab(array(
		'title' => 'Body', 
		'name' => 'libero_customize_typography_body',
		'panel'	=> 'panel_typography',
		'controls' => array(
			array(
				'label' 		=> 'Main Font',
				'type'			=> 'font',
				'name'			=> 'libero_font_body',
				'css_selector'	=> 'body',
				'default_value'	=> array(
					'font-family' => 'Roboto Condensed',
					'font-size'	=> '14px',
				)
			)
		)
	));
	
	//Typography > Heading
	rs::addCustomizeTab(array(
		'title' => 'Heading', 
		'name' => 'libero_customize_typography_heading',
		'panel'	=> 'panel_typography',
		'controls' => array(
			array(
				'label' 		=> 'Body',
				'type'			=> 'font',
				'name'			=> 'libero_font_body',
				'css_selector'	=> 'body',
				'default_value'	=> array(
					'font-family' => 'Roboto Condensed',
					'font-size'	=> '14px',
				)
			),
			array(
				'label' 		=> 'H1',
				'type'			=> 'font',
				'name'			=> 'libero_font_h1',
				'css_selector'	=> 'h1',
				'default_value'	=> array(
					'font-family'	=> 'Playfair Display',
					'font-size'		=> '36px',
					'line-height'	=> '40px',
				)
			),
			array(
				'label' 		=> 'H2',
				'type'			=> 'font',
				'name'			=> 'libero_font_h2',
				'css_selector'	=> 'h2',
				'default_value'	=> array(
					'font-family'	=> 'Playfair Display',
					'font-size'		=> '32px',
					'line-height'	=> '36px',
				)
			),
			array(
				'label' 		=> 'H3',
				'type'			=> 'font',
				'name'			=> 'libero_font_h3',
				'css_selector'	=> 'h3',
				'default_value'	=> array(
					'font-family'	=> 'Playfair Display',
					'font-size'		=> '28px',
					'line-height'	=> '32px',
				)
			),
			array(
				'label' 		=> 'H4',
				'type'			=> 'font',
				'name'			=> 'libero_font_h4',
				'css_selector'	=> 'h4',
				'default_value'	=> array(
					'font-family'	=> 'Playfair Display',
					'font-size'		=> '24px',
					'line-height'	=> '28px',
				)
			),
			array(
				'label' 		=> 'H5',
				'type'			=> 'font',
				'name'			=> 'libero_font_h5',
				'css_selector'	=> 'h5',
				'default_value'	=> array(
					'font-family'	=> 'Playfair Display',
					'font-size'		=> '18px',
					'line-height'	=> '22px',
				)
			),
			array(
				'label' 		=> 'H6',
				'type'			=> 'font',
				'name'			=> 'libero_font_h6',
				'css_selector'	=> 'h6',
				'default_value'	=> array(
					'font-family'	=> 'Playfair Display',
					'font-size'		=> '14px',
					'line-height'	=> '18px',
				)
			)
		)
	));
	
	//Typography > Title
	rs::addCustomizeTab(array(
		'title' => 'Title', 
		'name' => 'libero_customize_typography_title',
		'panel'	=> 'panel_typography',
		'controls' => array(
			array(
				'label' 		=> 'Page Title',
				'type'			=> 'font',
				'name'			=> 'libero_font_page_title',
				'css_selector'	=> 'h3.libero-page-title',
				'default_value'	=> array(
					'font-family'	=> 'Roboto Slab',
					'font-size'		=> '28px',
					'font-weight'	=> '400'
				)
			),
			array(
				'label' 		=> 'Single Title',
				'type'			=> 'font',
				'name'			=> 'libero_font_single_title',
				'css_selector'	=> 'h1.libero_detail_title',
				'default_value'	=> array(
					'font-family'	=> 'Playfair Display',
					'font-size'		=> '36px',
					'font-weight'	=> '400'
				)
			)
		)
	));
	
	//Typography > Sidebar Widgets
	rs::addCustomizeTab(array(
		'title' => 'Sidebar Widgets', 
		'name' => 'libero_customize_typography_sidebar_widget',
		'panel'	=> 'panel_typography',
		'controls' => array(
			array(
				'label' 		=> 'Sidebar Title',
				'type'			=> 'font',
				'name'			=> 'libero_font_sidebar_title',
				'css_selector'	=> '.libero-sidebar-center .widget-title, #sidebar.libero-sidebar-center .widget-title',
				'default_value'	=> array(
					'font-family'	=> 'Playfair Display',
					'font-size'		=> '18px',
					'font-weight'	=> '400'
				)
			)
		)
	));
	
	
	// Theme Color
	rs::addCustomizeTab(array(
		'title' => 'Theme Color', 
		'name' => 'libero_customize_theme_color',
		'priority' => 21,
		'controls' => array(
			array(
				'label' 		=> 'Select Color',
				'type' 			=> 'color',
				'default_value' => '#c19d75',
				'name' 			=> 'libero_theme_color',
				'css'			=> '
					.libero-random-post .libero-comment .count,
					.widget_author cite,
					.libero_more_from_cat_content span b,
					.widget-about-us .libero-social li a:hover,
					.libero-header-4 .libero-main-menu .current-menu-item a:hover,
					.libero-header-4 .libero-main-menu a:hover,
					.libero-main-menu .libero-submenu-black > .sub-menu li a:hover,
					.libero-main-menu .current-menu-item > a,
					.libero-main-menu a:hover,
					.owl-theme .owl-controls .owl-nav div,
					.owl-theme .owl-controls .owl-nav div:hover,
					.libero_category_name,
					.libero-comment .count,
					.libero_hottest_title b,
					.libero_hottest_title strong,
					.breadcrumb .active,
					.widget.widget_categories a:hover,
					.widget.widget_archive a:hover,
					.libero_category_name a,
					.libero_contact_detail_list .libero_detail a,
					.breadcrumb .active a,
					.amount,
					.product_list_widget li .amount,
					.breadcrumb li a:hover,
					.libero-main-footer .libero-menu-footer li a:hover,
					.libero-search-form button:hover,
					.libero-header-6 .libero-socials li a:hover,
					.quickview-inner .price ins,
					.widget_social .libero-social li:hover a i,
					.content-area article.libero-classic .entry-title:hover a,
					.widget.widget_calendar table tbody td#today,
					.libero-post-title:hover a,
					.product-categories a:hover,
					a.libero-reset-filter:hover,
					.woocommerce ul.cart_list li a:hover, .woocommerce ul.product_list_widget li a:hover,
					.libero_arrivals_owl .libero_product_info > h3:hover a,
					.woocommerce .libero_content_product h3:hover,
					.woocommerce .posted_in a:hover,
					.libero_share_icons a:hover,
					.libero_sticky_logo ul li a:hover
					{
					  color: $value;
					  -webkit-transition: color 0.3s ease-in-out;
					  transition: color 0.3s ease-in-out;
					}
					.widget_tag_cloud a,
					.owl-dot,
					.owl-dot:hover,
					.owl-dot span:hover,
					.owl-dot.active span,
					.owl-theme .owl-controls .owl-nav div:hover,
					.libero-pagenavi .page-numbers.current,
					.libero-pagenavi .page-numbers:hover,
					.libero_post_tag a,
					.libero_category_style_4 .libero_owl_item_info_meta,
					.libero_header_slider_3 .libero_owl_item_info_meta,
					.libero_header_slider_large_2 .libero_owl_item_info_meta,
					.libero-quote,
					.libero-main-header .libero-cart-mini > a:hover,
					.libero_recently_added_items > a:hover,
					.widget_product_tag_cloud .tagcloud a:hover,
					.libero-addtocart a:hover,
					.libero_promobox.libero_promobox_style_3 > a,
					.libero_promobox.libero_promobox_style_4 > a,
					.libero_sticky_nav > a:hover,
					.libero-social a:hover,
					.rs-select-box .rs-select-item:hover,
					.widget_social .libero-social li:hover
					{
					  border-color: $value !important;
					  -webkit-transition: border-color 0.3s ease-in-out;
					  transition: border-color 0.3s ease-in-out;
					}
					.widget_newsletterwidget .newsletter-submit,
					.owl-dot span:hover,
					.owl-dot.active span,
					.libero_readmore,
					.widget_wysija input[type="submit"],
					.libero_loadmore,
					.owl-theme .owl-controls .owl-nav div:hover,
					.libero-pagenavi .page-numbers.current,
					.libero-pagenavi .page-numbers:hover,
					.libero_one_category a,
					.sk-cube-grid .sk-cube,
					.widget_product_tag_cloud .tagcloud a:hover,
					.libero-main-header .libero-cart-mini > a:hover,
					.libero_recently_added_items > a:hover,
					.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
					.woocommerce #respond input#submit, 
					.woocommerce input.button,
					.libero-dropcap.libero-dropcap-style-1::after,
					.libero-addtocart a:hover,
					.libero-dropcap.libero-dropcap-style-2,
					.widget_tag_cloud a:hover,
					.libero_sticky_nav > a:hover,
					.libero-dropcap.libero-dropcap-style-3,
					.libero_promobox.libero_promobox_style_3 > a,
					.libero_promobox.libero_promobox_style_4 > a,
					.libero_promobox.libero_promobox_style_6 > a,
					.libero_post_tag a:hover,
					.rs-select-box .rs-select-item:hover,
					.pageLoading .pageLoadingInner
					{
					  background-color: $value !important;
					  -webkit-transition: background-color 0.3s ease-in-out;
					  transition: background-color 0.3s ease-in-out;
					}
					del
					{
					  -moz-text-decoration-color: $value !important;
						text-decoration-color: $value !important;
					}
				'
			)
		)
	) );
	
	
	// Category
	rs::addCustomizeTab(array(
		'title' => 'Blog Setting', 
		'name' => 'libero_customize_category',
		'priority' => 24,
		'controls' => array(
			array(
				'label' 		=> 'Layout Setting',
				'type' 			=> 'radio-image',
				'name' 			=> 'libero_cat_layout',
				'default_value'	=> 3,
				'items'        	=> array(
					'1' => get_template_directory_uri() .'/inc/images/fullwidth.jpg',
					'2' => get_template_directory_uri() .'/inc/images/sidebar_left.jpg',
					'3' => get_template_directory_uri() .'/inc/images/sidebar_right.jpg'
				)
			),
			array(
				'label' 		=> 'Select Sidebar',
				'type' 			=> 'select',
				'name'			=> 'libero_cat_sidebar',
				'items'			=> $libero_widgets,
				'default_value'	=> 'sidebar-1',
				'conditional_logic' => array(
					'items' => array(
						'libero_cat_layout' => '2|3'
					)
				)
			),
			array(
				'label' 		=> 'Template Setting',
				'type' 			=> 'radio-image',
				'name' 			=> 'libero_cat_template',
				'items'        	=> array(
					'large' => get_template_directory_uri() .'/inc/images/large.jpg',
					'box' => get_template_directory_uri() .'/inc/images/Box.jpg',
					'medium' => get_template_directory_uri() .'/inc/images/medium.jpg'
				),
				'default_value'	=> 1
			),
			array (
				'name' 			=> 'libero_cat_columns',
				'type' 			=> 'select',
				'label' 		=> esc_html__('Columns', 'libero'),
				'items'			=> array(
					"4" 	=> "4 Columns",
					"3" 	=> "3 Columns",
					"2" 	=> "2 Columns"
				),
				'default_value'	=> 2,
				'conditional_logic' => array(
					'items' => array(
						'libero_cat_template' => 'box'
					)
				)
			),
			array(
				'label' 		=> 'Posts per page',
				'type' 			=> 'text',
				'name'			=> 'libero_cat_numberpost',
				'default_value'	=> '10'
			),
			array(
				'label' 		=> 'Excerpt Length',
				'type' 			=> 'text',
				'name'			=> 'libero_cat_excerpt_length',
				'default_value'	=> '30'
			),
			array(
				'label' 		=> 'Page Navigation Style',
				'type' 			=> 'select',
				'name' 			=> 'libero_cat_pagenavi',
				'default_value'	=> 'number',
				'items'        	=> array(
					'number' => 'Number',
					'load_more' => 'Load More',
					'next_prev' => 'Next/Prev'
				)
			),
			array(
				'label' 		=> 'Number Posts Loadmore',
				'type' 			=> 'text',
				'name'			=> 'libero_cat_number_loadmore',
				'default_value'	=> '4'
			),
			array(
				'label' 		=> 'Disable Breadcrumb',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_hidden_breadcrumb'
			),
			array(
				'label' 		=> 'Disable Featured Image',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_hidden_thumbnail'
			),
			array(
				'label' 		=> 'Disable Category',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_hidden_category'
			),
			array(
				'label' 		=> 'Disable Date',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_hidden_date'
			),
			array(
				'label' 		=> 'Disable Excerpt',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_hidden_excerpt'
			),
			array(
				'label' 		=> 'Disable Readmore Link',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_hidden_read_more'
			),
			array(
				'label' 		=> 'Disable Share Social',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_hidden_share'
			)
		)
	) );
	
	// Search
	rs::addCustomizeTab(array(
		'title' => 'Search Setting', 
		'name' => 'libero_customize_search',
		'priority' => 25,
		'controls' => array(
			array(
				'label' 		=> 'Layout Setting',
				'type' 			=> 'radio-image',
				'name' 			=> 'libero_search_layout',
				'default_value'	=> 3,
				'items'        	=> array(
					'1' => get_template_directory_uri() .'/inc/images/fullwidth.jpg',
					'2' => get_template_directory_uri() .'/inc/images/sidebar_left.jpg',
					'3' => get_template_directory_uri() .'/inc/images/sidebar_right.jpg'
				)
			),
			array(
				'label' 		=> 'Select Sidebar',
				'type' 			=> 'select',
				'name'			=> 'libero_search_sidebar',
				'items'			=> $libero_widgets,
				'default_value'	=> 'sidebar-1',
				'conditional_logic' => array(
					'items' => array(
						'libero_cat_layout' => '2|3'
					)
				)
			),
			array(
				'label' 		=> 'Template Setting',
				'type' 			=> 'radio-image',
				'name' 			=> 'libero_search_template',
				'items'        	=> array(
					'large' => get_template_directory_uri() .'/inc/images/large.jpg',
					'box' => get_template_directory_uri() .'/inc/images/Box.jpg',
					'medium' => get_template_directory_uri() .'/inc/images/medium.jpg'
				),
				'default_value'	=> 1
			),
			array (
				'name' 			=> 'libero_search_columns',
				'type' 			=> 'select',
				'label' 		=> esc_html__('Columns', 'libero'),
				'items'			=> array(
					"4" 	=> "4 Columns",
					"3" 	=> "3 Columns",
					"2" 	=> "2 Columns"
				),
				'default_value'	=> 2,
				'conditional_logic' => array(
					'items' => array(
						'libero_cat_template' => 'box'
					)
				)
			),
			array(
				'label' 		=> 'Posts per page',
				'type' 			=> 'text',
				'name'			=> 'libero_search_numberpost',
				'default_value'	=> '10'
			),
			array(
				'label' 		=> 'Excerpt Length',
				'type' 			=> 'text',
				'name'			=> 'libero_search_excerpt_length',
				'default_value'	=> '30'
			),
			array(
				'label' 		=> 'Page Navigation Style',
				'type' 			=> 'select',
				'name' 			=> 'libero_search_pagenavi',
				'default_value'	=> 'number',
				'items'        	=> array(
					'number' => 'Number',
					'load_more' => 'Load More',
					'next_prev' => 'Next/Prev'
				)
			),
			array(
				'label' 		=> 'Number Posts Loadmore',
				'type' 			=> 'text',
				'name'			=> 'libero_search_number_loadmore',
				'default_value'	=> '4'
			),
			array(
				'label' 		=> 'Disable Breadcrumb',
				'type' 			=> 'checkbox',
				'name' 			=> 'search_hidden_breadcrumb'
			),
			array(
				'label' 		=> 'Disable Featured Image',
				'type' 			=> 'checkbox',
				'name' 			=> 'search_hidden_thumbnail'
			),
			array(
				'label' 		=> 'Disable Category',
				'type' 			=> 'checkbox',
				'name' 			=> 'search_hidden_category'
			),
			array(
				'label' 		=> 'Disable Date',
				'type' 			=> 'checkbox',
				'name' 			=> 'search_hidden_date'
			),
			array(
				'label' 		=> 'Disable Excerpt',
				'type' 			=> 'checkbox',
				'name' 			=> 'search_hidden_excerpt'
			),
			array(
				'label' 		=> 'Disable Readmore Link',
				'type' 			=> 'checkbox',
				'name' 			=> 'search_hidden_read_more'
			),
			array(
				'label' 		=> 'Disable Share Social',
				'type' 			=> 'checkbox',
				'name' 			=> 'search_hidden_share'
			)
		)
	) );
	
	
	// Page Setting
	rs::addCustomizeTab(array(
		'title' => 'Page Setting', 
		'name' => 'libero_customize_page_setting',
		'controls' => array(
			array(
				'label' 		=> 'Layout Default',
				'type' 			=> 'radio-image',
				'name' 			=> 'rst_page_layout',
				'default_value'	=> 1,
				'items'        	=> array(
					'1' => get_template_directory_uri() .'/inc/images/fullwidth.jpg',
					'2' => get_template_directory_uri() .'/inc/images/sidebar_left.jpg',
					'3' => get_template_directory_uri() .'/inc/images/sidebar_right.jpg'
				)
			),
			array(
				'label' 		=> 'Select Content Width',
				'type' 			=> 'select',
				'name'			=> 'libero_page_width',
				'items' 		=> array(
					'1' => 'Container',
					'0' => 'Full Width',
					'2' => '970',
				),
				'default_value'	=> 1
			),
			array(
				'label' 		=> 'Select Default Sidebar',
				'type' 			=> 'select',
				'name'			=> 'rst_page_sidebar',
				'items'			=> $libero_widgets,
				'default_value'	=> 'sidebar-1',
				'conditional_logic' => array(
					'items' => array(
						'rst_page_layout' => '2|3'
					)
				)
			),
			array(
				'label' 		=> 'Disable Comment Box',
				'type' 			=> 'checkbox',
				'name' 			=> 'page_hide_comment'
			)
		)
	));
	
	// Single Setting
	rs::addCustomizeTab(array(
		'title' => 'Single Setting', 
		'name' => 'libero_customize_single_setting',
		'controls' => array(
			array(
				'label' 		=> 'Layout Default',
				'type' 			=> 'radio-image',
				'name' 			=> 'rst_single_layout',
				'default_value'	=> 1,
				'items'        	=> array(
					'1' => get_template_directory_uri() .'/inc/images/fullwidth.jpg',
					'2' => get_template_directory_uri() .'/inc/images/sidebar_left.jpg',
					'3' => get_template_directory_uri() .'/inc/images/sidebar_right.jpg'
				)
			),
			array(
				'label' 		=> 'Select Default Sidebar',
				'type' 			=> 'select',
				'name'			=> 'rst_single_sidebar',
				'items'			=> $libero_widgets,
				'conditional_logic' => array(
					'items' => array(
						'rst_single_layout' => '2|3'
					)
				)
			),
			array(
				'label' 		=> 'Template Default',
				'type' 			=> 'radio-image',
				'name' 			=> 'rst_single_template',
				'default_value'	=> 1,
				'items'        	=> array(
					'1' => get_template_directory_uri() .'/inc/images/single-teamplate-1.jpg',
					'2' => get_template_directory_uri() .'/inc/images/single-teamplate-2.jpg'
				)
			),
			array(
				'label' 		=> 'Background Body',
				'type' 			=> 'rsbackground',
				'name' 			=> 'single_background_body',
				'css_selector'	=> 'body.single.single-post',
				'default_value'	=> '#ffffff'
			),
			array(
				'label' 		=> 'Enable load next post',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_enable_next_post'
			),
			array(
				'label' 		=> 'Disable Category',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_category'
			),
			array(
				'label' 		=> 'Disable Title',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_title'
			),
			array(
				'label' 		=> 'Disable Featured Image',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_thumbnail'
			),
			array(
				'label' 		=> 'Disable Date',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_date'
			),
			array(
				'label' 		=> 'Disable Comment Count',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_comment_count'
			),
			array(
				'label' 		=> 'Disable Views Count',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_views'
			),
			array(
				'label' 		=> 'Disable Tags',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_tags'
			),
			array(
				'label' 		=> 'Disable Author',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_author'
			),
			array(
				'label' 		=> 'Disable Social Share Buttons',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_share'
			),
			array(
				'label' 		=> 'Disable Most From Category',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_more_from_category'
			),
			array(
				'label' 		=> 'Disable Most Read',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_most_posts'
			),
			array(
				'label' 		=> 'Disable Comment',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_comment'
			),
			array(
				'label' 		=> 'Disable Breadcrumb',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_breadcrumb'
			),
			array(
				'label' 		=> 'Disable Recomment Box',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_hide_recomment_box'
			)
		)
	));
	
	
	if ( class_exists( 'WooCommerce' ) ) {
	// Woocomerce
	rs::addCustomizePanel(array(
		'title' => 'Woocomerce Setting', 
		'name' => 'panel_woocommerce',
		'priority' => 30
	));
	
	// Woocomerce > WooCommerce Setting
	rs::addCustomizeTab(array(
		'title' => 'Woocomerce Setting', 
		'name' => 'libero_customize_woocommerce_setting',
		'panel'	=> 'panel_woocommerce',
		'controls'	=> array(
			array(
				'label' 		=> 'Disable Widget Ads Bottom',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_woo_hide_ads_bottom'
			),
			array(
				'label' 		=> 'Disable Slider New Arrivals',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_woo_hide_new_arrivals'
			)
		)
	));
	
	// Woocomerce > Product Category Setting
	rs::addCustomizeTab(array(
		'title' => 'Product Category Setting', 
		'name' => 'libero_customize_taxonomy_woocomerce',
		'panel'	=> 'panel_woocommerce',
		'controls'	=> array(
			array(
				'label' 		=> 'Layout Default',
				'type' 			=> 'radio-image',
				'name' 			=> 'rst_cat_woo_layout',
				'default_value'	=> 2,
				'items'        	=> array(
					'1' => get_template_directory_uri() .'/inc/images/fullwidth.jpg',
					'2' => get_template_directory_uri() .'/inc/images/sidebar_left.jpg',
					'3' => get_template_directory_uri() .'/inc/images/sidebar_right.jpg'
				)
			),
			array(
				'label' 		=> 'Select Default Sidebar',
				'type' 			=> 'select',
				'name'			=> 'rst_cat_woo_sidebar',
				'items'			=> $libero_widgets,
				'conditional_logic' => array(
					'items' => array(
						'rst_cat_woo_layout' => '2|3'
					)
				)
			),
			array (
				'name' 			=> 'libero_shop_product_style',
				'type' 			=> 'select',
				'label' 		=> esc_html__('Show Style Default', 'libero'),
				'items'			=> array(
					"1" 	=> "Grid",
					"2" 	=> "List"
				),
				'default_value'	=> 1
			),
			array (
				'name' 			=> 'libero_shop_columns',
				'type' 			=> 'select',
				'label' 		=> esc_html__('Columns', 'libero'),
				'items'			=> array(
					"4" 	=> "4 Columns",
					"3" 	=> "3 Columns",
					"2" 	=> "2 Columns"
				),
				'default_value'	=> 3
			),
			array(
				'label' 		=> 'Posts per page',
				'type' 			=> 'text',
				'name'			=> 'shop_numberpost',
				'default_value'	=> '12',
				'conditional_logic' => array('libero_cat_template:not:i' => '0'),
			),
			array(
				'label' 		=> 'Disable Breadcrumb',
				'type' 			=> 'checkbox',
				'name' 			=> 'cat_woo_hide_breadcrumb'
			)
		)
	));
	
	// Woocomerce > Single Setting
	rs::addCustomizeTab(array(
		'title' => 'Single Setting', 
		'name' => 'libero_customize_single_woocomerce',
		'panel'	=> 'panel_woocommerce',
		'controls'	=> array(
			array(
				'label' 		=> 'Layout Default',
				'type' 			=> 'radio-image',
				'name' 			=> 'rst_single_woo_layout',
				'default_value'	=> 1,
				'items'        	=> array(
					'1' => get_template_directory_uri() .'/inc/images/fullwidth.jpg',
					'2' => get_template_directory_uri() .'/inc/images/sidebar_left.jpg',
					'3' => get_template_directory_uri() .'/inc/images/sidebar_right.jpg'
				)
			),
			array(
				'label' 		=> 'Select Default Sidebar',
				'type' 			=> 'select',
				'name'			=> 'rst_single_woo_sidebar',
				'items'			=> $libero_widgets,
				'conditional_logic' => array(
					'items' => array(
						'rst_single_woo_layout' => '2|3'
					)
				)
			),
			array(
				'label' 		=> 'Disable Related Product',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_woo_hide_related_product'
			),
			array(
				'label' 		=> 'Disable Breadcrumb',
				'type' 			=> 'checkbox',
				'name' 			=> 'single_woo_hide_breadcrumb'
			)
		)
	));
	}
	
	
	// Social Network
	rs::addCustomizeTab(array(
		'title' => 'Social Network', 
		'name' => 'libero_customize_social',
		'priority' => 30,
		'controls' => array(
			array(
				'label' 		=> 'Facebook',
				'type' 			=> 'text',
				'name' 			=> 'social_facebook'
			),
			array(
				'label' 		=> 'Google plus',
				'type' 			=> 'text',
				'name' 			=> 'social_google'
			),
			array(
				'label' 		=> 'Twitter',
				'type' 			=> 'text',
				'name' 			=> 'social_twitter'
			),
			array(
				'label' 		=> 'Tumblr',
				'type' 			=> 'text',
				'name' 			=> 'social_tumblr'
			),
			array(
				'label' 		=> 'Instagram',
				'type' 			=> 'text',
				'name' 			=> 'social_instagram'
			),
			array(
				'label' 		=> 'Youtube',
				'type' 			=> 'text',
				'name' 			=> 'social_youtube'
			),
			array(
				'label' 		=> 'Linkedin',
				'type' 			=> 'text',
				'name' 			=> 'social_linkedin'
			),
			array(
				'label' 		=> 'Flickr',
				'type' 			=> 'text',
				'name' 			=> 'social_flickr'
			),
			array(
				'label' 		=> 'Vimeo',
				'type' 			=> 'text',
				'name' 			=> 'social_vimeo'
			),
			array(
				'label' 		=> 'Pinterest',
				'type' 			=> 'text',
				'name' 			=> 'social_pinterest'
			),
			array(
				'label' 		=> 'Dribbble',
				'type' 			=> 'text',
				'name' 			=> 'social_dribbble'
			),
			array(
				'label' 		=> 'Digg',
				'type' 			=> 'text',
				'name' 			=> 'social_digg'
			),
			array(
				'label' 		=> 'Skype',
				'type' 			=> 'text',
				'name' 			=> 'social_skype'
			),
			array(
				'label' 		=> 'Deviantart',
				'type' 			=> 'text',
				'name' 			=> 'social_deviantart'
			),
			array(
				'label' 		=> 'Yahoo',
				'type' 			=> 'text',
				'name' 			=> 'social_yahoo'
			),
			array(
				'label' 		=> 'Reddit',
				'type' 			=> 'text',
				'name' 			=> 'social_reddit'
			)
		)
	) );
	
	
	// Social Sharing
	rs::addCustomizeTab(array(
		'title' => 'Social Sharing', 
		'name' => 'libero_customize_share_post',
		'priority' => 30,
		'controls' => array(
			array(
				'label' 		=> 'Disable Sharing On Facebook',
				'type' 			=> 'checkbox',
				'name' 			=> 'share_facebook'
			),
			array(
				'label' 		=> 'Disable Sharing On Google plus',
				'type' 			=> 'checkbox',
				'name' 			=> 'share_google'
			),
			array(
				'label' 		=> 'Disable Sharing On Twitter',
				'type' 			=> 'checkbox',
				'name' 			=> 'share_twitter'
			),
			array(
				'label' 		=> 'Disable Sharing On Pinterest',
				'type' 			=> 'checkbox',
				'name' 			=> 'share_pinterest'
			)
		)
	));
	
