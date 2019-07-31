<?php
/**
 * Tag
 *
 * @create 2019/7/31 23:10
 * @author hao
 */

namespace TagEditor\Form;

use Encore\Admin\Form\Field;
use Encore\Admin\Form\Field\PlainInput;


class Tag extends Field
{
    use PlainInput;

    protected static $css = [
        '/vendor/howth/laravel-admin-tag-editor/jquery.tag-editor.css?v=1',
    ];

    protected static $js = [
        '/vendor/howth/laravel-admin-tag-editor/jquery.caret.min.js?v=1',
        '/vendor/howth/laravel-admin-tag-editor/jquery.tag-editor.min.js?v=1',
    ];

    public function render()
    {
        $this->initPlainInput();

        $this->prepend('<i class="fa fa-pencil fa-fw"></i>')
            ->defaultAttribute('type', 'text')
            ->defaultAttribute('data-role', 'tag-editor')
            ->defaultAttribute('id', $this->id)
            ->defaultAttribute('name', $this->elementName ?: $this->formatName($this->column))
            ->defaultAttribute('value', old($this->column, $this->value()))
            ->defaultAttribute('class', 'form-control '.$this->getElementClassString())
            ->defaultAttribute('placeholder', $this->getPlaceholder());

        $this->addVariables([
            'prepend' => $this->prepend,
            'append'  => $this->append,
        ]);

        $initialTags = json_encode(old($this->column, $this->value()));
        $this->script = <<<SCRIPT
$(function () {
    $("input[data-role='tag-editor']").tagEditor({ initialTags: $initialTags });
});
SCRIPT;


        return parent::render();
    }

    /**
     * 重写父类方法，为解决js中计算input size的问题
     *
     * @return string
     */
    public function getPlaceholder()
    {
        $placeholder = parent::getPlaceholder();
        $len = mb_strlen($placeholder);
        if ($len < 20) {
            $placeholder .= str_repeat(' ', 20 - $len);
        }

        return $placeholder;
    }
}