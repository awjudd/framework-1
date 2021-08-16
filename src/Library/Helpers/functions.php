<?php
/**
 * Convert a checkbox value to a boolean.
 *
 * @param string $value
 * @return bool
 */
function boolCheckbox(string $value): bool
{
	return $value === 'on' ? true : false;
}

/**
 * Convert a boolean to a string.
 *
 * @param bool $boolean
 * @return string
 */
function boolToString(bool $boolean): string
{
	return $boolean ? 'true' : 'false';
}



/**
 * Replace a string between two strings.
 *
 * @since 0.1.0
 *
 * @param string $str
 * @param string $needle_start
 * @param string $needle_end
 * @param string $replacement
 * @return string
 */
function replaceBetween(string $str, string $needle_start, string $needle_end, string $replacement): string
{
	$pos = strpos($str, $needle_start);
	$start = $pos === false ? 0 : $pos + strlen($needle_start);

	if($start === 0) {
		return $str."\n".$needle_start.$replacement;
	}

	$pos = strpos($str, $needle_end, $start);
	$end = $pos === false ? strlen($str) : $pos;

	return substr_replace($str, $replacement, $start, $end - $start);
}
