<?php

namespace Itxiao6\View;

use Exception;

class Filesystem
{
    /**
     * 模板文件池
     * @var array
     */
    protected static $fileList = [];
    /**
     * Determine if a file exists.
     *
     * @param  string  $path
     * @return bool
     */
    public function exists($path)
    {
        return file_exists($path);
    }

    /**
     * Get the contents of a file.
     *
     * @param  string  $path
     * @return string
     *
     * @throws Exception
     */
    public function get($path)
    {
        if ($this->isFile($path)) {
            /**
             * 判断模板文件是否已经加载过了
             */
            if(!isset(self::$fileList[$path])){
                self::$fileList[$path] = file_get_contents($path);
            }
            /**
             * 返回文件内容
             */
            return self::$fileList[$path];
        }
        throw new Exception("文件 {$path} 不存在");
    }

    /**
     * Write the contents of a file.
     *
     * @param  string  $path
     * @param  string  $contents
     * @param  bool  $lock
     * @return int
     */
    public function put($path, $contents, $lock = false)
    {
        return file_put_contents($path, $contents, $lock ? LOCK_EX : 0);
    }

    /**
     * Get the file's last modification time.
     *
     * @param  string  $path
     * @return int
     */
    public function lastModified($path)
    {
        return filemtime($path);
    }

    /**
     * Determine if the given path is a file.
     *
     * @param  string  $file
     * @return bool
     */
    public function isFile($file)
    {
        return is_file($file);
    }
}
