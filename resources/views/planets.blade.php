@extends('main')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('main')
    <div class="container-sm p-0">
        <header class="d-flex">
            <div class="left">
                <span class="nickname">Totalexx</span>
                <span class="lvl">Lvl: 3</span>
                <div class="progress">
                    <div class="progress-bar lvl-bar" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="right">
                <a href="/logout"></a>
            </div>
        </header>
        <section class="d-flex flex-column planets">
            <a class="planet-1" href="/progress">
                <span class="planet" id="planet1"></span>
                <span class="stars">
					<span class="star getted"></span>
					<span class="star"></span>
					<span class="star"></span>
				</span>
            </a>
            <a class="planet-2">
                <span class="planet" id="planet2"></span>
                <span class="stars">
					<span class="star "></span>
					<span class="star"></span>
					<span class="star"></span>
				</span>
            </a>
            <a class="planet-3">
                <span class="planet" id="planet3"></span>
                <span class="stars">
					<span class="star "></span>
					<span class="star"></span>
					<span class="star"></span>
				</span>
            </a>
            <a class="planet-4">
                <span class="planet" id="planet4" ></span>
            </a>
        </section>
    </div>
    <script src="{{asset('js/anime.min.js')}}"></script>
    <script>
        anime({
            targets: '#planet1',
            translateY: [3, -3],
            loop: true,
            direction: 'alternate',
            easing: 'easeInOutQuad',
        });

        if (sessionStorage.getItem('new') == undefined) {
            sessionStorage.setItem('lvl', '0');
            sessionStorage.setItem('progress', '0');
            sessionStorage.setItem('progressLast', '0');
        }

    </script>
@endsection
