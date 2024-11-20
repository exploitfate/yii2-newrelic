<?php

/**
 * Class Agent
 * @package exploitfate\yii\newrelic
 */

namespace exploitfate\yii\newrelic;

/**
 * NewRelic Agent API Methods
 *
 * @method  boolean setAppname(string $name, string $license = 'newrelic.license', boolean $xmit = false)
 * @method  void    noticeError(string|null $message, Exception|string $exception)
 * @method  void    nameTransaction(string $name)
 * @method  void    endOfTransaction()
 * @method  void    endTransaction(boolean $ignore = false)
 * @method  void    startTransaction(string $appname, string $license = 'newrelic.license')
 * @method  void    ignoreTransaction()
 * @method  void    ignoreApdex()
 * @method  void    backgroundJob(boolean $flag = true)
 * @method  void    captureParams(string $enable = 'on')
 * @method  void    customMetric(string $metric, float $value)
 * @method  void    addCustomParameter(string $parameter, string $value)
 * @method  void    addCustomTracer(string $callable)
 * @method  string  getBrowserTimingHeader(boolean $flag = true)
 * @method  string  getBrowserTimingFooter(boolean $flag = true)
 * @method  void    disableAutorum()
 * @method  void    setUserAttributes(string $user, string $account, string $product)
 */
class Agent
{

    /**
     * @param array $config Configuration data
     */
    public function __construct(array $config = array())
    {
        if (static::isLoaded() && !empty($config['name'])) {
            $this->setAppname($config['name']);
        }
    }

    /**
     * Magic method to wrap NewRelic Agent API function
     *
     * @param string $method Name of the command to call
     * @param array $arguments Arguments to pass to the command
     * @return mixed|false
     */
    public function __call($method, $arguments)
    {
        if (static::isLoaded() && function_exists($method = $this->formatMethod($method))) {
            return call_user_func_array($method, $arguments);
        }

        return false;
    }

    /**
     * Magic method to wrap NewRelic Agent API static function
     *
     * @param string $method Name of the command to call
     * @param array $arguments Arguments to pass to the command
     * @return mixed|false
     */
    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array(array(static::getInstance(), $method), $arguments);
    }

    /**
     * Convert command name from cameCase to snake_case
     *
     * @param string $name Name of the command
     * @return string       API function name
     */
    protected function formatMethod($name)
    {
        return 'newrelic_' . strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name));
    }

    /**
     * @return Agent
     */
    public static function getInstance()
    {
        static $instance = null;

        if ($instance === null) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * Check if the newrelic extension is loaded. Return cached result after first check
     *
     * @staticvar boolean $loaded
     * @return    boolean
     */
    public static function isLoaded()
    {
        static $loaded = null;

        if ($loaded === null) {
            $loaded = extension_loaded('newrelic');
        }

        return $loaded;
    }

}
