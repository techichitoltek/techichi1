<?php
/**
* Time interval management
*
* @package App
* @package Measure
*/

/**
 * Time interval management
 *
 * Original 'Lib_Measure_Time' class here: {@link http://www.zfsnippets.com/snippets/view/id/39}
 * coded by {@link mailto:umpirsky@gmail.com Sasa Stamenkovic}.
 *
 * Exemple:
 * <code>
 * $n = 3600*24*4 + 3600*5 + 2585;
 *
 * $measureTime = new App_Time_Interval(
 * $n,
 * Zend_Measure_Time::SECOND,
 * Zend_Registry::get('Zend_Locale')
 * );
 * echo "$n s => " . $measureTime; // 366185 s => 4 day 5 h 43 min 5 s
 *
 * $measureTime = new App_Time_Interval(
 * $n,
 * Zend_Measure_Time::SECOND,
 * Zend_Registry::get('Zend_Locale')
 * );
 * $measureTime->setVisibleUnits(array(Zend_Measure_Time::MINUTE, Zend_Measure_Time::SECOND));
 * echo "$n s => " . $measureTime; // 366185 s => 6103 min 5 s
 *
 * $measureTime = new App_Time_Interval(
 * $n,
 * Zend_Measure_Time::SECOND,
 * Zend_Registry::get('Zend_Locale')
 * );
 * $measureTime->setVisibleUnits(array(Zend_Measure_Time::DAY));
 * echo "$n s => " . $measureTime; // 366185 s => 4 day
 * </code>
 *
 * @since ZF 1.9.1
 *
 * @package Core
 * @package Measure
 *
 */
class App_Time_Interval extends Zend_Measure_Time {

    /**
     * @var array Visible units
     */
    private $_visibleUnits = array (
            parent::YEAR => array (
                    '31536000',
                    'year'
            ),
            parent::MONTH => array (
                    '2628600',
                    'month'
            ),
            parent::DAY => array (
                    '86400',
                    'day'
            ),
            parent::HOUR => array (
                    '3600',
                    'h'
            ),
            parent::MINUTE => array (
                    '60',
                    'min'
            ),
            parent::SECOND => array (
                    '1',
                    's'
            )
    );

    /**
     * Call parent and sort units.
     *
     * @param mixed $value
     *        	Value as string, integer, real or float
     * @param string $type
     *        	A Zend_Measure_Area Type
     * @param string|Zend_Locale $locale
     *        	A Zend_Locale Type
     *
     * @throws Zend_Measure_Exception
     *
     */
    public function __construct($value, $type = null, $locale = null) {
        parent::__construct ( $value, $type, $locale );
        $this->setType ( parent::SECOND );
    }

    /**
     * Set new visible units
     *
     * @param array $units
     *
     */
    public function setVisibleUnits(array $units) {
        if (! count ( $units )) {
            throw new Cto_Core_Exception ( "At least one unit must be visible" );
        }

        $visibleUnits = array ();
        foreach ( $units as $unit ) {
            if (! isset ( $this->_units [$unit] ) || ! is_array ( $this->_units [$unit] ) || ! is_string ( $this->_units [$unit] [0] )) {

                trigger_error ( __METHOD__ . "(): $unit is not a valid unit", E_USER_WARNING );
                continue;
            }

            $visibleUnits [$unit] = $this->_units [$unit];
        }

        if (! count ( $visibleUnits )) {
            throw new Cto_Core_Exception ( 'No valid units left' );
        }

        array_multisort ( $visibleUnits, SORT_DESC );
        $this->_visibleUnits = $visibleUnits;
    }

    /**
     * Returns a string representation of this interval
     *
     * @return string
     *
     * @TDTODO : Apply translation on units (f.e. 'day') first and do not forget plural form (f.e. 'days')
     *
     */
    public function toString() {
        if (! $this->_value) {
            return '';
        }

        $s = array ();

        foreach ( $this->_visibleUnits as $unit ) {
            if (! is_array ( $unit ) || ! is_string ( $unit [0] )) {
                continue;
            }

            if ($this->_value / $unit [0] > 1) {
                $t = floor ( $this->_value / $unit [0] );
                $s [] = $t . ' ' . $unit [1];
                $this->_value -= $unit [0] * $t;
            }
        }

        return implode ( ' ', $s );
    }
}