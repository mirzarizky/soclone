@extends('layouts.app')

@push('script-head')

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

@endpush

@section('title', 'Larahub | Edit Pertanyaan')
@section('content')
<div class="flex-center position-ref full-height">

    <div class="content">
        <div class="card-deck row m-0 justify-content-center shadow">
            <div class="card-body">
                <h3>Edit Pertanyaan.</h3>

                {{-- form --}}
                <form method="POST" action="/pertanyaan/{{$question->id}}">
                    @method('patch')
                    @csrf
                    <div class="form-group">
                        <label for="title">Judul Pertanyaan</label>
                        <input type="text" class=" @error('title') is-invalid @enderror form-control" id="title"
                            name="title" value="{{$question->title}}">
                        @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="content">Isi Pertanyaan</label>
                        {{-- <textarea type="text" class="form-control  @error('content') is-invalid @enderror " id="content"
                            name="content">{{$question->content}}</textarea> --}}
                        <textarea type="text" class="form-control my-editor  @error('content') is-invalid @enderror "
                            id="content" name="content" value="{{old('content')}}">{!! $question->content !!}</textarea>

                        @error('content')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Pertanyaan!</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    var editor_config = {
      path_absolute : "/",
      selector: "textarea.my-editor",
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
  
        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
        if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }
  
        tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
        });
      }
    };
  
    tinymce.init(editor_config);
  </script>

@endpush
