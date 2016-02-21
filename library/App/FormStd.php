<?php
/**
 * Default parent form for all the forms in the application
 *
 * @category App
 * @package App_Form
 * @copyright RCWEB
 */

abstract class App_FormStd extends Zend_Form
{
    const MODE_CREATION = 0;
    const MODE_MODIFICATION = 1;

    const SAVE_MODE_SAVE_AND_STAY = "saveAndContinueEdit";
    const SAVE_MODE_SAVE_AND_BACK = "saveAndBack";
    const SAVE_MODE_SAVE_AND_CONTINUE = "saveAndContinue";

    protected     $_portailId = 1;
    protected     $_form_id = "";
    protected     $_form_name = "";
    protected     $_form_method = Zend_Form::METHOD_POST;
    protected     $_back = null;
    protected     $_from = "";
    protected     $_save_mode = self::SAVE_MODE_SAVE_AND_CONTINUE;
    public        $_mode = self::MODE_CREATION;
    public        $_objet = "";
    protected     $_duplique = false;
    protected     $_param = array();
    protected     $_storeParamsUrl = "";
    protected     $_confirmation = 1;

    /**
     * @var App_Controller
     */
    protected     $_controller = null;
    protected     $_auth = null;
    protected     $_view = null;
    protected     $_urlAction = null;
    public        $formAttribs = null;

    protected     $_tabHiddenFields = array();
    protected     $_tabHiddenFieldsName = array();
    protected     $_processDatasDone = false;

