<?php
namespace Packatron\AdsMadeSimple;

use Javanile\Granular\Autoload;

class App extends Autoload
{
    /**
     *
     */
    public function run()
    {
        // autoload bindable classes
        $this->autoload(__NAMESPACE__, __DIR__);

        // bind init method as action init
        $this->bind('action:init:1', 'init');
    }

    /**
     *
     */
    public function init()
    {
        load_plugin_textdomain('ads-made-simple', false, 'ads-made-simple/languages');
    }
}
