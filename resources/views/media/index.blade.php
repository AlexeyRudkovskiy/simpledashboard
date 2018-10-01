@extends('@admin::layout.dashboard')

@section('current-page') Media @endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ trans('@admin::dashboard.name') }}</a></li>
    <li class="breadcrumb-item active"><a href="javascript:">{{ trans('@admin::dashboard.title.media.index') }}</a></li>
@endsection

@section('content')

    <div class="media-container">
        <div class="media-container-header">
            <ul class="breadcrumb media-breadcrumb">
                @foreach($breadcrumbs as $breadcrumb)
                    <li class="breadcrumb-item"><a href="{{ route('admin.media.index', [ 'folder' => $breadcrumb['full'] ]) }}">{{ $breadcrumb['short'] }}</a></li>
                @endforeach
            </ul>
            <div class="media-upload-container">
                <form method="post" action="{{ route('admin.media.upload') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="file" name="file[]" />
                    <input type="hidden" name="redirect_back" value="1" />
                    <input type="submit" />
                </form>
            </div>
            {{--<ul class="media-basic-actions">--}}
                {{--<li><a href="javascript:">create folder</a></li>--}}
                {{--<li><a href="javascript:">upload file</a></li>--}}
            {{--</ul>--}}
        </div>

        <div class="media-grid">
            @spaceless
            @foreach($directories as $directory)
                <a href="{{ route('admin.media.index', ['folder' => $directory['full']]) }}" class="media-grid-item media-grid-item-folder">
                    <i class="fa fa-folder icon"></i>
                    <span class="folder-text">{{ $directory['short'] }}</span>
                </a>
            @endforeach
            @foreach($files as $file)
                <div class="media-grid-item media-grid-item-file"><img src="{{ $file['thumbnail'] }}" title="{{ $file['name'] }}" /></div>
            @endforeach
            @endspaceless
        </div>
    </div>

@endsection
