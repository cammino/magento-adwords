<?php
class Cammino_Adwords_Block_Tracker extends Mage_Core_Block_Template {
	
	private $_active;
	private $_conversionId;
	private $_conversionLanguage;
	private $_conversionFormat;
	private $_conversionColor;
	private $_conversionLabel;
	private $_conversionValue;

	protected function _construct() {
		$this->_enabled = Mage::getStoreConfig('google/adwords_conversion/active');
		$this->_conversionId = Mage::getStoreConfig('google/adwords_conversion/conversion_id');
		$this->_conversionLanguage = Mage::getStoreConfig('google/adwords_conversion/conversion_language');
		$this->_conversionFormat = Mage::getStoreConfig('google/adwords_conversion/conversion_format');
		$this->_conversionColor = Mage::getStoreConfig('google/adwords_conversion/conversion_color');
		$this->_conversionLabel = Mage::getStoreConfig('google/adwords_conversion/conversion_label');
		$this->_conversionValue = number_format($this->getOrderTotal(), 2, ".", "");
	}

	protected function _toHtml() {
		$html .= "<script type=\"text/javascript\">\n";
		$html .= "/* <![CDATA[ */\n";
		$html .= "var google_conversion_id = ". strval($this->_conversionId) .";\n";
		$html .= "var google_conversion_language = \"". strval($this->_conversionLanguage) ."\";\n";
		$html .= "var google_conversion_format = \"". strval($this->_conversionFormat) ."\";\n";
		$html .= "var google_conversion_color = \"". strval($this->_conversionColor) ."\";\n";
		$html .= "var google_conversion_label = \"". strval($this->_conversionLabel) ."\";\n";
		$html .= "var google_conversion_value = ". strval($this->_conversionValue) .";\n";
		$html .= "/* ]]> */\n";
		$html .= "</script>\n";
		$html .= "<script type=\"text/javascript\" src=\"https://www.googleadservices.com/pagead/conversion.js\">\n";
		$html .= "</script>\n";
		$html .= "<noscript>\n";
		$html .= "<div style=\"display:inline;\">\n";
		$html .= "<img height=\"1\" width=\"1\" style=\"border-style:none;\" alt=\"\" src=\"https://www.googleadservices.com/pagead/conversion/". strval($this->_conversionId) ."/?value=". strval($this->_conversionValue) ."&amp;label=". strval($this->_conversionLabel) ."&amp;guid=ON&amp;script=0\"/>\n";
		$html .= "</div>\n";
		$html .= "</noscript>\n";
		return $html;
	}

	private function getOrderTotal() {
		$session = Mage::getSingleton('checkout/session');
		$order = Mage::getModel("sales/order");
		$order->loadByIncrementId($session->getLastRealOrderId());
		return $order->getTotalDue();
	}
	
}
?>