<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <!-- include summernote css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css"/>
</head>

<body>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


                <div class="card border-0 shadow rounded">
                    <div class="card-body">

                        <form action="{{ route('post.update', $post->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title', $post->title) }}" >

                                <!-- error message untuk title -->
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Publish Status</label>
                                <select name="status" class="form-control" >
                                    <option value="published" {{ $post->status == 'published' ? 'selected':'' }}>Publish</option>
                                    <option value="draft" {{ $post->status == 'draft' ? 'selected':'' }}>Draft</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea
                                    name="content" id="content"
                                    class="form-control @error('content') is-invalid @enderror"
                                    rows="5"
                                    >{{ old('content', $post->content) }}</textarea>

                                <!-- error message untuk content -->
                                @error('content')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Save</button>
                            <a href="{{ route('post.index') }}" class="btn btn-md btn-secondary">back</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- include summernote js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js" ></script>    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 250, //set editable area's height
            });
        })
    </script>
</body>

</html>
