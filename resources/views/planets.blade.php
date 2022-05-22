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
            <a class="planet-1">
                <span class="planet" id="planet1"></span>
                <span class="stars">
					<span class="star getted"></span>
					<span class="star getted"></span>
					<span class="star"></span>
				</span>
            </a>
            <a class="planet-2"  href="/progress">
                <span class="planet" id="planet2"></span>
                <span class="stars">
					<span class="star " id="star1"></span>
					<span class="star" id="star2"></span>
					<span class="star" id="star3"></span>
				</span>
            </a>
            <a class="planet-3">
                <span class="planet lock" id="planet3"></span>
                <span class="stars">
					<span class="star" ></span>
					<span class="star" ></span>
					<span class="star" ></span>
				</span>
                <span id="planet3-wait" class="invisible">23:59:59</span>
            </a>
            <a class="planet-4">
                <span class="planet lock" id="planet4"></span>
            </a>
        </section>
    </div>
    <script src="{{asset('js/anime.min.js')}}"></script>
    <script>
        anime({
            targets: '#planet2',
            translateY: [3, -3],
            loop: true,
            direction: 'alternate',
            easing: 'easeInOutQuad',
        });

        if (sessionStorage.getItem('new') == undefined) {
            sessionStorage.setItem('lvl', '0');
            sessionStorage.setItem('progress', '0');
            sessionStorage.setItem('progressLast', '0');
            sessionStorage.setItem('new', 'false');
        }

        if (sessionStorage.getItem('done') == 'true') {
            document.getElementById('planet3').className = 'planet';
            document.getElementById('planet3-wait').className = '';
        }

        setInterval(updateTime, 1000);

        let second = 59;
        let minute = 59;
        let hour = 23;
        function updateTime() {
            second--;
            if (second < 1) {
                minute--;
                second = 59;
            }
            secondView = second > 10? second : '0'+second;
            document.getElementById('planet3-wait').textContent= hour+":"+minute+":"+secondView;
        }
        updateStars();

        function updateStars() {
            let lvl = parseInt(sessionStorage.getItem('progress'));
            if (lvl >= 25) {
                document.getElementById('star1').classList.add('getted');
                if (lvl >= 65) {
                    document.getElementById('star2').classList.add('getted');
                    if (lvl >= 90) {
                        document.getElementById('star3').classList.add('getted');
                    }
                }
            }
        }
    </script>
@endsection
