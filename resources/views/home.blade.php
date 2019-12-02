@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenue sur notre site e-commerce {{ Auth::user()->name }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Vous êtes bien connecté avec l'adresse mail : {{ Auth::user()->email }}
                    <div></div>
 n
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

