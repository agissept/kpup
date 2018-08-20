@extends('master')
@section('content')
    <h1>{{$tableName}}</h1>
    <table border="1px">
        <tr>
            @for ($i = 1; $i < count($name); $i++)
               <td> {{$name[$i]}}</td>
            @endfor
        </tr>
        <tr>
            @if($tables!=null)
                @for ($i = 1; $i < count($name); $i++)
                    @php
                        $str=$name[$i]
                    @endphp
                    <td>{{$tables->$str}}</td>
                @endfor
            @else
                @for ($i = 1; $i < count($name); $i++)
                    <td>null</td>
                @endfor
            @endif
        </tr>
    </table>
@endsection