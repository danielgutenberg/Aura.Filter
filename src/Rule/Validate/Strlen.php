<?php
/**
 *
 * This file is part of the Aura project for PHP.
 *
 * @package Aura.Filter
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
namespace Aura\Filter\Rule;

/**
 *
 * Validates that a value's length is within a given range.
 *
 * @package Aura.Filter
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 *
 */
class Strlen
{
    /**
     *
     * Validates that the length of the value is within a given range.
     *
     * @param mixed $len The minimum valid length.
     *
     * @return bool True if valid, false if not.
     *
     */
    public function validate($len)
    {
        $this->setParams(get_defined_vars());
        $value = $this->getValue();
        if (! is_scalar($value)) {
            return false;
        }

        return strlen($value) == $len;
    }

    /**
     *
     * Sanitize to the length given
     *
     * @param int $len
     *
     * @param string $pad_string
     *
     * @param int $pad_type
     *
     * @return bool True if the value was sanitized, false if not.
     *
     */
    public function sanitize($len, $pad_string = ' ', $pad_type = STR_PAD_RIGHT)
    {
        $this->setParams(get_defined_vars());
        $value = $this->getValue();
        if (! is_scalar($value)) {
            return false;
        }
        if (strlen($value) < $len) {
            $this->setValue(str_pad($value, $len, $pad_string, $pad_type));
        }
        if (strlen($value) > $len) {
            $this->setValue(substr($value, 0, $len));
        }

        return true;
    }
}
