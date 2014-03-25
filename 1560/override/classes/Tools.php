<?php

/**
  *
  * EASY FIX THAI for PrestaShop 1.5.6.0
  *
  * @author Nokaek Development / devstore.in.th <nokaek@hotmail.com>
  * @copyright Nokaek Development / nokaek.com
  *
  */

class Tools extends ToolsCore
{
	public static function str2url($str)
	{
		static $allow_accented_chars = null;

		if ($allow_accented_chars === null)
			$allow_accented_chars = Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL');

		$str = trim($str);

		if (function_exists('mb_strtolower'))
			$str = mb_strtolower($str, 'utf-8');
		if (!$allow_accented_chars)
			$str = Tools::replaceAccentedChars($str);

		// Remove all non-whitelist chars.
		if ($allow_accented_chars)
			$str = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]-\pL\pM]/u', '', $str);	
		else
			$str = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]-]/','', $str);
		
		$str = preg_replace('/[\s\'\:\/\[\]-]+/', ' ', $str);
		$str = str_replace(array(' ', '/'), '-', $str);

		// If it was not possible to lowercase the string with mb_strtolower, we do it after the transformations.
		// This way we lose fewer special chars.
		if (!function_exists('mb_strtolower'))
			$str = strtolower($str);

		return $str;
	}
}

