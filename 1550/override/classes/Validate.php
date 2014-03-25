<?php

/**
  *
  * EASY FIX THAI for PrestaShop 1.5.5.0
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

	public static function isCleanHtml($html, $allow_iframe = true)
	{
		$events = 'onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange';
		$events .= '|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave|onerror|onselect|onreset|onabort|ondragdrop|onresize|onactivate|onafterprint|onmoveend';
		$events .= '|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onmove';
		$events .= '|onbounce|oncellchange|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondeactivate|ondrag|ondragend|ondragenter|onmousewheel';
		$events .= '|ondragleave|ondragover|ondragstart|ondrop|onerrorupdate|onfilterchange|onfinish|onfocusin|onfocusout|onhashchange|onhelp|oninput|onlosecapture|onmessage|onmouseup|onmovestart';
		$events .= '|onoffline|ononline|onpaste|onpropertychange|onreadystatechange|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onsearch|onselectionchange';
		$events .= '|onselectstart|onstart|onstop';

		if (preg_match('/<[\s]*script/ims', $html) || preg_match('/('.$events.')[\s]*=/ims', $html) || preg_match('/.*script\:/ims', $html))
			return false;

		if (!$allow_iframe && preg_match('/<[\s]*(i?frame|form|input|embed|object)/ims', $html))
			return false;

		return true;
	}
}

