<?php
class Cammino_Adwords_Model_Observer
{
	public function addTracker(Varien_Event_Observer $observer) {
		$block = Mage::app()->getFrontController()->getAction()->getLayout()->createBlock("adwords/tracker");
		Mage::app()->getFrontController()->getAction()->getLayout()->getBlock('content')->append($block);
	}
}
?>