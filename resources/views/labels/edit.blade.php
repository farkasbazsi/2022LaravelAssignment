@extends('layouts.app')
@section('title', 'Edit label')

@section('content')
<div class="container">
    <h1>Edit label</h1>
    <div class="mb-4">
        {{-- TODO: Link --}}
        <a href="{{ route('items.index') }}"><i class="fas fa-long-arrow-alt-left"></i> Back to the homepage</a>
    </div>

    {{-- TODO: Session flashes --}}
    @if (Session::has('label_updated'))
        <div class="alert alert-success" role="alert">
            Label ({{ Session::get('label_updated') }}) successfully updated!
        </div>
    @endif


    {{-- TODO: action, method --}}
    <form method="POST" action="{{ route('labels.update', $label) }}">
        @method('PUT')
        @csrf

        <div class="form-group row mb-3">
            <label for="name" class="col-sm-2 col-form-label">Name*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('name') is-invalid
                    @enderror" id="name" name="name" value="{{ old('name', $label->name) }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="display" class="col-sm-2 col-form-label py-0">Display*</label>
            <div class="col-sm-10">
                <div class="form-check">
                    <select name="display" id="display" class="@error('color') is-invalid @enderror">

                        <option value="-1" {{ old('display') === -1 ? "selected" : "" }}><i>-</i></option>

                        <option value="1" {{
                            old('display') === null && $label->display ==1 ? "Selected" :
                            (old('display')==1 ? "selected" : "")}}>Igen</option>

                        <option value="0" {{
                            old('display') === null && $label->display == 0 ? "Selected" :
                            (old('display') !== null && old('display')==0 ? "selected" : "")}}>Nem</option>

                    </select>
                    @error('display')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <label class="form-check-label" for="displayed">
                        <span class="badge bg-info text-white me-1">Mások számára látható lesz a létrehozott label</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label for="color" class="col-sm-2 col-form-label">Color (hex)*</label>
            <div class="col-sm-10">
                <input type="text" class="form-control @error('color') is-invalid
                    @enderror" id="color" name="color"
                    placeholder="#RRGGBB" maxlength="7" value="{{ old('color',$label->color) }}">
                @error('color')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Store</button>
        </div>

    </form>
</div>
@endsection
