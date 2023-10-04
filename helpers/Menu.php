<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => ''
		),
		
		array(
			'path' => 'livery', 
			'label' => 'My Livery', 
			'icon' => '',
'submenu' => array(
		array(
			'path' => 'livery/Index', 
			'label' => 'My Livery', 
			'icon' => ''
		),
		
		array(
			'path' => 'livery/pending', 
			'label' => 'Pending', 
			'icon' => ''
		)
	)
		)
	);
		
	
	
}