<?php

namespace TagEditor;

use Encore\Admin\Admin;
use Encore\Admin\Form;
use Illuminate\Support\ServiceProvider;
use TagEditor\Form\Tag;

class TagEditorServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(TagEditor $extension)
    {
        if (! TagEditor::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-tag-editor');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/howth/laravel-admin-tag-editor')],
                'laravel-admin-tag-editor'
            );
        }

        Admin::booting(function () {
            Form::extend('tag', Tag::class);
        });
    }
}