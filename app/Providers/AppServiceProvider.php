<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Forms\Components\RichEditor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (session('darkMode')) {
            view()->share('darkMode', true);
        }

        RichEditor::configureUsing(function (RichEditor $editor) {
            $editor->toolbarButtons([
                'bold',
                'italic',
                'underline',
                'strike',
                'link',
                'orderedList',
                'unorderedList',
                'h2',
                'h3',
                'undo',
                'redo',
            ]);
        });
    }
}
