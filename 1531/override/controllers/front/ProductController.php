<?php

/**
  *
  * EASY FIX THAI for PrestaShop 1.5.3.1
  *
  * @author Nokaek Development / devstore.in.th <nokaek@hotmail.com>
  * @copyright Nokaek Development / nokaek.com
  *
  */

class ProductController extends ProductControllerCore
{
	protected function transformDescriptionWithImg($desc)
	{
		//$reg = '/\[img-([0-9]+)-(left|right)-([a-z]+)\]/';
		$reg = '/\[img\-([0-9]+)\-(left|right)\-([a-zA-Z0-9-_]+)\]/';
		while (preg_match($reg, $desc, $matches))
		{
			$link_lmg = $this->context->link->getImageLink($this->product->link_rewrite, $this->product->id.'-'.$matches[1], $matches[3]);
			$class = $matches[2] == 'left' ? 'class="imageFloatLeft"' : 'class="imageFloatRight"';
			$html_img = '<img src="'.$link_lmg.'" alt="" '.$class.'/>';
			$desc = str_replace($matches[0], $html_img, $desc);
		}
		return $desc;
	}
}

