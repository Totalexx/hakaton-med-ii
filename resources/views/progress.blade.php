@extends('main')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/progress.css') }}">
@endsection

@section('main')
    <div class="container-sm p-0">
        <section class="game d-flex flex-column align-items-center text-center">
            <h2>Прогресс<br> уровня</h2>
            <div class="lvl-board"></div>
            <div id="player" style="top: -275px; left: -125px;"></div>
            <div class="star-progress">
                <div class="progress">
                    <div class="progress-bar lvl-bar" id="lvl-bar" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="stars d-flex justify-content-end">
                    <span class="star mx-5" id="star1"></span>
                    <span class="star mx-4" id="star2"></span>
                    <span class="star mx-3" id="star3"></span>
                </div>
            </div>
        </section>
    </div>
    <script src="{{asset('js/anime.min.js')}}"></script>
    <script>

        setInterval(updateStars, 500);

        function updateStars() {
            let lvl = parseInt(document.getElementById('lvl-bar').style.width);
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

        window.onload = function() {
            anime({
                targets:'#lvl-bar',
                width:
                    function () {
                        return [sessionStorage.getItem('progressLast')+'%',sessionStorage.getItem('progress')+'%'];
                    },
                easing: 'linear',
                duration: 1000,
                delay: 1000,
            });
            switch (sessionStorage.getItem('lvl')) {
                case undefined:
                case null:
                case '0':
                    anime({
                        targets: '#player',
                        duration: 500,
                        top: ['250px','275px'],
                        left: ['75px','125px'],
                        easing: 'easeInOutQuad',
                        delay: 1000,
                        endDelay: 500,
                        complete: function () {
                            document.location.href = "/game1";
                        }
                    });
                    break;
                case '1':
                    anime({
                        targets: '#player',
                        duration: 500,
                        top: ['275px', '310px'],
                        left: ['125px', '190px'],
                        easing: 'easeInOutQuad',
                        delay: 3000,
                        endDelay: 500
                    });
                    break;
                case '2':
                    anime({
                        targets: '#player',
                        duration: 500,
                        top: ['310px','335px'],
                        left: ['190px', '230px'],
                        easing: 'easeInOutQuad',
                        delay: 3000,
                        endDelay: 500
                    });
                    break;
            }
        }
    </script>
@endsection
