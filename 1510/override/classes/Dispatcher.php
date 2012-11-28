<?php

class Dispatcher extends DispatcherCore
{
	public $default_routes = array(
		'product_rule' => array(
			'controller' =>	'product',
			'rule' =>		'{category:/}{id}-{rewrite}{-:ean13}.html',
			'keywords' => array(
				'id' =>				array('regexp' => '[0-9]+', 'param' => 'id_product'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'ean13' =>			array('regexp' => '[0-9\pL\pM]*'),
				'category' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'categories' =>		array('regexp' => '[/_a-zA-Z0-9-\pL\pM]*'),
				'reference' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_keywords' =>	array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_title' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'manufacturer' =>	array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'supplier' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'price' =>			array('regexp' => '[0-9\.,]*'),
				'tags' =>			array('regexp' => '[a-zA-Z0-9-\pL\pM]*'),
			),
		),
		'layered_rule' => array(
			'controller' =>	'category',
			'rule' =>		'{id}-{rewrite}{/:selected_filters}',
			'keywords' => array(
				'id' =>				array('regexp' => '[0-9]+', 'param' => 'id_category'),
				/* Selected filters is used by the module blocklayered */
				'selected_filters' =>		array('regexp' => '.*', 'param' => 'selected_filters'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_keywords' =>	array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_title' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
			),
		),
		'category_rule' => array(
			'controller' =>	'category',
			'rule' =>		'{id}-{rewrite}',
			'keywords' => array(
				'id' =>				array('regexp' => '[0-9]+', 'param' => 'id_category'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_keywords' =>	array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_title' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
			),
		),
		'supplier_rule' => array(
			'controller' =>	'supplier',
			'rule' =>		'{id}__{rewrite}',
			'keywords' => array(
				'id' =>				array('regexp' => '[0-9]+', 'param' => 'id_supplier'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_keywords' =>	array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_title' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
			),
		),
		'manufacturer_rule' => array(
			'controller' =>	'manufacturer',
			'rule' =>		'{id}_{rewrite}',
			'keywords' => array(
				'id' =>				array('regexp' => '[0-9]+', 'param' => 'id_manufacturer'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_keywords' =>	array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_title' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
			),
		),
		'cms_rule' => array(
			'controller' =>	'cms',
			'rule' =>		'content/{id}-{rewrite}',
			'keywords' => array(
				'id' =>				array('regexp' => '[0-9]+', 'param' => 'id_cms'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_keywords' =>	array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_title' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
			),
		),
		'cms_category_rule' => array(
			'controller' =>	'cms',
			'rule' =>		'content/category/{id}-{rewrite}',
			'keywords' => array(
				'id' =>				array('regexp' => '[0-9]+', 'param' => 'id_cms_category'),
				'rewrite' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_keywords' =>	array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
				'meta_title' =>		array('regexp' => '[_a-zA-Z0-9-\pL\pM]*'),
			),
		),
		'module' => array(
			'controller' =>	null,
			'rule' =>		'module/{module}{/:controller}',
			'keywords' => array(
				'module' =>			array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'module'),
				'controller' =>		array('regexp' => '[_a-zA-Z0-9_-]+', 'param' => 'controller'),
			),
			'params' => array(
				'fc' => 'module',
			),
		),
	);
}

