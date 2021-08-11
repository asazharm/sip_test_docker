@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">

                <div class="card-body justify-content-center">
                    <file-upload-component></file-upload-component>

                    <files-show-component></files-show-component>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
