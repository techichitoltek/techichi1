<?php
class App_Validate_Date_Abstract extends Zend_Validate_Abstract
  {
    // Zend_Validate_Date Message Constants
    const INVALID             = 'dateInvalid';
    const NOT_YYYY_MM_DD      = 'dateNotYYYY-MM-DD';
    const INVALID_DATE        = 'dateInvalidDate';
    const FALSEFORMAT         = 'dateFalseFormat';

    // Zend_Validate_Date Custom Message Constants
    const FIELD_INVALID        = 'dateInvalidField';
    const FIELD_NOT_YYYY_MM_DD = 'dateNotYYYY-MM-DDField';
    const FIELD_INVALID_DATE   = 'dateInvalidDateField';
    const FIELD_FALSEFORMAT    = 'dateFalseFormatField';

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $_messageTemplates = array(
      // Zend_Validate_Date Messages
      self::INVALID             => "Invalid type given, value should be string, integer, array or Zend_Date",
      self::NOT_YYYY_MM_DD      => "'%value%' is not of the format YYYY-MM-DD",
      self::INVALID_DATE        => "'%value%' does not appear to be a valid date",
      self::FALSEFORMAT         => "'%value%' does not fit given date format",

      // Zend_Validate_Date Custom Messages
      self::FIELD_INVALID         => "Invalid type given, date should be string, integer, array or Zend_Date",
      self::FIELD_NOT_YYYY_MM_DD  => "'%date%' is not of the format YYYY-MM-DD",
      self::FIELD_INVALID_DATE    => "'%date%' does not appear to be a valid date",
      self::FIELD_FALSEFORMAT     => "'%date%' does not fit given date format"
    );

    /**
     * Validation failure message variable mappings
     *
     * @var array
     */
    protected $_messageVariables = array(
      'date' => '_date',
      'format' => '_format',
      'locale' => '_locale'
    );

    /**
     * Date value used to compare.  When specified as a string, it can either be
     * a date (to be converted to Zend_Date) or a field name to lookup in the
     * context of the isValid method.
     *
     * @var string|Zend_Date
     */
    protected $_date;

    /**
     * Optional format
     *
     * @var string|null
     */
    protected $_format;

    /**
     * Optional locale
     *
     * @var string|Zend_Locale|null
     */
    protected $_locale;

    /**
     * Optional or equal which allows us to say less than or equal and vice
     * versa.
     *
     * @var boolean false
     */
    protected $_orEqual;

    /**
     * Sets validator options
     *
     * @param  string|Zend_Date   $date
     * @param  string             $format OPTIONAL
     * @param  string|Zend_Locale $locale OPTIONAL
     * @param  boolean            $orEqual OPTIONAL
     * @return void
     */
    public function __construct($date, $format = null, $locale = null,
        $orEqual = false)
    {
      $this->setDate($date);

      $this->setFormat($format);

      if ($locale === null) {
        require_once 'Zend/Registry.php';
        if (Zend_Registry::isRegistered('Zend_Locale')) {
          $locale = Zend_Registry::get('Zend_Locale');
        }
      }

      if ($locale !== null) {
        $this->setLocale($locale);
      }

      $this->setOrEqual($orEqual);
    }

    /**
     * Returns the date option
     *
     * @return string|Zend_Date
     */
    public function getDate()
    {
      return $this->_date;
    }

    /**
     * Sets the date option
     *
     * @param  string|Zend_Locale $date
     * @return My_Validate_Date_Abstract
     */
    public function setDate($date)
    {
      require_once 'Zend/Date.php';
      if (!$date instanceof Zend_Date) {
        if (Zend_Date::isDate($date, $this->_format, $this->_locale)) {
          $date = new Zend_Date($date, $this->_format, $this->_locale);
        }
      }

      $this->_date = $date;

      return $this;
    }

    /**
     * Returns the locale option
     *
     * @return string|Zend_Locale|null
     */
    public function getLocale()
    {
      return $this->_locale;
    }

    /**
     * Sets the locale option
     *
     * @param  string|Zend_Locale $locale
     * @return My_Validate_Date_Abstract
     */
    public function setLocale($locale = null)
    {
      require_once 'Zend/Locale.php';
      $this->_locale = Zend_Locale::findLocale($locale);

      if ($this->_date instanceof Zend_Date)
        $this->_date->setLocale($this->_locale);

      return $this;
    }

    /**
     * Returns the format option
     *
     * @return string|null
     */
    public function getFormat()
    {
      return $this->_format;
    }

    /**
     * Sets the format option
     *
     * @param  string $format
     * @return My_Validate_Date_Abstract
     */
    public function setFormat($format = null)
    {
      $this->_format = $format;
      return $this;
    }

    /**
     * Sets the orEqual option
     * @return My_Validate_Date_Abstract
     * @param boolean $orEqual[optional]
     */
    public function setOrEqual($orEqual = false)
    {
      $this->_orEqual = $orEqual;
      return $this;
    }

    /**
     * Returns the orEqual option.
     * @return boolean
     */
    public function getOrEqual()
    {
      return $this->_orEqual;
    }

    /**
     * Sets the value to be validated and clears the messages and errors arrays.
     * This method will also validate the value as a date.
     *
     * @return boolean
     * @param mixed $value
     */
    protected function _setValue($value)
    {
      if (!$value instanceof Zend_Date) {
        // Before we convert our value to Zend_Date, let's make sure it's valid.
        require_once 'Zend/Validate/Date.php';
        $validator = new Zend_Validate_Date($this->_format, $this->_locale);
        if ($validator->isValid($value) === false) {
          $errorMessageCodes = $validator->getErrors();
          $this->_error($errorMessageCodes[0], $value);
          return false;
        }

        $value = new Zend_Date($value, $this->_format, $this->_locale);
      }

      parent::_setValue($value);
      return true;
    }

    /**
     * Parses our specified date value. This method also determines if a field
     * name was passed in for the date and we will grab the value from the field
     * in the context array.
     *
     * @return boolean
     * @param array $context[optional]
     */
    protected function _parseDate($context = null)
    {
      // If our $date is a string and exists in our context array, then this means
      // the user passed in a field name as the date to parse.  Let's get the value
      // from the field and convert it to a Zend_Date
      if (!$this->_date instanceof Zend_Date) {
        if (is_array($context) && array_key_exists($this->_date, $context)) {
          // Get the field value from the context array
          $date = $context[$this->_date];

          // Before we set our date, let's make sure the fields value is a valid
          // date format
          require_once 'Zend/Validate/Date.php';
          $validator = new Zend_Validate_Date($this->_format, $this->_locale);
          if ($validator->isValid($date) === false) {
            $errorMessageCodes = $validator->getErrors();
            $errorCode = $errorMessageCodes[0] .'Field';
            $this->_error($errorCode, $date);
            return false;
          }

          $this->setDate($date);
        } else {
          // The $date isn't found in the context and isn't a Zend_Date instance.
          $this->_error(self::FIELD_INVALID_DATE, $this->_date);
          return false;
        }
      }
      return true;
    }

    public function isValid($value, $context = null)
    {}
  }