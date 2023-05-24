<?php

use App\Models\Config;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;


function getCmsConfigFile($label)
{
    return getDataFromLabelWithCacheForFile($label);
}

function getCmsConfigText($label)
{
    return getDataFromLabelWithCacheForText($label);
}

function getFavIconFromConfig()
{
    $config = Config::whereLabel('favicon')->whereType('file')->first();
    return isset($config) && !empty($config->value) ? $config->url : asset('images/logo.png');
}

function getShortIconFromConfig()
{
    return getDataFromLabelWithCacheForFile('short logo', 'cmsShortLogo', 'logo');
}


function getDataFromLabelWithCacheForFile($label)
{
    if (Cache::store('file')->has($label)) {
        return Cache::store('file')->get($label);
    }
    $config = Config::whereLabel($label)->first();

    if ($config && !empty($config->value)) {
        Cache::store('file')->put($label, $config->url, now()->addDay());
        return $config->url;
    }
    return asset('images/logo.png');

}

function getDataFromLabelWithCacheForText($label)
{
    if (Cache::store('file')->has($label)) {
        return Cache::store('file')->get($label);
    }
    $config = Config::whereLabel($label)->first();

    if ($config && !empty($config->value)) {
        Cache::store('file')->put($label, $config->value, now()->addDay());
        return $config->value;
    }
    return '';
}


function breadcrumbForForm($title, $url, $mainTitle, $mainUrl)
{
    return array_merge(breadcrumbForIndex($mainTitle, $mainUrl), [
        [
            'title' => $title,
            'active' => true,
        ],
    ]);

}

function breadcrumbForIndex($title, $url)
{
    return [
        [
            'title' => 'Home',
            'link' => route('home'),
        ],
        [
            'title' => $title,
            'link' => $url,
            'active' => false,
        ],
    ];
}

function fromCamelCase($input)
{
    $pattern = '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!';
    preg_match_all($pattern, $input, $matches);
    $ret = $matches[0];
    foreach ($ret as &$match) {
        $match = $match == strtoupper($match) ?
            strtolower($match) :
            lcfirst($match);
    }
    return implode(' ', $ret);
}

function isAndroidApiKey()
{
    return checkApiKeyType('android');
}

function isIosApiKey()
{
    return checkApiKeyType('ios');
}

function checkApiKeyType($type)
{
    $key = request()->header('platform');
    return $key == $type;
}
