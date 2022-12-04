<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Notebook;
use App\View\Composers\Notebooks\NotebooksListComposer;

class NotebookController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view(NotebooksListComposer::VIEW);
    }

    public function show($id): \Illuminate\Contracts\View\View
    {
        return view('composers.notebooks.item', [
            "item" => Notebook::findOrFail($id)
        ]);
    }

    public function note($id): \Illuminate\Contracts\View\View
    {
        return view('composers.notebooks.note', [
            "item" => Note::findOrFail($id)
        ]);
    }
}
