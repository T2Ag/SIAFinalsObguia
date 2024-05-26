@extends('layout')

@section('content')
    <div class="image-container">
        <img src="https://marketplace.canva.com/EAE7rpHi2uc/1/0/1600w/canva-grey-simple-photo-quote-workout-gym-zoom-virtual-background-sgLnnLb1ecc.jpg" alt="Gym image">
    </div>

    <style>

        .image-container {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .image-container img {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }
    </style>
@endsection
