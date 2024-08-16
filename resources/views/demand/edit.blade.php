@extends('layouts.base', ['title' => 'Modifier une demande'])
@section('content')
    <div class="container">
        <div class="text-center mt-4">
            <div class="mx-auto shadow">
                <h3>Modification de la demande #{{ $apiAccessDemand->id }}</h3>
                <p class="text-danger">
                    Modifier les information de la demande puis valider.
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
                    <form method="POST" action="{{ route('api-access-demands.update', $apiAccessDemand) }}" class="form-card">
                        @csrf
                        @method('PUT')
                        <fieldset>
                            <legend class="text-center">Informations du demandeur</legend>
                            <div class="row justify-content-between text-left">
                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'last_name',
                                    'required_label' => '*',
                                    'label' => 'Nom',
                                    'placeholder' => 'Ex : AMA',
                                    'value' => $apiAccessDemand->last_name,
                                ])

                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'first_name',
                                    'required_label' => '*',
                                    'label' => 'Prénom',
                                    'placeholder' => 'Ex : Kwatcha',
                                    'value' => $apiAccessDemand->first_name,
                                ])
                                @include('shared.input', [
                                    'type' => 'email',
                                    'class' => 'col-md-6',
                                    'name' => 'email',
                                    'required_label' => '*',
                                    'label' => 'Email',
                                    'placeholder' => 'Ex : exemple@exemple.com',
                                    'value' => $apiAccessDemand->email,
                                ])

                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'city',
                                    'required_label' => '*',
                                    'label' => 'Ville',
                                    'placeholder' => 'Ex : Lomé',
                                    'value' => $apiAccessDemand->city,
                                ])

                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'address',
                                    'required_label' => '*',
                                    'label' => 'Adresse',
                                    'placeholder' => 'Ex : Agoe-Demakpoe',
                                    'value' => $apiAccessDemand->address,
                                ])

                                @include('shared.input', [
                                    'class' => 'col-md-6',
                                    'name' => 'company',
                                    'required_label' => '*',
                                    'label' => 'Entreprise',
                                    'placeholder' => 'Ex : HiTech',
                                    'value' => $apiAccessDemand->company,
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
                            @include('shared.btn-save', [
                                'btnText' => 'Modifier',
                                'faIconClass' => 'fa fa-edit',
                                'class' => 'btn btn-secondary',
                            ])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#email').attr('readonly', true);
        });
    </script>
@endsection
