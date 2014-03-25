<?php

class Tools extends ToolsCore
{
	public static function str2url($str)
	{
		if (function_exists('mb_strtolower'))
			$str = mb_strtolower($str, 'utf-8');

		$str = trim($str);
		if (!function_exists('mb_strtolower'))
			$str = Tools::replaceAccentedChars($str);

		// Remove all non-whitelist chars.
		$str = preg_replace('/[^a-zA-Z0-9\s\'\:\/\[\]-\pL\pM]/u', '', $str);
		$str = preg_replace('/[\s\'\:\/\[\]-]+/', ' ', $str);
		$str = str_replace(array(' ', '/'), '-', $str);

		// If it was not possible to lowercase the string with mb_strtolower, we do it after the transformations.
		// This way we lose fewer special chars.
		if (!function_exists('mb_strtolower'))
			$str = strtolower($str);

		return $str;
	}
}

