<?php

/**
  *
  * EASY FIX THAI for PrestaShop 1.5.6.0
  *
  * @author Nokaek Development / devstore.in.th <nokaek@hotmail.com>
  * @copyright Nokaek Development / nokaek.com
  *
  */

	define('PREG_CLASS_SEARCH_EXCLUDE_THAI',
	'\x{0}-\x{2c}\x{2e}-\x{2f}\x{3a}-\x{40}\x{5b}-\x{60}\x{7b}-\x{bf}\x{d7}\x{f7}\x{2b0}-'.
	'\x{385}\x{387}\x{3f6}\x{482}-\x{489}\x{559}-\x{55f}\x{589}-\x{5c7}\x{5f3}-'.
	'\x{61f}\x{640}\x{64b}-\x{65e}\x{66a}-\x{66d}\x{670}\x{6d4}\x{6d6}-\x{6ed}'.
	'\x{6fd}\x{6fe}\x{700}-\x{70f}\x{711}\x{730}-\x{74a}\x{7a6}-\x{7b0}\x{901}-'.
	'\x{903}\x{93c}\x{93e}-\x{94d}\x{951}-\x{954}\x{962}-\x{965}\x{970}\x{981}-'.
	'\x{983}\x{9bc}\x{9be}-\x{9cd}\x{9d7}\x{9e2}\x{9e3}\x{9f2}-\x{a03}\x{a3c}-'.
	'\x{a4d}\x{a70}\x{a71}\x{a81}-\x{a83}\x{abc}\x{abe}-\x{acd}\x{ae2}\x{ae3}'.
	'\x{af1}-\x{b03}\x{b3c}\x{b3e}-\x{b57}\x{b70}\x{b82}\x{bbe}-\x{bd7}\x{bf0}-'.
	'\x{c03}\x{c3e}-\x{c56}\x{c82}\x{c83}\x{cbc}\x{cbe}-\x{cd6}\x{d02}\x{d03}'.
	'\x{d3e}-\x{d57}\x{d82}\x{d83}\x{dca}-\x{df4}-\x{e3f}\x{e4d}\x{e4e}'.
	'\x{e4f}\x{e5a}\x{e5b}\x{eb1}\x{eb4}-\x{ebc}\x{ec6}-\x{ecd}\x{f01}-\x{f1f}'.
	'\x{f2a}-\x{f3f}\x{f71}-\x{f87}\x{f90}-\x{fd1}\x{102c}-\x{1039}\x{104a}-'.
	'\x{104f}\x{1056}-\x{1059}\x{10fb}\x{10fc}\x{135f}-\x{137c}\x{1390}-\x{1399}'.
	'\x{166d}\x{166e}\x{1680}\x{169b}\x{169c}\x{16eb}-\x{16f0}\x{1712}-\x{1714}'.
	'\x{1732}-\x{1736}\x{1752}\x{1753}\x{1772}\x{1773}\x{17b4}-\x{17db}\x{17dd}'.
	'\x{17f0}-\x{180e}\x{1843}\x{18a9}\x{1920}-\x{1945}\x{19b0}-\x{19c0}\x{19c8}'.
	'\x{19c9}\x{19de}-\x{19ff}\x{1a17}-\x{1a1f}\x{1d2c}-\x{1d61}\x{1d78}\x{1d9b}-'.
	'\x{1dc3}\x{1fbd}\x{1fbf}-\x{1fc1}\x{1fcd}-\x{1fcf}\x{1fdd}-\x{1fdf}\x{1fed}-'.
	'\x{1fef}\x{1ffd}-\x{2070}\x{2074}-\x{207e}\x{2080}-\x{2101}\x{2103}-\x{2106}'.
	'\x{2108}\x{2109}\x{2114}\x{2116}-\x{2118}\x{211e}-\x{2123}\x{2125}\x{2127}'.
	'\x{2129}\x{212e}\x{2132}\x{213a}\x{213b}\x{2140}-\x{2144}\x{214a}-\x{2b13}'.
	'\x{2ce5}-\x{2cff}\x{2d6f}\x{2e00}-\x{3005}\x{3007}-\x{303b}\x{303d}-\x{303f}'.
	'\x{3099}-\x{309e}\x{30a0}\x{30fb}\x{30fd}\x{30fe}\x{3190}-\x{319f}\x{31c0}-'.
	'\x{31cf}\x{3200}-\x{33ff}\x{4dc0}-\x{4dff}\x{a015}\x{a490}-\x{a716}\x{a802}'.
	'\x{E000}-\x{F8FF}\x{FB29}\x{FD3E}-\x{FD3F}\x{FDFC}-\x{FDFD}'.
	'\x{fd3f}\x{fdfc}-\x{fe6b}\x{feff}-\x{ff0f}\x{ff1a}-\x{ff20}\x{ff3b}-\x{ff40}'.
	'\x{ff5b}-\x{ff65}\x{ff70}\x{ff9e}\x{ff9f}\x{ffe0}-\x{fffd}');

