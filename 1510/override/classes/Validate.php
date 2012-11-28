<?php

class Validate extends ValidateCore
{
	public static function isLinkRewrite($link)
	{
		return preg_match('/^[_a-zA-Z0-9\-\pL\pM]+$/u', $link);
	}
}

