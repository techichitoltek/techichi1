<?php
class App_Perfs_Profiler {

    protected $_currentRequestInfo = null;

    function App_Perfs_Profiler()
    {
        $this->_currentRequestInfo = Zend_Registry::get('currentRequestInfo');
    }

    public function myApp(){
        return MyTools_MyApp::singleton(); /* MyTools_MyApp */
    }

    // --------------------------------------------------------------------

    /**
     * Auto Profiler
     *
     * This function cycles through the entire array of mark points and
     * matches any two points that are named identically (ending in "_start"
     * and "_end" respectively).  It then compiles the execution times for
     * all points and returns it as an array
     *
     * @access  private
     * @return  array
     */
    function _compile_benchmarks()
    {
        $benchmark = Zend_Registry::get('benchmark');
        $profile = array();
        foreach ($benchmark->marker as $key => $val)
        {
            // We match the "end" marker so that the list ends
            // up in the order that it was defined
            if (preg_match("/(.+?)_end/i", $key, $match))
            {
                if (isset($benchmark->marker[$match[1].'_end']) AND isset($benchmark->marker[$match[1].'_start']))
                {
                    $profile[$match[1]] = $benchmark->elapsed_time($match[1].'_start', $key);
                }
            }
        }

        // Build a table containing the profile data.
        // Note: At some point we should turn this into a template that can
        // be modified.  We also might want to make this data available to be logged

        $output  = "\n\n";
        $output .= '<fieldset style="border:1px solid #990000;padding:6px 10px 10px 10px;margin:0 0 20px 0;background-color:#eee">';
        $output .= "\n";
        $output .= '<legend style="color:#990000;">&nbsp;&nbsp; profiler_benchmarks &nbsp;&nbsp;</legend>';
        $output .= "\n";
        $output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";

        $totalTime = $profile["total_execution_time"]["time"];

        foreach ($profile as $key => $val)
        {
            //$key = ucwords(str_replace(array('_', '-'), ' ', $key));
            $key = str_replace($benchmark->separator, "</td><td width='25%' style='color:#000;font-weight:bold;background-color:#ddd;'>", $key);
            if($key == "total_execution_time") $key .= "</td><td style='color:#000;font-weight:bold;background-color:#ddd;'>";
            $poucentage = (($val['time'])/$totalTime)*100;
            $output .= "<tr><td width='25%' style='color:#000;font-weight:bold;background-color:#ddd;'>".$key."&nbsp;&nbsp;</td><td width='10%' style='color:#990000;font-weight:normal;background-color:#ddd;'>".$val['txt']."</td><td style='color:#990000;font-weight:normal;background-color:#ddd;'> ".number_format($poucentage,3)."%</td></tr>\n";
        }

        $output .= "</table>\n";
        $output .= "</fieldset>";

        return $output;
    }

    // --------------------------------------------------------------------

    /**
     * Compile Queries
     *
     * @access  private
     * @return  string
     */
    function _compile_queries()
    {
        $dbs = array();

        // Let's determine which databases are currently connected to
        foreach (get_object_vars($this->CI) as $CI_object)
        {
            if (is_object($CI_object) && is_subclass_of(get_class($CI_object), 'CI_DB') )
            {
                $dbs[] = $CI_object;
            }
        }

        if (count($dbs) == 0)
        {
            $output  = "\n\n";
            $output .= '<fieldset style="border:1px solid #0000FF;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
            $output .= "\n";
            $output .= '<legend style="color:#0000FF;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_queries').'&nbsp;&nbsp;</legend>';
            $output .= "\n";
            $output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";
            $output .="<tr><td width='100%' style='color:#0000FF;font-weight:normal;background-color:#eee;'>".$this->CI->lang->line('profiler_no_db')."</td></tr>\n";
            $output .= "</table>\n";
            $output .= "</fieldset>";

            return $output;
        }

        // Load the text helper so we can highlight the SQL
        $this->CI->load->helper('text');

