<?php

namespace Justlzz\Solutions\Php\Base\DealFunction;

/**
 * php处理文件/文件夹
 * Class DealFile
 * @package Solutions\Php\Base\CommonFunction
 */
class DealFile
{
    //递归遍历一个文件夹下所有文件和文件夹
    public function recursiveTraversal(String $dir) {
        $files = array();
        if ( $handle = opendir($dir) ){
            while ( ($file = readdir($handle)) !== false ) {//readdir需要循环才能得出所有目录
                if ( $file != ".." && $file != "." ) {
                    if ( is_dir($dir . "/" . $file) ) {
                        $files[$file] = $this->recursiveTraversal($dir . "/" . $file);
                    }else {
                        $files[] = $file;
                    }
                }
            }
            closedir($handle);
            return $files;
        }
    }
}

$deal = new DealFile();
var_dump($deal->recursiveTraversal('/html/www/Solutions'));