class Search extends SearchCore
{
	public static function sanitize($string, $id_lang, $indexation = false, $iso_code = false)
	{
		$string = trim($string);
		if (empty($string))
			return '';
		$string = Tools::strtolower(strip_tags($string));
		$string = html_entity_decode($string, ENT_NOQUOTES, 'utf-8');

		$string = preg_replace('/(['.PREG_CLASS_NUMBERS.']+)['.PREG_CLASS_PUNCTUATION.']+(?=['.PREG_CLASS_NUMBERS.'])/u', '\1', $string);
		$string = preg_replace('/['.PREG_CLASS_SEARCH_EXCLUDE_THAI.']+/u', ' ', $string);

		if ($indexation)
			$string = preg_replace('/[._-]+/', '', $string);
		else
		{
			$string = preg_replace('/[._]+/', '', $string);
			$string = ltrim(preg_replace('/([^ ])-/', '$1', ' '.$string));
			$string = preg_replace('/[._]+/', '', $string);
			$string = preg_replace('/[^\s]-+/', '', $string);
		}

		$blacklist = Tools::strtolower(Configuration::get('PS_SEARCH_BLACKLIST', $id_lang));
		if (!empty($blacklist))
		{
			$string = preg_replace('/(?<=\s)('.$blacklist.')(?=\s)/Su', '', $string);
			$string = preg_replace('/^('.$blacklist.')(?=\s)/Su', '', $string);
			$string = preg_replace('/(?<=\s)('.$blacklist.')$/Su', '', $string);
			$string = preg_replace('/^('.$blacklist.')$/Su', '', $string);
		}

		if (!$indexation)
		{
			$words = explode(' ', $string);
			$processed_words = array();
			// search for aliases for each word of the query
			foreach ($words as $word)
			{
				$alias = new Alias(null, $word);
				if (Validate::isLoadedObject($alias))
					$processed_words[] = $alias->search;
				else
					$processed_words[] = $word;
			}
			$string = implode(' ', $processed_words);
		}

		// If the language is constituted with symbol and there is no "words", then split every chars
		if (in_array($iso_code, array('zh', 'tw', 'ja')) && function_exists('mb_strlen'))
		{
			// Cut symbols from letters
			$symbols = '';
			$letters = '';
			foreach (explode(' ', $string) as $mb_word)
				if (strlen(Tools::replaceAccentedChars($mb_word)) == mb_strlen(Tools::replaceAccentedChars($mb_word)))
					$letters .= $mb_word.' ';
				else
					$symbols .= $mb_word.' ';
		
			if (preg_match_all('/./u', $symbols, $matches))
				$symbols = implode(' ', $matches[0]);

			$string = $letters.$symbols;
		}
		elseif ($indexation)
		{
			$minWordLen = (int)Configuration::get('PS_SEARCH_MINWORDLEN');
			if ($minWordLen > 1)
			{
				$minWordLen -= 1;
				$string = preg_replace('/(?<=\s)[^\s]{1,'.$minWordLen.'}(?=\s)/Su', ' ', $string);
				$string = preg_replace('/^[^\s]{1,'.$minWordLen.'}(?=\s)/Su', '', $string);
				$string = preg_replace('/(?<=\s)[^\s]{1,'.$minWordLen.'}$/Su', '', $string);
				$string = preg_replace('/^[^\s]{1,'.$minWordLen.'}$/Su', '', $string);
			}
		}

		$string = trim(preg_replace('/\s+/', ' ', $string));
		return $string;
	}
}

