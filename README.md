# Blade

[【简体中文】](https://github.com/Itxiao6/blade/wiki)

This is a view templating engine which is extracted from Laravel. It's independent without relying on Laravel's Container or any others.


### Installation

With Composer, you just need to run

``` sh
composer require Itxiao6/blade
```

If you haven't use composer, you should add all the files in folder `src` to your project folder,
and then `require` them in your code.


### Usage

```php
<?php
$path = ['/view_path'];         // your view file path, it's an array
$cachePath = '/cache_path';     // compiled file path

$compiler = new \Itxiao6\Blade\Compilers\BladeCompiler($cachePath);

// you can add a custom directive if you want
$compiler->directive('datetime', function($timestamp) {
    return preg_replace('/(\(\d+\))/', '<?php echo date("Y-m-d H:i:s", $1); ?>', $timestamp);
});

$engine = new \Itxiao6\Blade\Engines\CompilerEngine($compiler);
$finder = new \Itxiao6\Blade\FileViewFinder($path);

// if your view file extension is not php or blade.php, use this to add it
$finder->addExtension('tpl');

// get an instance of factory
$factory = new \Itxiao6\Blade\Factory($engine, $finder);

// render the template file and echo it
echo $factory->make('hello', ['a' => 1, 'b' => 2])->render();
```

You can enjoy almost all the features of blade with this extension.
However, remember that some of exclusive features are removed.

You can't:

- use `@inject` `@can` `@cannot` `@lang` in a template file
- add any events or middleawares

Documentation: [http://laravel.com/docs/5.1/blade](http://laravel.com/docs/5.1/blade)

Thanks for Laravel and it authors. That is a great project.

