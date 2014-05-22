<?php
 
/**
* Custom Shipping Module
*/
class Ocaff_Shipping_Model_Carrier_Shippingmethod extends Mage_Shipping_Model_Carrier_Abstract {
 
	/**
	 * unique internal shipping method identifier -- must be the same word as the last word in the class
	 *
	 * @var string [a-z0-9_]
	 */
	protected $_code = 'shippingmethod';
 	
	/**
	 * Collect rates for this shipping method based on information in $request
	 *
	 * @param Mage_Shipping_Model_Rate_Request $data
	 * @return Mage_Shipping_Model_Rate_Result
	 */
	public function collectRates(Mage_Shipping_Model_Rate_Request $request) {

		// This will display all the information in the $request object that was passed to the module
		// Uncommenting this on live is a bad idea!
		//echo "<pre>";
		//print_r($request->debug());
		//echo "</pre>";


		// I like to put the request into an instance variable so I can access it anywhere in the class
		$this->quote_request = $request;

		// This class will hold all of the different shipping options we want to return to the cart
		$result = Mage::getModel('shipping/rate_result');
		
		
		$package_value = $request->getPackageValue();
		
		// This is a shipping option
		$method = Mage::getModel('shipping/rate_result_method');
		$method->setCarrier($this->_code);
		$method->setCarrierTitle('Custom Shipping Option');
		$method->setMethod('customoption');
		$method->setMethodTitle('Custom Shipping Option');
		$method->setCost(25);
		$method->setPrice(25);
		
		// Add the method to the list of results we want to return
		$result->append($method);
		
		return $result;
	}
  
	/**
	 * This method is used when viewing / listing Shipping Methods with Codes programmatically
	 */
	public function getAllowedMethods() {
		return array($this->_code => $this->getConfigData('name'));
	}

}