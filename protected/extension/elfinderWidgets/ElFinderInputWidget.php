<?php

class ElFinderInputWidget extends CInputWidget
{
    public $buttonLabel = 'Browse file';
    
    public $buttonClass = 'btn';
    
    public $previewOptions = array ();
    
    /**
     * ElFinder client's configuration options as described here:
     * https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
     *
     * Please note that these options must be passed as an array and will be
     * converted to JSON object automatically.
     *
     * @var array
     */
    public $clientOptions = array();

    /**
     * A route to ElFinder connector's action.
     *
     * This action must be implemented as a reference to {@link ElFinderConnectorAction} class.
     *
     * @var string
     */
    public $connectorRoute = null;

    /**
     * Used to store an asset URL of ElFinder's scripts, images and CSS files.
     * These files are located in "assets" directory of the extension.
     *
     * @var string
     */
    protected $_elFinderAssetsUrl = null;

    /**
     * Retrieves URL of assets files directory.
     *
     * @return string
     */
    public function getElFinderAssetsUrl()
    {
        if ($this->_elFinderAssetsUrl === null)
        {
            $this->_elFinderAssetsUrl = Yii::app()->getAssetManager()->publish(
                dirname(__FILE__) . "/elFinder2/assets"
            );
        }

        return $this->_elFinderAssetsUrl;
    }
    
    /**
     * Runs the widget rendering a template.
     */
    public function run()
    {
        list($name, $id) = $this->resolveNameID();

        $this->registerClientScript();
        $this->resolvePreviewOptions();

        $this->render('elfinder_input', array(
            'id' => $id.  uniqid(),
            'name' => $name, 
            'value' => ($this->hasModel() ? $this->model->{$this->attribute} : $this->value),
            'buttonLabel' => $this->buttonLabel,
            'buttonClass' => $this->buttonClass,
            'clientOptions' => $this->clientOptions,
            'connectorRoute' => $this->connectorRoute,
            'imgOptions' => $this->previewOptions,
        ));
    }
    
    /**
    * Registers required javascript
    */
    public function registerClientScript()
    {
        Yii::app()->clientScript->registerCoreScript("jquery");
        Yii::app()->clientScript->registerCoreScript("jquery.ui");
        Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl()
                . "/jui/css/base/jquery-ui.css");
        Yii::app()->clientScript->registerCssFile($this->elFinderAssetsUrl . "/css/elfinder.min.css");
        Yii::app()->clientScript->registerScriptFile($this->elFinderAssetsUrl . "/js/elfinder.min.js");
        Yii::app()->clientScript->registerCssFile($this->elFinderAssetsUrl . "/css/theme.css");

        // If client's language is set then also registering language script
        if (isset($this->clientOptions['lang']) && $this->clientOptions['lang']) {
            Yii::app()->clientScript->registerScriptFile($this->elFinderAssetsUrl . "/js/i18n/elfinder." . $this->clientOptions['lang'] . ".js");
        }
    }
    
    public function resolvePreviewOptions()
    {
        $default = array(
                'width' => '75px',
                'height' => '75px',
                'class' => 'img-polaroid',
                'removeTitle' => 'Remove file',
            );
        if (isset($this->previewOptions) && is_array($this->previewOptions))
        {
            $this->previewOptions = CMap::mergeArray(
                $this->previewOptions,
                $default
            ); 
        }
        else
        {
            $this->previewOptions = $default;
        }
    }
}
