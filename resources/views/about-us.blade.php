<!-- Blade 模板文件 -->
<!-- https://laravel.tw/docs/5.2/blade -->

@extends('layouts.app')

@section('content')
    <p>嗨！大家好！我們是{{$name}}</p>

    @if (count($records) === 1)
        有一筆資料!<br>
    @elseif (count($records) > 1)
        有多筆資料!<br>
    @else
        沒有資料!<br>
    @endif

    @switch(count($records))
        @case(1)
        有一筆資料!<br>
        @break

        @case(2)
        有二筆資料!<br>
        @break

        @default
        有資料<br>
    @endswitch

    <!-- fore 迴圈 -->
    @for ($i = 0; $i < 10; $i++)
        現在迴圈跑到 {{ $i }}<br>
    @endfor

    <!-- foreach 迴圈 -->
    @foreach ($users as $user)
        現在 user id 為 {{ $user['id'] }}<br>
    @endforeach
@endsection