<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Label::class);

        $validated = $request->validate([
            'name' => 'required | string | unique:labels,name',
            'display' => 'boolean',
            'color' => 'required | string | min:7| max:7 | regex:/^#[A-Fa-f0-9]+$/', //regex for safe hex color
        ]);

        Label::factory()->create($validated);

        Session::flash('label_created', $validated['name']);

        return Redirect::route('labels.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        $this->authorize('view', $label);

        return view('labels.show', [
            'label' => $label,
            'labels' => Label::all(),
            'items' => $label->items()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function edit(Label $label)
    {
        $this->authorize('update', $label);

        return view('labels.edit', [
            'label' => $label,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Label $label)
    {
        $this->authorize('update', $label);

        $validated = $request->validate([
            'name' => 'required | string',
            'display' => 'boolean',
            'color' => 'required | string | min:7| max:7 | regex:/^#[A-Fa-f0-9]+$/', //6 safe hex digits
        ]);

        $label->name = $validated['name'];
        $label->display = $validated['display'];
        $label->color = $validated['color'];
        $label->save();

        Session::flash('label_updated', $validated['name']);

        return Redirect::route('labels.edit', $label);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Label  $label
     * @return \Illuminate\Http\Response
     */
    public function destroy(Label $label)
    {
        //
    }
}
