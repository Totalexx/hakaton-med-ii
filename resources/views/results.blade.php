@extends('main')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/results.css') }}">
@endsection

@section('main')
    <div class="container-sm p-0">
        <section class="game d-flex flex-column align-items-center justify-content-center">
            <div class="task text-center">
				<span class="">
					Отлично!
				</span>
                <h2>Твои навыки стали лучше на 15%</h2>
                <a href="/" class="btn">Закончить тренировку</a>
            </div>
        </section>
    </div>
@endsection

