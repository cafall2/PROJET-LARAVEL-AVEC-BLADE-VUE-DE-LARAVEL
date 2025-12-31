@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
        <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
            <h1>Bienvenue,<br>sur votre Page de réclamations</h1>
            <h2>La satisfaction de l'etudiant,notre coeur de métier</h2>
            <div class="container">


                <div class="separator"></div>
                <h1><p>Faites votre choix:</p></h1>
                <a href="{{ route('formulaire') }}" class="btn-get-started">Faire une réclamation</a>
                <a href="{{ route('formulairesocial') }}" class="btn-get-started">Faire une demande de bourse</a>
            </div>
    </section><!-- End Hero -->
    <div class="container" style="margin-top: 100px; margin-bottom: 20px">

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Mes réclamations</div>
                        <div class="card-body">
                            @if ($reclamations->isEmpty())
                                <p>Aucune réclamation pour le moment.</p>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Objet</th>
                                            <th>Receptionnée</th>
                                            <th>Acceptée</th>
                                            <th>Refusée</th>
                                             <th>motif refus</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reclamations as $reclamation)
                                            <tr>
                                                <td>{{ $reclamation->objet }}</td>
                                                <td>{{ $reclamation->receptionnee ? 'Oui' : 'Non' }}</td>
                                                <td>{{ $reclamation->acceptee ? 'Oui' : 'Non' }}</td>
                                                <td>{{ $reclamation->refusee ? 'Oui' : 'Non' }}</td>
                                                <td>{{ $reclamation->motif_refus=='' ? $reclamation->motif_refus : 'Aucun' }}</td>
                                                <td>
                                                    <a href="{{ route('reclamations.show', $reclamation->id) }}" class="btn btn-primary">Voir</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Demande de Bourse') }}</div>

                    <div class="card-body">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Liste des demandes de Bourse') }}</div>

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
