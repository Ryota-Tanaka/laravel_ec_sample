@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="">
        <div class="mx-auto" style="max-width:1200px">

            <h1 class="text-center font-weight-bold" style="color:#555555;  font-size:1.2em; padding:24px 0px;">
                {{$details->name}}
            </h1>
            <div class="card-body">
                <div class="mycart_box">
                    {{$details->name}} <br>
                    <br>
                    <img src="/image/{{$details->imgpath}}" alt="" class="incart" >

                </div>
                <div class="text-center p-2">
                    <p style="font-size:1.2em; font-weight:bold;">価格：{{ number_format($details->fee)}}円</p>
                </div>
                @if (!empty($message))
                    <p class="text-center">{{$message}}</p>
                @else
                    <form action="mycart" method="post">
                        @csrf
                        <input type="hidden" name="stock_id" value="{{ $details->id }}">
                        <input type="submit" class="btn btn-danger btn-lg text-center buy-btn" value="カートに入れる">
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
