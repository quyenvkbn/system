<?php

return [
	'homepage' => [
		'brandname' => array('type' => 'text', 'label_or_lang' => 'brandname'),

		'company' => array('type' => 'text', 'label_or_lang' => 'company'),

		'logo' => array('type' => 'image', 'label_or_lang' => 'logo'),

		'description' => array('type' => 'textarea', 'label_or_lang' => 'description'),

		'content' => array('type' => 'editor', 'label_or_lang' => 'content'),
	],
	'seo' => [
		'meta_title' => array('type' => 'text', 'label_or_lang' => 'meta_title'),

		'meta_keyword' => array('type' => 'text', 'label_or_lang' => 'meta_keyword'),

		'meta_description' => array('type' => 'textarea', 'label_or_lang' => 'meta_description'),
		'meta_image' => array('type' => 'image', 'label_or_lang' => 'meta_image'),
	],
	'config' => [
		'menu' => array('type' => 'dropdown', 'table' => 'Modules\Menu\Entities\MenuCategory', 'first_select' => '--Chọn main menu--', 'label_or_lang' => 'Menu', 'deleted_at' => false),
		'slide' => array('type' => 'dropdown', 'table' => 'Modules\Slide\Entities\SlideCategory', 'first_select' => '--Chọn main slide--', 'label_or_lang' => 'Slide', 'deleted_at' => false),
	],
	'contact' => [
		'address' => array('type' => 'text', 'label_or_lang' => 'Địa chỉ'),
		'hotline' => array('type' => 'text', 'label_or_lang' => 'Hotline'),
		'fax' => array('type' => 'text', 'label_or_lang' => 'Fax'),
		'email' => array('type' => 'text', 'label_or_lang' => 'Email'),
		'website' => array('type' => 'text', 'label_or_lang' => 'Website'),
		'timework' => array('type' => 'text', 'label_or_lang' => 'Giờ làm việc'),
		'map' => array('type' => 'textarea', 'label_or_lang' => 'Map'),
	],
	'social' => [
		'facebook' => array('type' => 'text', 'label_or_lang' => 'Facebook'),
		'youtube' => array('type' => 'text', 'label_or_lang' => 'Youtube'),
		'twitter' => array('type' => 'text', 'label_or_lang' => 'Twitter'),
		'instagram' => array('type' => 'text', 'label_or_lang' => 'Instagram'),
		'google' => array('type' => 'text', 'label_or_lang' => 'Google'),
	],
	'script' => [
		'head' => array('type' => 'textarea', 'label_or_lang' => 'script_head'),
		'body' => array('type' => 'textarea', 'label_or_lang' => 'script_body'),
	],
];