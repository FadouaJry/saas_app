@extends('layouts.app')
@section('title')
    Create a Qrcodes
@endsection
@section('content')
    <div class="row my-5">
        <h3>Create a qrcode</h3>
        <div class="col-md-12">
            <div class="mb-3">
                <form action="{{ route('qrcodes.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenu</label>
        <textarea name="content" class="form-control  @error('content') is-invalid @enderror" id="content" cols="30"
           placeholder="Entrer votre contenu"                 rows="3">
                        {{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                <strong>
                                   {{ $message}}
                                </strong>
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
            </div>
            </form>



        </div>
    </div>
@endsection
