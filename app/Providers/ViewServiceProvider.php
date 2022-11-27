<?php

namespace App\Providers;

use App\View\Components\Navigation;
use App\View\Composers\AbstractComposer;
use App\View\Composers\Notebooks\NotebooksItemComposer;
use App\View\Composers\Notebooks\NotebooksNoteComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var AbstractComposer $composer */
        foreach (Navigation::COMPOSERS as $composer) {
            View::composer((new $composer)->getView(), $composer);
        }

        View::composer(NotebooksItemComposer::VIEW, NotebooksItemComposer::class);
        View::composer(NotebooksNoteComposer::VIEW, NotebooksNoteComposer::class);
    }
}
