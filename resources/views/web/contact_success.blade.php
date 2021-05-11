@extends('web.layout.master')
@section('content')
    <div class="container text-center ">
        <h2 class="font-weight-bold text-front p-5">Email enviado com sucesso, em breve entraremos em contato</h2>
        <a href="{{ url()->previous() }}" class="btn btn-front  mb-5">Continuar navegando.</a>
    </div>
@endsection