        // Key words we want bolded
        $highlight = array('SELECT', 'DISTINCT', 'FROM', 'WHERE', 'AND', 'LEFT&nbsp;JOIN', 'ORDER&nbsp;BY', 'GROUP&nbsp;BY', 'LIMIT', 'INSERT', 'INTO', 'VALUES', 'UPDATE', 'OR', 'HAVING', 'OFFSET', 'NOT&nbsp;IN', 'IN', 'LIKE', 'NOT&nbsp;LIKE', 'COUNT', 'MAX', 'MIN', 'ON', 'AS', 'AVG', 'SUM', '(', ')');

        $output  = "\n\n";

        foreach ($dbs as $db)
        {
            $output .= '<fieldset style="border:1px solid #0000FF;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
            $output .= "\n";
            $output .= '<legend style="color:#0000FF;">&nbsp;&nbsp;'.$this->CI->lang->line('profiler_database').':&nbsp; '.$db->database.'&nbsp;&nbsp;&nbsp;'.$this->CI->lang->line('profiler_queries').': '.count($this->CI->db->queries).'&nbsp;&nbsp;&nbsp;</legend>';
            $output .= "\n";
            $output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";

            if (count($db->queries) == 0)
            {
                $output .= "<tr><td width='100%' style='color:#0000FF;font-weight:normal;background-color:#eee;'>".$this->CI->lang->line('profiler_no_queries')."</td></tr>\n";
            }
            else
            {
                foreach ($db->queries as $key => $val)
                {
                    $time = number_format($db->query_times[$key], 4);

                    $val = highlight_code($val, ENT_QUOTES);

                    foreach ($highlight as $bold)
                    {
                        $val = str_replace($bold, '<strong>'.$bold.'</strong>', $val);
                    }

                    $output .= "<tr><td width='1%' valign='top' style='color:#990000;font-weight:normal;background-color:#ddd;'>".$time."&nbsp;&nbsp;</td><td style='color:#000;font-weight:normal;background-color:#ddd;'>".$val."</td></tr>\n";
                }
            }

            $output .= "</table>\n";
            $output .= "</fieldset>";

        }

