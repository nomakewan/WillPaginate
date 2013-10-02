<?php
namespace WillPaginate;

abstract class WillPaginate
{
    static private $localeLoaded = false;
    
    static private $config;
    
    static public function initialize()
    {
        self::$config = new Config();
        \Rails\ActionView\ViewHelpers::addHelper('WillPaginate\Helper');
    }
    
    static public function config()
    {
        return self::$config;
    }
    
    static public function getLocale($key)
    {
        if (!self::$localeLoaded) {
            self::loadLocales();
            self::$localeLoaded = true;
        }
        return \Rails::services()->get('i18n')->t('will_paginate.' . $key);
    }
    
    static private function loadLocales()
    {
        $i18n   = \Rails::services()->get('i18n');
        $locale = $i18n->locale();
        if ($locale == 'es') {
            $file   = __DIR__ . '/locales/' . $locale . '.yml';
        } else {
            $file   = __DIR__ . '/locales/en.yml';
        }
        $i18n->loadLocale($file);
    }
}
