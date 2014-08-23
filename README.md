# Templating

PHP 5.3 +

A super lightweight templating system that makes PHP templating awesome.

## Basic usage

Starting with a really basic application which has the following layout:

	├── templates
	│   └── greeting.phtml
	├── composer.json
	└── index.php

The composer.json file has `stuartwakefield/templating` in the the require map:

```json
{
	"require": {
		"stuartwakefield/templating": "0.1.0a"
	}
}
```

The template file `templates/greeting.phtml` has the following content:

```php
<p>Hey there, <?= $this->name ?>!</p>
```

The `index.php` script:

```php
<?php
require_once 'vendor/autoload.php';
use Templating\Template;

$template = new Template('templates/greeting.phtml');
$result = $template->fill(array(
	'name' => 'Bob'
));
echo $result; // <p>Hey there, Bob!</p>
```

Simple as that!

## Presenters

The really cool thing with this templating library is that you can start to use presenter objects with your templates effortlessly.

Lets set up a basic presenter `src/Presenter.php` and lets assume you have set up composer to autoload the class:

```php
<?php
class Presenter {

	private $name;

	function __construct($name) {
		$this->name = $name;
	}
	
	function greet() {
		return 'Hello, ' . $name . '! You are logged in.';
	}
	
}
```

Then in a new template `templates/account.phtml`:

```php
<p><?= $this->greet() ?></p>
```

Our updated `index.php` looks like this:

```php
<?php
require_once 'vendor/autoload.php';
use Templating\Template;

$template = new Template('templates/account.phtml');
$presenter = new Presenter('Khan');
$result = $template->fill($presenter);
echo $result; // <p>Hello, Khan! You are logged in.</p>
```
