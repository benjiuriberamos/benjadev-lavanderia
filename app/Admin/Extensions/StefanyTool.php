<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class StefanyTool extends Field
{
    protected $view = 'admin.stefany-tool';

    protected static $css = [
    ];

    protected static $js = [
        'https://cdn.jsdelivr.net/gh/ruano-a/symfonyCollectionJs@4.3.1/symfonyCollectionJs.min.js',
    ];

    public function render()
    {
        $this->script = <<<EOT
var prototype = `<div class="collection-elem">
<div>
    <button class="collection-elem-add">+</button>
    <button class="collection-elem-remove">-</button>
    <button class="collection-elem-up">up</button>
    <button class="collection-elem-down">down</button>
</div>
<h2>This is a collection element</h2>
<input type="text" id="form_collection_{$this->column}_myinput" name="form[collection][{$this->column}][myinput]">
<input type="text" id="form_collection_{$this->column}_myotherinput" name="form[collection][{$this->column}][myotherinput]">
</div>`;

$("#collection-root-{$this->column}").attr('data-prototype', prototype);
$(document).ready(function(){
    $('#collection-root-{$this->column}').formCollection({
      other_btn_add:      '#collection-add-btn',
      btn_add_selector:     '.collection-elem-add',
      btn_delete_selector:  '.collection-elem-remove',
      btn_up_selector:  '.collection-elem-up',
      btn_down_selector:  '.collection-elem-down',
      call_post_add_on_init:  true
    });
});


EOT;
        return parent::render();

    }
}