@extends('layouts.app')
@section('title', 'Larahub | Edit Komentar')
@section('content')
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="card-deck row m-0 justify-content-center shadow">
            <div class="card-body">
                <h3>Edit Komentar.</h3>

                {{-- form --}}
                <form method="POST" action="/questionComment/{{$questionComment->id}}">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="content">Isi Komentar</label>
                        <textarea type="text" class="form-control  @error('content') is-invalid @enderror " id="content"
                            name="content">{{$questionComment->content}}</textarea>
                        @error('content')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Komentar!</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
