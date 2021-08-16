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
