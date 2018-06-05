<?php

	/**
	 * Mark archive pages as active in the nav menu
	 */

	add_filter('nav_menu_css_class', function($classes, $item, $args)
	{
		if(isset($item->object_id))
		{
			$page = get_post($item->object_id);

			if($page->post_type == 'page')
			{
				$template = get_post_meta($page->ID, '_wp_page_template', true);

				if(preg_match("/archive-(.*?)\.php$/i", $template, $post_type))
				{
					if(is_singular($post_type[1]) or is_post_type_archive($post_type[1]))
					{
						$classes[] = 'current-menu-item';
					}
				}
			}
		}

		return array_unique($classes);
	}, 10, 3);
