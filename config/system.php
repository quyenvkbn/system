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

	/* Select the dropdown table as namepace Model, and the table must use the alanguage column
	'config' => [
		'post' => array('type' => 'dropdown', 'table' => 'Modules\Post\Entities\Post', 'first_select' => '--Chọn tin tức--', 'label_or_lang' => 'select_article'),
	],*/
	'script' => [
		'head' => array('type' => 'textarea', 'label_or_lang' => 'script_head'),

		'body' => array('type' => 'textarea', 'label_or_lang' => 'script_body'),
	],
];