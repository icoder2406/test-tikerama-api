@extends('layouts.base', ['title' => 'Enregistrer une demande'])
@section('content')
    <div class="container">
        <div class="text-center mt-4">
            <div class="mx-auto shadow">
                <h3>Formulaire de demande d'accès à l'API</h3>
                <p class="text-danger">
                    Remplir le formulaire ci-dessous puis envoyer.
                </p>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <p>{{ sesion()->get('succes') }}</p>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        <p>{{ session()->get('error') }}
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex gap-2 justify-content-end">
                        <div class="float-right">
                            <a class="btn btn-success text-bold " href="{{ route('api-access-demands.index') }}">
                                Retour à la liste</a>
                        </div>
                    </div>
                </div>
                <marquee loop='100' behavior='alternate'>
                    <span class="text-danger">*</span> :
                    <span class="text-muted">
                        Indique les champs obligatoire
                    </span>
                </marquee>
                <div class="card-body">
                    <form method="POST" action="{{ route('api-access-demands.store') }}" class="form-card">
                        @csrf
                        <fieldset>
                            <legend class="text-center">Informations du demandeur</legend>
                            <div class="row justify-content-between text-left">
                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'last_name',
                                    'required_label' => '*',
                                    'label' => 'Nom',
                                    'placeholder' => 'Ex : AMA',
                                ])

                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'first_name',
                                    'required_label' => '*',
                                    'label' => 'Prénom',
                                    'placeholder' => 'Ex : Kwatcha',
                                ])
                                @include('shared.input', [
                                    'type' => 'email',
                                    'class' => 'col-md-6',
                                    'name' => 'email',
                                    'required_label' => '*',
                                    'label' => 'Email',
                                    'placeholder' => 'Ex : exemple@exemple.com',
                                ])

                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'city',
                                    'required_label' => '*',
                                    'label' => 'Ville',
                                    'placeholder' => 'Ex : Lomé',
                                ])

                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'address',
                                    'required_label' => '*',
                                    'label' => 'Adresse',
                                    'placeholder' => 'Ex : Agoe-Demakpoe',
                                ])

                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'company',
                                    'required_label' => '*',
                                    'label' => 'Entreprise',
                                    'placeholder' => 'Ex : HiTech',
                                ])
                            </div>
                        </fieldset>
                        <div class="d-flex align-items-center justify-content-around">
                            @include('shared.btn-save', [
                                'btnText' => 'Annuler',
                                'btnType' => 'reset',
                                'faIconClass' => 'fa fa-reset',
                                'class' => 'btn btn-danger',
                            ])
                            @include('shared.btn-save')
                        </div>

                        {{-- <div class="d-flex align-content-between justify-content-center">


                            </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
