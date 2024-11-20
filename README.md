Yii2 Newrelic Package
==================================

Requirements
------------

```shell

echo 'deb http://apt.newrelic.com/debian/ newrelic non-free' | sudo tee /etc/apt/sources.list.d/newrelic.list
wget -O- https://download.newrelic.com/548C16BF.gpg | sudo apt-key add - && sudo apt update
sudo apt -y install newrelic-php5

```

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

```
php composer.phar require --prefer-dist exploitfate/yii2-newrelic
```

Configuration
-------------

Add newrelic to bootstrap and set component config

```php
return [
    'bootstrap' => ['newrelic'],
        // ...
    'components' => [
        // ...
        'newrelic' => [
            'class' => 'exploitfate\yii\newrelic\Newrelic',
            'name' => 'website.com', // optional, uses Yii::$app->name by default
            //'enabled' => false // optional, default = true
            //'enableEndUser' => false // optional, default = false
        ],
        // ...
    ],
];
```
