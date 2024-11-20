<?php

namespace exploitfate\yii\newrelic\handlers;

use exploitfate\yii\newrelic\Agent;
use exploitfate\yii\newrelic\Newrelic;
use yii\base\Component;

abstract class Handler extends Component
{
    /**
     * @var Newrelic
     */
    public $newrelic;

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\base\Application $app the application currently running
     */
    abstract public function bootstrap($app);

    /**
     * @return Agent
     */
    protected function getAgent()
    {
        return $this->newrelic->agent;
    }
}
