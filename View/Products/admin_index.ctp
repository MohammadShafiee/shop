<?php
$this->viewVars['title_for_layout'] = __d('shop', 'Products');
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb(__d('shop', 'Products'), array('action' => 'index'));

$this->set('tableClass', 'table table-striped');

$this->append('table-heading');
	$tableHeaders = $this->Html->tableHeaders(array(
		$this->Paginator->sort('id', __d('shop', 'id')),
		$this->Paginator->sort('title', __d('shop', 'title')),
        $this->Paginator->sort('category_id', __d('shop', 'Category')),
		$this->Paginator->sort('price', __d('shop', 'price')),
		$this->Paginator->sort('off', __d('shop', 'off')),
		$this->Paginator->sort('count', __d('shop', 'count')),
		$this->Paginator->sort('created', __d('shop', 'created')),
		array(__d('croogo', 'Actions') => array('class' => 'actions')),
	));
	echo $this->Html->tag('thead', $tableHeaders);
$this->end();

$this->append('table-body');
	$rows = array();
	foreach ($products as $product):
		$row = array();
		$row[] = h($product['Product']['id']);
		$row[] = h($product['Product']['title']);
		$row[] = $this->Html->link($product['Category']['title'], array(
			'controller' => 'categories',
		'action' => 'view',
			$product['Category']['id'],
	));
		$row[] = number_format(h($product['Product']['price']));
		$row[] = h($product['Product']['off']) ? h($product['Product']['off']).'%' : h($product['Product']['off']);
		$row[] = h($product['Product']['count']);
		$row[] = jdate('Y-m-d H:i:s', h($product['Product']['created']), null, Configure::read('Site.timezone'), 'en');
		$actions = array($this->Croogo->adminRowActions($product['Product']['id']));
//		$actions[] = $this->Croogo->adminRowAction('', array(
//			'action' => 'view', $product['Product']['id']
//	), array(
//			'icon' => 'eye-open',
//		));
		$actions[] = $this->Croogo->adminRowAction('', array(
			'action' => 'edit',
			$product['Product']['id'],
		), array(
			'icon' => 'pencil',
		));
		$actions[] = $this->Croogo->adminRowAction('', array(
			'action' => 'delete',
			$product['Product']['id'],
		), array(
			'icon' => 'trash',
			'escape' => true,
		),
		__d('croogo', 'Are you sure you want to delete # %s?', $product['Product']['id'])
		);
		$row[] = $this->Html->div('item-actions', implode(' ', $actions));
		$rows[] = $this->Html->tableCells($row);
	endforeach;
	echo $this->Html->tag('tbody', implode('', $rows));
$this->end();
