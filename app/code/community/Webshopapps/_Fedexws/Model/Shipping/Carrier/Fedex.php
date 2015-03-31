<?php
/**
 * WebShopApps Shipping Module
 *
 * @category    WebShopApps
 * @package     WebShopApps_Fedexws
 * User         Genevieve Eddison
 * Date         20 March 2014
 * @copyright   Copyright (c) 2013 Zowta Ltd (http://www.WebShopApps.com)
 *              Copyright, 2013, Zowta, LLC - US license
 * @license     http://www.WebShopApps.com/license/license.txt - Commercial license
 *
 */

class Webshopapps_Fedexws_Model_Shipping_Carrier_Fedex extends Mage_Usa_Model_Shipping_Carrier_Fedex
{
    /**
     * Create soap client with selected wsdl
     *
     * @param string $wsdl
     * @param bool|int $trace
     * @return SoapClient
     */
    protected function _createSoapClient($wsdl, $trace = false)
    {
        $client = new SoapClient($wsdl, array('trace' => $trace));
        $client->__setLocation($this->getConfigFlag('sandbox_mode')
                ? 'https://wsbeta.fedex.com:443/web-services'
                : 'https://ws.fedex.com:443/web-services'
        );
        return $client;
    }
    
    
    /**
     * Get configuration data of carrier
     *
     * @param string $type
     * @param string $code
     * @return array|bool
     */
    public function getCode($type, $code='')
    {
        $codes = array(
            'method' => array(
                'EUROPE_FIRST_INTERNATIONAL_PRIORITY' => Mage::helper('usa')->__('FedEx Europe First Priority'),
                'FEDEX_1_DAY_FREIGHT'                 => Mage::helper('usa')->__('FedEx 1 Day Freight'),
                'FEDEX_2_DAY_FREIGHT'                 => Mage::helper('usa')->__('FedEx 2 Day Freight'),
                'FEDEX_2_DAY'                         => Mage::helper('usa')->__('FedEx 2 Day'),
                'FEDEX_3_DAY_FREIGHT'                 => Mage::helper('usa')->__('FedEx 3 Day Freight'),
                'FEDEX_EXPRESS_SAVER'                 => Mage::helper('usa')->__('FedEx Express Saver'),
                'FEDEX_GROUND'                        => Mage::helper('usa')->__('FedEx Ground'),
                'FIRST_OVERNIGHT'                     => Mage::helper('usa')->__('FedEx First Overnight'),
                'GROUND_HOME_DELIVERY'                => Mage::helper('usa')->__('FedEx Home Delivery'),
                'INTERNATIONAL_ECONOMY'               => Mage::helper('usa')->__('FedEx International Economy'),
                'INTERNATIONAL_ECONOMY_FREIGHT'       => Mage::helper('usa')->__('FedEx Intl Economy Freight'),
                'INTERNATIONAL_FIRST'                 => Mage::helper('usa')->__('FedEx International First'),
                'INTERNATIONAL_GROUND'                => Mage::helper('usa')->__('FedEx International Ground'),
                'INTERNATIONAL_PRIORITY'              => Mage::helper('usa')->__('FedEx International Priority'),
                'INTERNATIONAL_PRIORITY_FREIGHT'      => Mage::helper('usa')->__('FedEx Intl Priority Freight'),
                'PRIORITY_OVERNIGHT'                  => Mage::helper('usa')->__('FedEx Priority Overnight'),
                'SMART_POST'                          => Mage::helper('usa')->__('FedEx Smart Post'),
                'STANDARD_OVERNIGHT'                  => Mage::helper('usa')->__('FedEx Standard Overnight'),
                'FEDEX_FREIGHT'                       => Mage::helper('usa')->__('FedEx Freight'),
                'FEDEX_NATIONAL_FREIGHT'              => Mage::helper('usa')->__('FedEx National Freight'),
            ),
            'dropoff' => array(
                'REGULAR_PICKUP'          => Mage::helper('usa')->__('Regular Pickup'),
                'REQUEST_COURIER'         => Mage::helper('usa')->__('Request Courier'),
                'DROP_BOX'                => Mage::helper('usa')->__('Drop Box'),
                'BUSINESS_SERVICE_CENTER' => Mage::helper('usa')->__('Business Service Center'),
                'STATION'                 => Mage::helper('usa')->__('Station')
            ),
            'packaging' => array(
                'FEDEX_ENVELOPE' => Mage::helper('usa')->__('FedEx Envelope'),
                'FEDEX_PAK'      => Mage::helper('usa')->__('FedEx Pak'),
                'FEDEX_BOX'      => Mage::helper('usa')->__('FedEx Box'),
                'FEDEX_TUBE'     => Mage::helper('usa')->__('FedEx Tube'),
                'FEDEX_10KG_BOX' => Mage::helper('usa')->__('FedEx 10kg Box'),
                'FEDEX_25KG_BOX' => Mage::helper('usa')->__('FedEx 25kg Box'),
                'YOUR_PACKAGING' => Mage::helper('usa')->__('Your Packaging')
            ),
            'containers_filter' => array(
                array(
                    'containers' => array('FEDEX_ENVELOPE', 'FEDEX_PAK'),
                    'filters'    => array(
                        'within_us' => array(
                            'method' => array(
                                'FEDEX_EXPRESS_SAVER',
                                'FEDEX_2_DAY',
                                'STANDARD_OVERNIGHT',
                                'PRIORITY_OVERNIGHT',
                                'FIRST_OVERNIGHT',
                            )
                        ),
                        'from_us' => array(
                            'method' => array(
                                'INTERNATIONAL_FIRST',
                                'INTERNATIONAL_ECONOMY',
                                'INTERNATIONAL_PRIORITY',
                            )
                        )
                    )
                ),
                array(
                    'containers' => array('FEDEX_BOX', 'FEDEX_TUBE'),
                    'filters'    => array(
                        'within_us' => array(
                            'method' => array(
                                'FEDEX_2_DAY',
                                'STANDARD_OVERNIGHT',
                                'PRIORITY_OVERNIGHT',
                                'FIRST_OVERNIGHT',
                                'FEDEX_FREIGHT',
                                'FEDEX_1_DAY_FREIGHT',
                                'FEDEX_2_DAY_FREIGHT',
                                'FEDEX_3_DAY_FREIGHT',
                                'FEDEX_NATIONAL_FREIGHT',
                            )
                        ),
                        'from_us' => array(
                            'method' => array(
                                'INTERNATIONAL_FIRST',
                                'INTERNATIONAL_ECONOMY',
                                'INTERNATIONAL_PRIORITY',
                            )
                        )
                    )
                ),
                array(
                    'containers' => array('FEDEX_10KG_BOX', 'FEDEX_25KG_BOX'),
                    'filters'    => array(
                        'within_us' => array(),
                        'from_us' => array('method' => array('INTERNATIONAL_PRIORITY'))
                    )
                ),
                array(
                    'containers' => array('YOUR_PACKAGING'),
                    'filters'    => array(
                        'within_us' => array(
                            'method' =>array(
                                'FEDEX_GROUND',
                                'GROUND_HOME_DELIVERY',
                                'SMART_POST',
                                'FEDEX_EXPRESS_SAVER',
                                'FEDEX_2_DAY',
                                'STANDARD_OVERNIGHT',
                                'PRIORITY_OVERNIGHT',
                                'FIRST_OVERNIGHT',
                                'FEDEX_FREIGHT',
                                'FEDEX_1_DAY_FREIGHT',
                                'FEDEX_2_DAY_FREIGHT',
                                'FEDEX_3_DAY_FREIGHT',
                                'FEDEX_NATIONAL_FREIGHT',
                            )
                        ),
                        'from_us' => array(
                            'method' =>array(
                                'INTERNATIONAL_FIRST',
                                'INTERNATIONAL_ECONOMY',
                                'INTERNATIONAL_PRIORITY',
                                'INTERNATIONAL_GROUND',
                                'FEDEX_FREIGHT',
                                'FEDEX_1_DAY_FREIGHT',
                                'FEDEX_2_DAY_FREIGHT',
                                'FEDEX_3_DAY_FREIGHT',
                                'FEDEX_NATIONAL_FREIGHT',
                                'INTERNATIONAL_ECONOMY_FREIGHT',
                                'INTERNATIONAL_PRIORITY_FREIGHT',
                            )
                        )
                    )
                )
            ),

            'delivery_confirmation_types' => array(
                'NO_SIGNATURE_REQUIRED' => Mage::helper('usa')->__('Not Required'),
                'ADULT'                 => Mage::helper('usa')->__('Adult'),
                'DIRECT'                => Mage::helper('usa')->__('Direct'),
                'INDIRECT'              => Mage::helper('usa')->__('Indirect'),
            ),
        );

        if (!isset($codes[$type])) {
            return false;
        } elseif (''===$code) {
            return $codes[$type];
        }

        if (!isset($codes[$type][$code])) {
            return false;
        } else {
            return $codes[$type][$code];
        }
    }
    
}