        return $output;
    }


    // --------------------------------------------------------------------

    /**
     * Compile $_GET Data
     *
     * @access  private
     * @return  string
     */
    function _compile_get()
    {
        $output  = "\n\n";
        $output .= '<fieldset style="border:1px solid #cd6e00;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
        $output .= "\n";
        $output .= '<legend style="color:#cd6e00;">&nbsp;&nbsp; profiler_get_data &nbsp;&nbsp;</legend>';
        $output .= "\n";

        if (count($_GET) == 0)
        {
            $output .= "<div style='color:#cd6e00;font-weight:normal;padding:4px 0 4px 0'> profiler_no_get </div>";
        }
        else
        {
            $output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";

            foreach ($_GET as $key => $val)
            {
                if ( ! is_numeric($key))
                {
                    $key = "'".$key."'";
                }

                $output .= "<tr><td width='50%' style='color:#000;background-color:#ddd;'>&#36;_GET[".$key."]&nbsp;&nbsp; </td><td width='50%' style='color:#cd6e00;font-weight:normal;background-color:#ddd;'>";
                if (is_array($val))
                {
                    $output .= "<pre>" . htmlspecialchars(stripslashes(print_r($val, true))) . "</pre>";
                }
                else
                {
                    $output .= htmlspecialchars(stripslashes($val));
                }
                $output .= "</td></tr>\n";
            }

            $output .= "</table>\n";
        }
        $output .= "</fieldset>";

        return $output;
    }

    // --------------------------------------------------------------------

    /**
     * Compile $_POST Data
     *
     * @access  private
     * @return  string
     */
    function _compile_post()
    {
        $output  = "\n\n";
        $output .= '<fieldset style="border:1px solid #009900;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
        $output .= "\n";
        $output .= '<legend style="color:#009900;">&nbsp;&nbsp; profiler_post_data &nbsp;&nbsp;</legend>';
        $output .= "\n";

        if (count($_POST) == 0)
        {
            $output .= "<div style='color:#009900;font-weight:normal;padding:4px 0 4px 0'> profiler_no_post </div>";
        }
        else
        {
            $output .= "\n\n<table cellpadding='4' cellspacing='1' border='0' width='100%'>\n";

            foreach ($_POST as $key => $val)
            {
                if ( ! is_numeric($key))
                {
                    $key = "'".$key."'";
                }

                $output .= "<tr><td width='50%' style='color:#000;background-color:#ddd;'>&#36;_POST[".$key."]&nbsp;&nbsp; </td><td width='50%' style='color:#009900;font-weight:normal;background-color:#ddd;'>";
                if (is_array($val))
                {
                    $output .= "<pre>" . htmlspecialchars(stripslashes(print_r($val, true))) . "</pre>";
                }
                else
                {
                    $output .= htmlspecialchars(stripslashes($val));
                }
                $output .= "</td></tr>\n";
            }

            $output .= "</table>\n";
        }
        $output .= "</fieldset>";

        return $output;
    }

    // --------------------------------------------------------------------

    /**
     * Show query string
     *
     * @access  private
     * @return  string
     */
    function _compile_uri_string()
    {
        $uri = $this->_currentRequestInfo['requestUri'];

        $output  = "\n\n";
        $output .= '<fieldset style="border:1px solid #000;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
        $output .= "\n";
        $output .= '<legend style="color:#000;">&nbsp;&nbsp; profiler_uri_string &nbsp;&nbsp;</legend>';
        $output .= "\n";

        if ($uri == '')
        {
            $output .= "<div style='color:#000;font-weight:normal;padding:4px 0 4px 0'> profiler_no_uri </div>";
        }
        else
        {
            $output .= "<div style='color:#000;font-weight:normal;padding:4px 0 4px 0'><b>URL : </b>".$uri."</div>";
        }

        $output .= "</fieldset>";

        return $output;
    }

    // --------------------------------------------------------------------

    /**
     * Show the controller and function that were called
     *
     * @access  private
     * @return  string
     */
    function _compile_controller_info()
    {
        $output  = "\n\n";
        $output .= '<fieldset style="border:1px solid #995300;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
        $output .= "\n";
        $output .= '<legend style="color:#995300;">&nbsp;&nbsp; profiler_controller_info &nbsp;&nbsp;</legend>';
        $output .= "\n";

        $output .= "<div style='color:#995300;font-weight:normal;padding:4px 0 4px 0'><b>Controller / Action : </b>".$this->_currentRequestInfo['requestController']." / ".$this->_currentRequestInfo['requestAction']."</div>";


        $output .= "</fieldset>";

        return $output;
    }
    // --------------------------------------------------------------------

    /**
     * Compile memory usage
     *
     * Display total used memory
     *
     * @access  public
     * @return  string
     */
    function _compile_memory_usage()
    {
        $output  = "\n\n";
        $output .= '<fieldset style="border:1px solid #5a0099;padding:6px 10px 10px 10px;margin:20px 0 20px 0;background-color:#eee">';
        $output .= "\n";
        $output .= '<legend style="color:#5a0099;">&nbsp;&nbsp; profiler_memory_usage &nbsp;&nbsp;</legend>';
        $output .= "\n";

        if (function_exists('memory_get_usage') && ($usage = memory_get_usage()) != '')
        {
            $output .= "<div style='color:#5a0099;font-weight:normal;padding:4px 0 4px 0'><b>Mémoire : </b>".number_format($usage).' bytes</div>';
        }
        else
        {
            $output .= "<div style='color:#5a0099;font-weight:normal;padding:4px 0 4px 0'>Erreur : profiler_no_memory_usage</div>";
        }

        $output .= "</fieldset>";

        return $output;
    }

    // --------------------------------------------------------------------

    /**
     * Run the Profiler
     *
     * @access  private
     * @return  string
     */
    function run()
    {
        $output = "<div id='codeigniter_profiler' style='clear:both;background-color:#fff;padding:10px;'>";

        $output .= $this->_compile_uri_string();
        $output .= $this->_compile_controller_info();
        $output .= $this->_compile_memory_usage();
        $output .= $this->_compile_benchmarks();
        $output .= $this->_compile_get();
        $output .= $this->_compile_post();
        //$output .= $this->_compile_queries();

        $output .= '</div>';

        return $output;
    }

}