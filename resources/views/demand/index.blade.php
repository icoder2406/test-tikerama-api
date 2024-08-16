@extends('layouts.base', ['title' => 'Liste des demandes'])

@section('content')
    <div class="container p-2">
        <div class="mx-auto">
            <h3>@yield('title')</h3>

            @if (session()->has('success'))
                <div class="alert alert-success">
                    <p>{{ session()->get('success') }}</p>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    <p>{{ session()->get('error') }}
                    </p>
                </div>
            @endif
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex gap-2 justify-content-between">
                    <h4 class="card-title">Liste des demandes</h4>
                    <div>
                        <a class="btn btn-secondary text-bold" href="{{ route('api-access-demands.create') }}">Faire
                            une
                            demande</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table align-items-center table-flush table-striped table-hover">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Ville</th>
                            <th>Adresse</th>
                            <th>Entreprise</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($apiAccessDemands as $apiAccessDemand)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $apiAccessDemand->last_name }}</td>
                                <td>{{ $apiAccessDemand->first_name }}</td>
                                <td>{{ $apiAccessDemand->email }}</td>
                                <td>{{ $apiAccessDemand->city }}</td>
                                <td>{{ $apiAccessDemand->address }}</td>
                                <td>{{ $apiAccessDemand->company }}</td>
                                <td class="no-print">
                                    <form method="POST"
                                        action="{{ route('api-access-demands.destroy', $apiAccessDemand) }}"
                                        class="d-flex gap-2 align-items-center justify-content-end">
                                        @csrf
                                        @method('DELETE')
                                        <a class="btn btn-icon btn-secondary" title="Éditer"
                                            href="{{ route('api-access-demands.edit', $apiAccessDemand) }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button class="btn btn-icon btn-danger delete" title="Supprimer">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <p>Aucune demande n'est enregistrer</p>
                        @endforelse

                    </tbody>
                </table>
                {{ $apiAccessDemands->links() }}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.delete').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `Êtes-vous sûr ?`,
                    text: "Action irreversible. En supprimant cet enregistrement vous perdez d'importantes informations.",
                    icon: "error",
                    buttons: ['Annuler', 'Supprimer'],
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        swal("Suppression effectuée avec succès", {
                            icon: "success",
                            dangerMode: true,
                        });
                        setTimeout(() => {
                            form.submit();
                        }, 350);

                    }
                });
        });
    </script>
@endsection
