# Blade

这是从 Laravel 中抽取的模板引擎，跟常见的做法不同，这是一个独立的模块，不再依赖于 Laravel 的容器或其他任何组件。

### 安装

使用 Composer 时，只需要执行以下命令即可：

``` sh
composer require Itxiao6/view
```

如果你没有使用 Composer，可以将 `src` 目录复制到你的项目中，然后 `require` 所有的文件即可。

### 使用

```php
<?php
$path = ['/view_path'];         // 视图文件目录，这是数组，可以有多个目录
$cachePath = '/cache_path';     // 编译文件缓存目录

$compiler = new \Itxiao6\View\Compilers\BladeCompiler($cachePath);

// 如过有需要，你可以添加自定义关键字
$compiler->directive('datetime', function($timestamp) {
    return preg_replace('/(\(\d+\))/', '<?php echo date("Y-m-d H:i:s", $1); ?>', $timestamp);
});

$engine = new \Itxiao6\View\Engines\CompilerEngine($compiler);
$finder = new \Itxiao6\View\FileViewFinder($path);

// 如果需要添加自定义的文件扩展，使用以下方法
$finder->addExtension('tpl');

// 实例化 Factory
$factory = new \Itxiao6\View\Factory($engine, $finder);

// 渲染视图并输出
echo $factory->make('hello', ['a' => 1, 'b' => 2])->render();
```

几乎所有 Blade 的特性都被保留了，但是一些专属于 Laravel 的特征被移除了：

- `@inject` `@can` `@cannot` `@lang` 关键字被移除了
- 不支持事件和中间件

文档: [http://laravel.com/docs/5.1/blade](http://laravel.com/docs/5.1/blade)

感谢 Laravel 和它的创作者们，Laravel 是个伟大的项目。
