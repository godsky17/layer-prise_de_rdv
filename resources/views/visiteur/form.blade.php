@extends('visiteur.base')
@section('title', 'Prendre rendez-vous')
@section('content')
 <!-- Navbar & Hero Start -->
 <div class="container-xxl position-relative p-0">

    <div class="container-xxl bg-primary page-header">
        <div class="container text-center">
            <h1 class="text-white animated zoomIn mb-3">Rendez-vous</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('index') }}">Accueil</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Free Quote</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Navbar & Hero End -->


<!-- Quote Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <div class="d-inline-block border rounded-pill text-primary px-4 mb-3">Free Quote</div>
            <h2 class="mb-5">Request A Free Quote</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                <form method="POST" action="{{route('saveRdv')}}">
                    @csrf
                    <div class="row g-3">
                       @include('shared.input', [
                        'label' => 'Votre nom',
                        'type' => 'text',
                        'name' => 'last_name',
                        'id' => 'last_name',
                        'for' => 'last_name',
                        'class' => 'col-md-6',
                        'placeholder' => 'Entrer votre nom',
                       ])

                        @include('shared.input', [
                            'label' => 'Votre prenom',
                            'type' => 'text',
                            'name' => 'first_name',
                            'id' => 'first_name',
                            'for' => 'first_name',
                            'class' => 'col-md-6',
                            'placeholder' => 'Entrer votre prenom',
                        ])

                        @include('shared.input', [
                            'label' => 'Votre email',
                            'type' => 'email',
                            'name' => 'email',
                            'id' => 'email',
                            'for' => 'email',
                            'class' => 'col-md-6',
                            'placeholder' => 'Entrer votre email',
                        ])

                        @include('shared.input', [
                            'label' => 'Votre numero de telephone',
                            'type' => 'text',
                            'name' => 'number',
                            'id' => 'number',
                            'for' => 'number',
                            'class' => 'col-md-6',
                            'placeholder' => 'Entrer votre numero de telephone',
                        ])

                        @include('shared.input', [
                            'label' => 'Jour',
                            'type' => 'date',
                            'name' => 'day',
                            'id' => 'day',
                            'for' => 'day',
                            'class' => 'col-md-6',
                        ])

                        @include('shared.input', [
                            'label' => 'Heur',
                            'type' => 'time',
                            'name' => 'hour',
                            'id' => 'hour',
                            'for' => 'hour',
                            'class' => 'col-md-6',
                        ])

                        @include('shared.select', [
                            'label' => 'Temps du rendez-vous',
                            'name' => 'duration',
                            'id' => 'duration',
                            'for' => 'duration',
                            'class' => 'col-md-12',
                            'items' => [
                                '1' => '1 heure',
                                '2' => '2 heures',
                                '3' => '3 heures',
                                '4' => '4 heures',
                                '5' => '5 heures',
                            ],
                        ])

                       
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Prendre rendez-vous</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Quote End -->
<!--Hero End -->
@endsection