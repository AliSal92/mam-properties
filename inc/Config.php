<?php


namespace MAM\Plugin;

// Singleton class
class Config
{

    private $config = [];
    private static $instance;

    /**
     * Construct base configs
     */
    private final function __construct(){
        $this->init();
    }

    private function init(){
        $config = [
            /**
             * The plugin path (eg: use for require templates).
             */
            'plugin_path' => plugin_dir_path( __DIR__ ),
            /**
             * The plugin url (eg: use for enqueue css/js files).
             */
            'plugin_url' => plugin_dir_url(__DIR__),
            /**
             * The name (eg: use for adding links to the plugin action links).
             */
            'plugin_basename' => plugin_basename(plugin_dir_path( __DIR__ ) .'/mam-properties.php'),
            /**
             * Google Maps API Key
             */
            'google_api_key' => ''
        ];
        $this->setConfig($config);
    }

    /**
     * get Instance of the class
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param array $config
     */
    private function setConfig(array $config): void
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}