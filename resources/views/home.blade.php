@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">管理者メニュー</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach ($data as $item)
                    <form action="/{{ $item->id }}" method="POST">
                        {{ csrf_field() }}
                        @method('DELETE')
                    <p>{{ $item->id . ". " }}<a href="{{ url("/") . "/" . $item->id }}">{{ $item->name }}</a>{{"(".$item->responses_count().")"}} <input type="submit" value="削除" /></p>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
