@extends('layouts.main')

@section('content')
    <section class="table">
        <br><br>
        Фильтры
        <form class="form" method="GET" action="{{ route('statistic') }}">
            @csrf
            <label for="word">Дата</label>
            <input type="date" name="date" value="{{$date}}">
            <input type="text" name="ip" placeholder='xxx.xxx.xxx.xxx' value="{{$ip}}">
            <button type="submit" class="button">
                Ok
            </button>
        </form>
        <br>
        <div class="table-wrap">
            <table>
                <thead>
                <tr>
                    <th>
                        Дата
                    </th>
                    <th>
                        Ip
                    </th>
                    <th>
                        Слово
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($search as $query)
                    <tr>
                        <td><?php
                            $time = strtotime($query->time);
                            $myFormatForView = date("d.m.Y", $time);
                            echo $myFormatForView;
                            ?>
                            </td>
                        <td>{{$query->ip}}</td>
                        <td>{{$query->lemma}}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection