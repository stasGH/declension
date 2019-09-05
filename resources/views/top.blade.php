@extends('layouts.main')

@section('content')
                <div class="title m-b-md">
                    Топ пользователей
                </div>
                @foreach ($search as $query)
                    <li>{{$query->ip}}</li>
                @endforeach

@endsection