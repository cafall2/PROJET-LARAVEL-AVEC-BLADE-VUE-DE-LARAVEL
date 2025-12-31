@extends('layouts.app')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex justify-content-center align-items-center">
        <h1>Page 1 -  Admin</h1>
    </section><!-- End Hero -->
    <div class="container" style="margin-top: 100px; margin-bottom: 20px">
        <div class="row justify-content-center">
            <div class="col-md-8">
    <form action="{{ route('reclamations.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="objet">Objet de la réclamation</label>
            <input type="text" name="objet" id="objet" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="message">Message de la réclamation</label>
            <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
            </div></div></div>
@endsection
