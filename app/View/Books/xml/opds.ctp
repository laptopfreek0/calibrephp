<?php
	$feed = $this->Opds->getDefaultXmlArray(array(
		'title'   => 'Calibre Home',
		'id'      => array('calibre:home'),
		'updated' => $info['books']['summary']['updated'],
	));

	$feed = $this->Opds->addLink($feed, array(
		'href'  => $this->Html->url(array('controller'=>'books', 'action'=>'opds.xml'), false),
		'rel'   => 'start',
		'title' => 'Home',
	));

	$feed = $this->Opds->addLink($feed, array(
		'href' => $this->Html->url(array('controller'=>'books', 'action'=>'opds.xml'), false),
		'rel'  => 'self'
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'authors', 'action'=>'index.xml'), false),
		'title'   => 'By Author',
		'updated' => $info['authors']['summary']['updated'],
		'id'      => 'calbire:authors',
		'content' => 'books sorted by ' . $this->Txt->numberToWords($info['authors']['summary']['count'], true) . ' authors',
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'publishers', 'action'=>'index.xml'), false),
		'title'   => 'By Publisher',
		'updated' => $info['publishers']['summary']['updated'],
		'id'      => 'calbire:publishers',
		'content' => 'books grouped by ' . $this->Txt->numberToWords($info['publishers']['summary']['count'], true) . ' publishers',
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'ratings', 'action'=>'index.xml'), false),
		'title'   => 'By Rating',
		'updated' => $info['ratings']['summary']['updated'],
		'id'      => 'calbire:ratings',
		'content' => 'books grouped by ' . $this->Txt->numberToWords($info['ratings']['summary']['count'], true) . ' ratings',
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'series', 'action'=>'index.xml'), false),
		'title'   => 'By series',
		'updated' => $info['series']['summary']['updated'],
		'id'      => 'calbire:series',
		'content' => 'books group by ' . $this->Txt->numberToWords($info['series']['summary']['count'], true) . ' series',
	));

	$feed = $this->Opds->addEntry($feed, array(
		'link'    => $this->Html->url(array('controller'=>'tags', 'action'=>'index.xml'), false),
		'title'   => 'By tags',
		'updated' => $info['tags']['summary']['updated'],
		'id'      => 'calbire:tags',
		'content' => 'books group by ' . $this->Txt->numberToWords($info['tags']['summary']['count'], true) . ' tags',
	));

	$xmlObject = Xml::fromArray($feed);
	$feed      = $xmlObject->asXML();
	echo $feed;
?>
