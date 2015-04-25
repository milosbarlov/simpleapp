<?php

ini_set('max_file_uploads', 50);   // allow uploading up to 50 files at once
// needed for case insensitive search to work, due to broken UTF-8 support in PHP
ini_set('mbstring.internal_encoding', 'UTF-8');
ini_set('mbstring.func_overload', 2);

include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "elFinder2" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "elFinderConnector.class.php";
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "elFinder2" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "elFinder.class.php";
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "elFinder2" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "elFinderVolumeDriver.class.php";
include_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "elFinder2" . DIRECTORY_SEPARATOR . "php" . DIRECTORY_SEPARATOR . "elFinderVolumeLocalFileSystem.class.php";


class ElFinderConnectorAction extends CAction 
{
    
    public $roots;
    
    public $locale = 'en_US.UTF-8';
    
    public $debug = false;
    
    private $connectorOptions = array();

    /**
     * Retrieves connector's configuration from URL parameter and creates
     * an instance of ElFinder connector.
     */
    public function run() 
    {
        $this->connectorOptions['locale'] = $this->locale;
        $this->connectorOptions['debug'] = $this->debug;
        if (isset($this->roots) && !empty($this->roots))
        {
            $this->connectorOptions['roots'] = $this->roots;
        } else {
            $this->connectorOptions['roots'] = array(
                array(
                    'driver' => 'LocalFileSystem',
                    'path' => realpath(Yii::app()->basePath . "/../files/gallery/"),
                    'startPath' => '../files/gallery/',
                    'URL' => "http://localhost/yiiextesting/yiibooster/files/gallery",
                    // 'treeDeep'   => 3,
                    'alias'      => 'Gallery',
                    'mimeDetect' => 'internal',
                    'tmbPath' => '.tmb',
                    'utf8fix' => true,
                    'tmbCrop' => false,
                    'tmbBgColor' => 'transparent',
                    'accessControl' => 'access',
                    'acceptedName' => '/^[^\.].*$/',
                    // 'tmbSize' => 128,
                    'attributes' => array(
                        array(
                            'pattern' => '/\.tmb/',
                            'hidden' => true,
                        ),
                        array(
                            'pattern' => '/\.quarantine/',
                            'hidden' => true,
                        ),
                    ),
                // 'uploadDeny' => array('application', 'text/xml')
                ),
            );
        }
        /*
        // Retrieving connector's options from GET-request
        $connectorOptionsEncoded = Yii::app()->request->getParam(self::GET_PARAM_ELFINDER_CONNECTOR_OPTIONS);
        if ($connectorOptionsEncoded) {
            $connectorOptionsSerialized = base64_decode($connectorOptionsEncoded);
            $connectorOptionsUnserialized = unserialize($connectorOptionsSerialized);
            if (is_array($connectorOptionsUnserialized)) {
                $this->connectorOptions = array_merge($this->connectorOptions, $connectorOptionsUnserialized);
            }
        }
        */
        // Running ElFinder
        $connector = new elFinderConnector(new elFinder($this->connectorOptions));
        $connector->run();
    }

}