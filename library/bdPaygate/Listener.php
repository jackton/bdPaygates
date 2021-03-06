<?php

class bdPaygate_Listener
{
	public static function load_class($class, array &$extend)
	{
		static $classes = array(
			'XenForo_ControllerAdmin_Log',
			'XenForo_ControllerAdmin_UserUpgrade',
			'XenForo_ControllerPublic_Account',
			'XenForo_DataWriter_AddOn',
			'XenForo_DataWriter_User',
			'XenForo_DataWriter_UserUpgrade',
			'XenForo_Model_Thread',
			'XenForo_Model_Option',
			'XenForo_Model_UserUpgrade',
			'XenForo_ViewPublic_Account_Upgrades',

			'XenResource_ControllerAdmin_Category',
			'XenResource_ControllerPublic_Resource',
			'XenResource_DataWriter_Category',
			'XenResource_DataWriter_Resource',
			'XenResource_Model_Category',
			'XenResource_Model_Resource',
		);

		if (in_array($class, $classes))
		{
			$extend[] = 'bdPaygate_' . $class;
		}
	}

	public static function bdshop_stock_pricing_get_systems(array &$systems)
	{
		$systems[] = 'bdPaygate_bdShop_StockPricing';
	}

	public static function file_health_check(XenForo_ControllerAdmin_Abstract $controller, array &$hashes)
	{
		$hashes += bdPaygate_FileSums::getHashes();
	}

	public static function getXfrmVersionId()
	{
		$addOns = XenForo_Application::get('addOns');
		if (isset($addOns['XenResource']))
		{
			return $addOns['XenResource'];
		}

		return 0;
	}

}
