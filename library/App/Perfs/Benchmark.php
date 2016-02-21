<?php
class App_Perfs_Benchmark{
    public $_stdProfiling        = true;
    public $_profiling           = true;
    public $_print               = false;
    public $_HTMLprofiler        = "";
    public $_profiler            = "";
    public $separator = "|";
    var $marker = array();

    protected $_timePerfDifftotal = null;
    protected $_timePerfDiff = null;
    protected $_decalage = null;

    /**
     * @return the $_timePerfDifftotal
     */
    public function getTimePerfDifftotal() {
        return $this->_timePerfDifftotal;
    }

    /**
     * @param field_type $_timePerfDifftotal
     */
    public function setTimePerfDifftotal($_timePerfDifftotal) {
        $this->_timePerfDifftotal = $_timePerfDifftotal;
    }

    /**
     * @return the $_timePerfDiff
     */
    public function getTimePerfDiff() {
        return $this->_timePerfDiff;
    }

    /**
     * @param field_type $_timePerfDiff
     */
    public function setTimePerfDiff($_timePerfDiff) {
        $this->_timePerfDiff = $_timePerfDiff;
    }

    /**
     * @return the $_decalage
     */
    public function getDecalage() {
        return $this->_decalage;
    }

    /**
     * @param field_type $_decalage
     */
    public function setDecalage($_decalage) {
        $this->_decalage = $_decalage;
    }

    // --------------------------------------------------------------------

    /**
     * Set a benchmark marker
     *
     * Multiple calls to this function can be made so that several
     * execution points can be timed
     *
     * @access  public
     * @param   string  $name   name of the marker
     * @return  void
     */
    function mark($name)
    {
        if(array_key_exists($name,$this->marker)){
            //$name = $this->marker[$name]
            $this->marker[$name]["time"] = microtime();
            $this->marker[$name]["nb"]++;
        }else{
            $this->marker[$name]["time"] = microtime();
            $this->marker[$name]["nb"] = 1;
        }
        //Zend_Debug::dump($this->marker[$name]["time"]);

    }

    // --------------------------------------------------------------------

    /**
     * Calculates the time difference between two marked points.
     *
     * If the first parameter is empty this function instead returns the
     * {elapsed_time} pseudo-variable. This permits the full system
     * execution time to be shown in a template. The output class will
     * swap the real value for this variable.
     *
     * @access  public
     * @param   string  a particular marked point
     * @param   string  a particular marked point
     * @param   integer the number of decimal places
     * @return  mixed
     */
    function elapsed_time($point1 = '', $point2 = '', $decimals = 6)
    {
        if ($point1 == '')
        {
            return '{elapsed_time}';
        }

        if ( ! isset($this->marker[$point1]))
        {
            return '';
        }

        if ( ! isset($this->marker[$point2]))
        {
            $this->marker[$point2] = microtime();
        }

        list($sm, $ss) = explode(' ', $this->marker[$point1]["time"]);
        list($em, $es) = explode(' ', $this->marker[$point2]["time"]);

        $duree = ($em + $es) - ($sm + $ss);

        $time = $duree*$this->marker[$point1]["nb"];

        return array("txt"=>number_format($duree, $decimals)."</td><td  width='10%' style='color:#990000;font-weight:normal;background-color:#ddd;'>".$this->marker[$point1]["nb"]." fois</td><td  width='15%' style='color:#990000;font-weight:normal;background-color:#ddd;'>soit approx. ".number_format($time, $decimals),"time"=>$time);
    }

    // --------------------------------------------------------------------

    /**
     * Memory Usage
     *
     * This function returns the {memory_usage} pseudo-variable.
     * This permits it to be put it anywhere in a template
     * without the memory being calculated until the end.
     * The output class will swap the real value for this variable.
     *
     * @access  public
     * @return  string
     */
    function memory_usage()
    {
        return '{memory_usage}';
    }

    function profiling(){
        $profiler = new App_Perfs_Profiler();
        return $profiler->run();
    }

}