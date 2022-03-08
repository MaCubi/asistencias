@extends('partials.admin')


@section('content')
<div class="row d-flex flex-row">
    <div class="p-2">
        <h3 class="text-primary">Editar un Usuario</h3>
    </div>
    <div class="ml-auto p-2 d-flex align-items-center">
        <a href="{{ route('user.index') }}">
            <button class="btn btn-info btn-circle"><i class="fa fw fa-arrow-left"></i></button>
        </a>
    </div>
</div>
@include('partials.validation-error')
@include('partials.session-status')


<form action="{{  route("user.update", $user->id)  }}" method="post">
    @method('PUT')
    @include('user._form')
</form>
<br>

@endsection