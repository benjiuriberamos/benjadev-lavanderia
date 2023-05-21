<?php

namespace App\Admin\Extensions;

use Encore\CKEditor\CKEditor;
use Encore\Admin\Form\Field\Textarea;

class SimpleEditor extends Textarea
{
    protected $view = 'admin.simple-editor';

    protected static $js = [
        'vendor/laravel-admin-ext/ckeditor/ckeditor.js',
        'vendor/laravel-admin-ext/ckeditor/myconfig.js'
    ];

    public function render()
    {

        $config = (array) CKEditor::config('config');

        $config = json_encode(array_merge($config, $this->options));
        // dd($newid);

        $this->script = <<<EOT
buildCKEditor();
EOT;
        return parent::render();
    }

    public function simple(): self
    {
        $this->setElementClass('ckeditor-simple');
        return $this;
    }

    public function full()
    {
        $this->setElementClass('ckeditor-full');
        return $this;
    }

    
}
