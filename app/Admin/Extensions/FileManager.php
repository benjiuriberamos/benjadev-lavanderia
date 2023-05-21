<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class FileManager extends Field
{
    protected $view = 'admin.file-manager';

    protected static $css = [
    ];

    protected static $js = [
        'vendor/laravel-filemanager/js/stand-alone-button.js',
    ];

    public function render()
    {
        $this->script = <<<EOT
        $('#{$this->id}').filemanager('file', {prefix: '/filemanager'});
        // $('#lfm').filemanager('file', {prefix: route_prefix});

EOT;
        return parent::render();
    }
}