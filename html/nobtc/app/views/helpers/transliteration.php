<?php


class TransliterationHelper extends Helper {

	function getNameLine($lineText, $name) {
		$sp = "[:space:]";
		$regExp = add_bracket($name);
		$regExp2 = "[$sp]*[^$sp]*".$regExp."[^$sp]*[$sp]*";
		if(eregi($regExp2, $lineText, $regs)) {
			$lineText = $regs[0];
		}
		$ret = trim(eregi_replace($regExp, "<span class=\"found\">\\0</span>", $lineText));

		return $ret;
	}
}