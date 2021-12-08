@extends('main')

@section('css')
    <link rel="stylesheet" href="{{asset('css/game1.css')}}">
@endsection

@section('main')
    <div class="container-sm p-0">
        <header class="d-flex">
            <div class="left">
                <span class="time">
                    <span id="time" class="d-inline">20</span> сек
                    <span id="add-time">+3</span>
                </span>
            </div>
            <a class="right" href="/">
            </a>
        </header>
        <section class="game d-flex flex-column align-items-center">
            <div class="task text-center">
				<span>
					Произнесите слово
				</span>
                <h2 id="task-word">Шиншилла</h2>
            </div>
            <a onclick="startRecognizer()" id="micro"></a>
        </section>
    </div>

    <script src="{{asset('js/anime.min.js')}}"></script>
    <script>
        words = ['рама', 'роща', 'рой', 'ракушки', 'рота', 'роза', 'укус', 'фикус',
            'шелуха', 'ноша', 'лошадка', 'смешать', 'ниша', 'мишень', 'пешеход',
            'крыша', 'решать', 'огурец', 'птенец', 'дворец', 'столица', 'солнце'];
        countTrueWords = 0;
        let numWord = Math.floor(Math.random() * words.length);
        document.getElementById('task-word').textContent = words[numWord];

        let timeinterval = setInterval(updateTimer, 1000);
        function updateTimer() {
            time = parseInt(document.getElementById('time').textContent)-1;
            if (parseInt(document.getElementById('time').textContent) == 0) {
                sessionStorage.setItem('progress', parseInt(sessionStorage.getItem('progress')) + countTrueWords * 10);
                sessionStorage.setItem('lvl', parseInt(sessionStorage.getItem('lvl'))+1);
                document.location.href = "/progress";
                delete  timeinterval;
            }
            document.getElementById('time').textContent = time;
        }

        function startRecognizer() {
            document.getElementById('micro').className = 'on';
            let recognizer = new webkitSpeechRecognition();

            // Ставим опцию, чтобы распознавание началось ещё до того, как пользователь закончит говорить
            recognizer.interimResults = false;

            // Какой язык будем распознавать?
            recognizer.lang = 'ru-RU';

            // Используем колбек для обработки результатов
            recognizer.onresult = function (event) {
                let result = event.results[event.resultIndex];
                if (result.isFinal) {
                    document.getElementById('micro').className = '';
                    console.log('Вы сказали: ' + result[0].transcript);
                    addTimeAnim = anime({
                        targets: '#add-time',
                        top: ['-5px','5px'],
                        autoplay: false,
                        easing: 'linear',
                        duration: 600,
                        opacity: [0.8, 1, 0],
                    });
                    trueWordAnim = anime({
                        targets: '.task',
                        filter: ['hue-rotate(-103deg)', 'hue-rotate(0deg)'],
                        duration: 10000,
                        autoplay: false
                    });
                    falseWordAnim = anime({
                        targets: '.task',
                        filter: ['hue-rotate(103deg)', 'hue-rotate(0deg)'],
                        duration: 10000,
                        autoplay: false
                    });

                    if (levenshtein(words[numWord].toLocaleLowerCase(), result[0].transcript.toLocaleLowerCase()) < 2) {
                        addTimeAnim.restart();
                        trueWordAnim.restart();
                        document.getElementById('time').textContent = parseInt(document.getElementById('time').textContent) + 3;
                        countTrueWords++;
                    } else {
                        falseWordAnim.restart();
                    }

                    numWord = Math.floor(Math.random() * words.length);
                    document.getElementById('task-word').textContent = words[numWord];
                }
            };

            // Начинаем слушать микрофон и распознавать голос
            recognizer.start();
        }

        function levenshtein(s1, s2, costs) {
            var i, j, l1, l2, flip, ch, chl, ii, ii2, cost, cutHalf;
            l1 = s1.length;
            l2 = s2.length;

            costs = costs || {};
            var cr = costs.replace || 1;
            var cri = costs.replaceCase || costs.replace || 1;
            var ci = costs.insert || 1;
            var cd = costs.remove || 1;

            cutHalf = flip = Math.max(l1, l2);

            var minCost = Math.min(cd, ci, cr);
            var minD = Math.max(minCost, (l1 - l2) * cd);
            var minI = Math.max(minCost, (l2 - l1) * ci);
            var buf = new Array((cutHalf * 2) - 1);

            for (i = 0; i <= l2; ++i) {
                buf[i] = i * minD;
            }

            for (i = 0; i < l1; ++i, flip = cutHalf - flip) {
                ch = s1[i];
                chl = ch.toLowerCase();

                buf[flip] = (i + 1) * minI;

                ii = flip;
                ii2 = cutHalf - flip;

                for (j = 0; j < l2; ++j, ++ii, ++ii2) {
                    cost = (ch === s2[j] ? 0 : (chl === s2[j].toLowerCase()) ? cri : cr);
                    buf[ii + 1] = Math.min(buf[ii2 + 1] + cd, buf[ii] + ci, buf[ii2] + cost);
                }
            }
            return buf[l2 + cutHalf - flip];
        }
    </script>
@endsection
