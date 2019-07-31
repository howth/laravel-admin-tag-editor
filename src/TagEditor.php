<?php

namespace TagEditor;

use Encore\Admin\Extension;

class TagEditor extends Extension
{
    public $name = 'laravel-admin-tag-editor';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Tageditor',
        'path'  => 'laravel-admin-tag-editor',
        'icon'  => 'fa-gears',
    ];
}