<?php
/**
 * CreatedBy: thangcest2@gmail.com
 * Date: 8/16/16
 * Time: 4:04 PM
 */

namespace console\controllers;


use common\Factory;
use yii\caching\FileCache;
use yii\console\Controller;
use yii\helpers\Console;

class BaseCacheController extends Controller
{
    public function actionFlushAll()
    {
        $cache = Factory::$app->cache;
        if ($cache instanceof FileCache) {
            $backendCachePath = APPROOT . '/backend/runtime/cache';
            if (is_dir($backendCachePath)) {
                $cache->cachePath = $backendCachePath;
                \Yii::$app->cache->flush();    
            }
            
            $frontendCachePath = APPROOT . '/frontend/runtime/cache'; 
            if (is_dir($frontendCachePath)) {
                $cache->cachePath = $frontendCachePath;
                \Yii::$app->cache->flush();    
            }
            echo $this->ansiFormat('Flush all caches done', Console::FG_YELLOW) . PHP_EOL;
            return 1;
        }
        
        echo $this->ansiFormat('FLush all caches failed', Console::FG_RED) . PHP_EOL;
        return 0;
    }

    public function actionFlushBackend()
    {
        $cache = Factory::$app->cache;
        if ($cache instanceof FileCache) {
            $cache->cachePath = APPROOT . '/backend/runtime/cache';
            \Yii::$app->cache->flush();
            echo $this->ansiFormat('Flush backend caches done', Console::FG_YELLOW) . PHP_EOL;
            return 1;
        }
        echo $this->ansiFormat('FLush backend caches failed', Console::FG_RED) . PHP_EOL;
        return 0;
        
    }

}