    public $elementDecorators = array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
            array('Label', array('tag' => 'td'),
                    array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
            )
    );

    public $buttonDecorators = array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
            array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
    );


    public function __construct($param, Zend_Controller_Action $controller, $options = null) {
        // Validator path
        if(array_key_exists("portailId", $param)) $this->_portailId =   $param['portailId'];
        if(array_key_exists("form_id", $param)) {$this->_form_id =   $param['form_id'];} else {$this->_form_id = get_class($this);}
        if(array_key_exists("form_name", $param)) {$this->_form_name =  $param['form_name'];} else {$this->_form_name = get_class($this);}
        if(array_key_exists("form_method", $param)) $this->_form_method =  $param['form_method'];
        if(array_key_exists("mode", $param)) $this->_mode = $param['mode'];
        if(array_key_exists("objet", $param)){$this->_objet = $param['objet'];}else{$this->_objet = new stdClass();}
        if(array_key_exists("back", $param)) $this->_back = $param['back'];
        if(array_key_exists("from", $param)) $this->_from = $param['from'];
        if(array_key_exists("save_mode", $param)) $this->_save_mode = $param['save_mode'];
        if(array_key_exists("duplique", $param)) $this->_duplique = $param['duplique'];
        if(array_key_exists("storeParamsUrl", $param)) $this->_storeParamsUrl = $param['storeParamsUrl'];
        if(array_key_exists("confirmation", $param)) $this->_confirmation = $param['confirmation'];
        $this->_param = $param;

        $this->_controller = $controller;
        $this->_auth = Zend_Auth::getInstance();
        $this->_view = $this->getView();

        if(array_key_exists("urlAction", $param)){
            $this->_urlAction = $param['urlAction'];
        }else{
            $this->_urlAction = $this->_view->url();
        }

        $this->setAction($this->_urlAction);
        $this->setMethod($this->_form_method);
        $this->setAttrib('name',$this->_form_name);
        $this->setAttrib('id',$this->_form_id);
        $this->setElementFilters(array('StringTrim','StripTags'));
        $this->setEnctype(Zend_Form::ENCTYPE_MULTIPART);

        // Set "back URL" if not defined
        if( $this->_back === NULL )
        {
            $request = Zend_Controller_Front::getInstance()->getRequest();
            if( $request->isPost() && $request->getParam('back') != NULL )
            {
                $this->_back = $request->getParam('back');
            }
        }

        parent::__construct($options); // Attention : ici déclenchement du init()

        $elementFrom = new Zend_Form_Element_Hidden('from');
        $elementFrom->setValue($this->_from);
        $this->addHiddenFields($elementFrom);

        $elementFromForm = new Zend_Form_Element_Hidden('fromForm');
        $elementFromForm->setValue($this->_form_id);
        $this->addHiddenFields($elementFromForm);

        $elementBack = new Zend_Form_Element_Hidden('back');
        $elementBack->setValue($this->_back);
        $this->addHiddenFields($elementBack);

        $elementSaveMode = new Zend_Form_Element_Hidden('save_mode');
        $elementSaveMode->setValue($this->_save_mode);
        $this->addHiddenFields($elementSaveMode);

        $elt = new Zend_Form_Element_Hidden('confirmation');
        $elt->setValue($this->_confirmation);
        $this->addHiddenFields($elt);


        if(!isset($param['noCsrf']) || !$param['noCsrf'] ){
            $token = new Zend_Form_Element_Hash('csrf_'.$this->_form_id);
            $token->setSalt(md5(uniqid(rand(), TRUE)));
            $token->setTimeout(3600);
            $token->addErrorMessage("Le formulaire a expiré, veuillez réessayer.");
            $token->removeDecorator('HtmlTag');
            $token->removeDecorator('Label');
            $this->addElement($token);
        }

    }

    public function init(){

    }

    /**
     * Convenience method to recognize translatable text with gettext
     *
     * @param string $text
     * @return void
     */
    public function t($text){
        return $text;
    }

    public function addHiddenFields($element){
        $this->addElement($element);
        $this->_tabHiddenFields[] = $element->getId();
        $this->_tabHiddenFieldsName[] = $element->getName();
    }

    public function getHiddenFieldsList(){
        return $this->_tabHiddenFields;
    }

    // TDTODO : $confirmation devrait être remplacé par (array)$option, et donc utiliser en $option['step']
    public function myStdTraitement($partialValidation = false,$confirmation=2){
        // On traite le formulaire
        if ($this->_controller->getRequest()->isPost()) {
            $formData = false;
            $formulaireIsValide = false;
            if($partialValidation){
                $formData = $this->getValidValues($_POST);
                $formulaireIsValide = $this->isValid($_POST);
            }else{
                if($this->isValid($_POST)){
                    $formulaireIsValide = true;
                    $formData = $this->getValues();
                }
            }
            // On traite les données du formulaires
            if($formData){
                $this->traitementFormData($formData,$confirmation);
            }

            if($formulaireIsValide){
                //$this->addMsgSuccess("La fiche a été enregistrée avec succès.",true);
                $this->traitementRedirect($formData,$confirmation);

            }else{
                $this->traitementMessageError();
            }

        }
        debug($this->getErrors());
        $this->_view->form = $this;
    }

    public function traitementFormData($formData,$confirmation){
        debug('Il manque la fonction traitementFormData($formData,$confirmation) dans le formulaire');
        debug($formData);
    }

    public function traitementRedirect($formData,$confirmation){
        switch($formData['save_mode']){
            case self::SAVE_MODE_SAVE_AND_STAY :
                //$this->_controller->getHelper("redirector")->gotoRoute();
                break;
            case self::SAVE_MODE_SAVE_AND_BACK :
                debug('Il manque la fonction "traitementRedirect($formData,$this->_controller)"');
                break;
            case self::SAVE_MODE_SAVE_AND_CONTINUE :
            default:
                debug('Il manque la fonction "traitementRedirect($formData,$this->_controller)"');
                break;
        }
    }

    public function traitementMessageError($hiddenOnly=true){
        $this->_controller->addMsgErrorMsg("Le formulaire n'est pas valide.");
        if($hiddenOnly){
            foreach($this->getMessages() as $field => $message){
                if($this->{$field} instanceof Zend_Form_Element_Hash){
                    $this->_controller->addMsgErrorMsg($this->{$field}->getMessages());
                }elseif($this->{$field} instanceof Zend_Form_Element_Hidden){
                    $this->_controller->addMsgErrorMsg($this->{$field}->getMessages());
                }
            }
        }else{
            $this->_controller->addMsgErrorMsg($this->getMessages());
        }
    }

    public function renderFormHtml($withBalise = false){
        $html = "";
        if($withBalise){
            $html = "<form ";
        }
        $html .= 'action="'.$this->getAction().'" method="'.$this->getMethod().'" id="'.$this->getId().'" name="'.$this->getName().'" enctype="'.$this->getEnctype().'"';

        $html .= " ".$this->formAttribs;
        if($withBalise){
            $html .= ">";
        }
        return $html;
    }

    public function renderCsrf(){
        $csrf = 'csrf_'.$this->getId();
        $html = "";
        if($this->getElement($csrf) ){
            $this->{$csrf}->render();
            $html = $this->{$csrf}->renderViewHelper();
        }
        return $html;
    }

    public function renderHiddenFields(){
        $html = "";
        foreach( $this->_tabHiddenFieldsName as $elem )
        {
            $html .= $this->$elem->renderViewHelper();
        }
        return $html;
    }

    public function renderSubmit(){
        $submit = 'submit_'.$this->getId();
        $html = "";
        if($this->getElement($submit) ){
            $html = $this->{$submit}->render();
        }
        return $html;
    }

    /**
     * Return back url
     */
    function getBackUrl()
    {
        return $this->_back;
    }

    /**
     * Return form id
     */
    function getId()
    {
        return $this->_form_id;
    }

    function renderFieldErrors($field,$class="error",$style=""){
        $html = "";
        if($this->{$field}->hasErrors()){
            foreach ($this->{$field}->getErrors() as $message){
                if($html == ""){
                    $html .= "<label for='".$field."' class='".$class."' style='".$style."'>".$message."</label>";
                }else{
                    $html .= "<label for='".$field."' class='".$class."' style='".$style."'>".$message."</label>";;
                }
            }
        }
        return $html;
    }
}
