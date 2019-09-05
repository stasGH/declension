@extends('layouts.main')

@section('content')
                <div class="title m-b-md">
                    Склонение слов
                </div>
                <div>
                    <form class="form" method="POST" action="{{ route('dashboard') }}">
                        @csrf
                        <label for="word">Введите слово</label>
                        <input type="text" name="word" >
                        <button type="submit" class="button">
                            Ok
                        </button>
                    </form>
                </div>
                <?php if(isset($word)): ?>
                <div>
                    <h3>Падежи слова "{{$word}}"</h3>
                    <?php if($revisions): ?>
                        Именительный -  {{$revisions[0]}}</br>
                        Родительный -  {{$revisions[1]}}</br>
                        Дательный -  {{$revisions[2]}}</br>
                        Винительный -  {{$revisions[3]}}</br>
                        Творительный -  {{$revisions[4]}}</br>
                        Предложный -  {{$revisions[5]}}</br>
                    <?php else: ?>
                    <div class="err">В нашем словаре этого слова нет</div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
@endsection