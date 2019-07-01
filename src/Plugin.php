<?php
namespace WpQuality\AdsMadeSimple;

use Javanile\Granular\Bindable;

class Plugin extends Bindable
{
    /**
     * @var array
     */
    public static $bindings = [
        'action:init' => 'init',
    ];

    /**
     *
     */
    public function init()
    {
        load_plugin_textdomain('ads-made-simple', false, 'ads-made-simple/languages');
    }
}
