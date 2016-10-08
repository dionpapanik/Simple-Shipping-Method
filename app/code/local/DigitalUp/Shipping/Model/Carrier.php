<?php

class DigitalUp_Shipping_Model_Carrier
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    /**
     * Carrier's code, as defined in parent class
     *
     * @var string
     */
    protected $_code = 'digitalup_shipping';

    /**
     * Returns available shipping rates for DigitalUp Shipping carrier
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        /** @var Mage_Shipping_Model_Rate_Result $result */
        $result = Mage::getModel('shipping/rate_result');

        $result->append($this->_getAthensRate());
        $result->append($this->_getNeaSmirniRate());

        return $result;
    }

    /**
     * Returns Allowed shipping methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return array(
            'athens' => 'Athens Store Pickup',
            'nsmirni' => 'Nea Smirni Store Pickup',
        );
    }

    /**
     * Get Athens Store Pickup
     *
     * @return Mage_Shipping_Model_Rate_Result_Method
     */
    protected function _getAthensRate()
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $method */
        $method = Mage::getModel('shipping/rate_result_method');


        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod('athens');
        $method->setMethodTitle($this->getConfigData('method1'));
        $method->setPrice(0);
        $method->setCost(0);

        return $method;
    }

    /**
     * Get Nea Smirni Store Pickup
     *
     * @return Mage_Shipping_Model_Rate_Result_Method
     */
    protected function _getNeaSmirniRate()
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $method */
        $method = Mage::getModel('shipping/rate_result_method');

        $method->setCarrier($this->_code);
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod('nsmirni');
        $method->setMethodTitle($this->getConfigData('method2'));
        $method->setPrice(0);
        $method->setCost(0);

        return $method;
    }
}