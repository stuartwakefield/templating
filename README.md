# Templating

PHP 5.3 +

A super lightweight templating system that makes PHP templating awesome.

## Basic usage

templates/greeting.phtml:

	<p>Hey there, <?= $this->name ?>!</p>
	
index.php:
	
	require_once 'vendor/autoload.php';
	use Templating\Template;
	
	$template = new Template('templates/greeting.phtml');
	$result = $template->fill(array(
		'name' => 'Bob'
	));
	echo $result; // <p>Hey there, Bob!</p>

## Presenters

lib/Presenter.php:

	class Presenter {
	
		private $name;
	
		function __construct($name) {
			$this->name = $name;
		}
		
		function greet() {
			return 'Hello, ' . $name . '! You are logged in.';
		}
		
	}

templates/account.phtml:

	<p><?= $this->greet() ?></p>

index.php:
	
	require_once 'vendor/autoload.php';
	use Templating\Template;
	
	$template = new Template('templates/account.phtml');
	$presenter = new Presenter('Khan');
	$result = $template->fill($presenter);
	echo $result; // <p>Hello, Khan! You are logged in.</p>