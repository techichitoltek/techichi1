<?php
class App_Validate_Date_LessThan extends App_Validate_Date_Abstract
  {
    const NOT_LESS = 'notLessThan';

    /**
     * Sets validator options
     *
     * @param  string|Zend_Date   $date
     * @param  string             $format OPTIONAL
     * @param  string|Zend_Locale $locale OPTIONAL
     * @param  boolean            $orEqual OPTIONAL
     * @return void
     */
    public function __construct($params)
    {
      $format = null;$locale = null;$orEqual = false;
      if(array_key_exists("date", $params)) $date = $params['date'];
      if(array_key_exists("format", $params)) $format = $params['format'];
      if(array_key_exists("locale", $params)) $locale = $params['locale'];
      if(array_key_exists("orEqual", $params)) $orEqual = $params['orEqual'];
      $this->_messageTemplates[self::NOT_LESS] = "'%value%' is not less than '%date%'";
      parent::__construct($date, $format, $locale, $orEqual);
    }

    /**
     * Defined by Zend_Validate_Interface
     *
     * Returns true if $value is a valid date and is greater than the specified
     * $date. If optional $format or $locale is set the date format is checked
     * according to Zend_Date, see Zend_Date::isDate()
     *
     * @param  string|Zend_Date $value
     * @return boolean
     */
    public function isValid($value, $context = null)
    {
      if (!$this->_setValue($value)) return false;
      if (!$this->_parseDate($context)) return false;

      $compare = $this->_value->compare($this->_date);
      $compare = ($this->_orEqual) ? ($compare <= 0) : ($compare < 0);

      if (!$compare) {
        $this->_error(self::NOT_LESS);
        return false;
      }

      return true;
    }
  }