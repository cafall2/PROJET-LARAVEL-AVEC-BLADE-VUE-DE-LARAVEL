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
                <a href="{{ route('page1') }}" class="btn-get-started">Faire une réclamation</a>
                <a href="{{ route('formulairesocial') }}" class="btn-get-started">Faire une demande de bourse</a>
            </div>
            @auth
                <a href="javascript:void(0)" onclick="document.getElementById('logoutForm').submit()" class="btn-get-started">Se
                    déconnecte</a>
                <form id="logoutForm" method="post" action="{{ route('logout') }}">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-get-started">Se connecter</a>
            @endauth
        </div>
    </section><!-- End Hero
@endsection
