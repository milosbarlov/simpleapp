<?php

class ElFinderWidget extends CWidget
{
    /**
     * jQuery selector for a container to place ElFinder in.
     *
     * @var string
     */
    public $selector = "#elfinder";
    
    public $imagePreview = "#imagePreview";
    
    public $modelAttributeId = "";

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
     * Used to store an asset URL of ElFinder's CSS directory.
     *
     * @var string
     */
    protected $_elFinderCssUrl = null;

    /**
     * Used to store an asset URL of ElFinder's scripts directory.
     *
     * @var string
     */
    protected $_elFinderJsUrl = null;

    /**
     * Used to store JSON object's string retrieved from {@link clientOptions}.
     *
     * @var string
     */
    protected $_jsonClientOptions = null;

    /**
     * Retrieves an asset URL of ElFinder's files directory.
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
     * Retrieves an asset URL of ElFinder's CSS directory.
     *
     * @return string
     */
    public function getElFinderCssUrl()
    {
        if ($this->_elFinderCssUrl === null)
            $this->_elFinderCssUrl = $this->elFinderAssetsUrl . "/css";

        return $this->_elFinderCssUrl;
    }

    /**
     * Retrieves an asset URL of ElFinder's scripts directory.
     *
     * @return string
     */
    public function getElFinderJsUrl()
    {
        if ($this->_elFinderJsUrl === null)
            $this->_elFinderJsUrl = $this->elFinderAssetsUrl . "/js";

        return $this->_elFinderJsUrl;
    }

    /**
     * Retrieves a string representation of JSON object with ElFinder's
     * client configuration options.
     *
     * @return string
     */
    public function getJsonClientOptions()
    {
        if ($this->_jsonClientOptions === null)
            $this->_jsonClientOptions = json_encode($this->clientOptions);
        return $this->_jsonClientOptions;
    }

    public function init()
    {
        
    }

    /**
     * Runs the widget rendering a template.
     */
    public function run()
    {
        //$this->render("elfinder");
        Yii::app()->clientScript->registerCoreScript("jquery");
        Yii::app()->clientScript->registerCoreScript("jquery.ui");
        Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl()
                . "/jui/css/base/jquery-ui.css");
        Yii::app()->clientScript->registerCssFile($this->elFinderCssUrl . "/elfinder.min.css");
        Yii::app()->clientScript->registerScriptFile($this->elFinderJsUrl . "/elfinder.min.js");
        Yii::app()->clientScript->registerCssFile($this->elFinderCssUrl . "/theme.css");

        // If client's language is set then also registering language script
        if (isset($this->clientOptions['lang']) && $this->clientOptions['lang']) {
            Yii::app()->clientScript->registerScriptFile($this->elFinderJsUrl . "/i18n/elfinder." . $this->clientOptions['lang'] . ".js");
        }
        
        echo    "
        <script>
            $(document).ready(function() {
                $('".$this->selector."').click(function() {
				var fm = $('<div/>').dialogelfinder({
					url : '".$this->connectorRoute."',
					lang : '" . (isset($this->clientOptions['lang']) && !empty($this->clientOptions['lang']) ? $this->clientOptions['lang'] : 'en') . "',
					width : 840,
					destroyOnClose : true,
					getFileCallback : function(files, fm) {
                                                $('#".$this->modelAttributeId."').val(files);
                                                $('".$this->imagePreview."').html($('<img>', {src:files}));
						console.log(files);
					},
					commandsOptions : {
						getfile : {
							oncomplete : 'close'
						}
					}
				}).dialogelfinder('instance');
			});
            });
         </script>";
    }
}
