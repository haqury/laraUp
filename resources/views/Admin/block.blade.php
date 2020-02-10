
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="main">
        <form-component :config='@json($configModel)' controller="ControllerBlock" :result='@json($result)'></form-component>
        </div>
    </div>
</div>
@endsection

