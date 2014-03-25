<?php

/**
  *
  * EASY FIX THAI for PrestaShop 1.5.3.1
  *
  * @author Nokaek Development / devstore.in.th <nokaek@hotmail.com>
  * @copyright Nokaek Development / nokaek.com
  *
  */

class Validate extends ValidateCore
{
	public static function isLinkRewrite($link)
	{
		if (Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL'))
			return preg_match('/^[_a-zA-Z0-9\-\pL\pM]+$/u', $link);
		return preg_match('/^[_a-zA-Z0-9\-]+$/', $link);
	}

	public static function isRoutePattern($pattern)
	{
		if (Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL'))
			return preg_match('/^[_a-zA-Z0-9\(\)\.{}:\/\-\pL\pM]+$/u', $pattern);
		return preg_match('/^[_a-zA-Z0-9\(\)\.{}:\/\-]+$/', $pattern);
	}
}

