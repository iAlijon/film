@extends('layouts.app')

@section('content')
    <div class="news container news-container tm-section-margin-t">
        @if($news->first())
            <a href="{{route('show', ['id' => $news->first()->id])}}">
                <div class="left">
                    <div class="card large-card">
                        <img src="{{getInFolder($news->first()['image'], 'news')}}" alt="" style="width:100%; height:100%;">
                        <span class="news-info">
                <span class="news-title">{{$news->first()['name_oz']}}</span>
                <span class="news-date">{{$news->first()->created_at->format('H:i')}}</span>
            </span>
                    </div>
                </div>
            </a>
        @endif
        <div class="right">
            @foreach($news->slice(1) as $new)
                <a href="{{route('show', ['id' => $new->id])}}">
                    <div class="card small-card">
                        <img src="{{getInFolder($new['image'], 'news')}}" alt=""
                             style="width:100%; height:100%;">
                        <span class="news-info">
                                <span class="news-title">{{$new->name_oz}}</span>
                                <span class="news-date">{{$new->created_at->format('H:i')}}</span>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <style>
        .news-container {
            display: flex;
            width: 90%;
            gap: 20px;
        }

        .news .left {
            flex: 1;
        }

        .news .right {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .news .card {
            border: 0 solid #ddd;
            padding: 20px;
            border-radius: 5px;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .news .large-card {
            height: 423px;
            /*height: 424px;*/
            font-size: 24px;
            background-color: #f7f7f7;
            padding: 0 !important;
        }

        .news .small-card {
            height: 200px;
            font-size: 18px;
            background-color: #e0f7fa;
            padding: 0;
        }

        .large-card .news-title {
            font-size: 24px;
            color: #000;
        }

        .small-card .news-title {
            font-size: 14px;
            color: #000;
        }

        .large-card .news-date {
            display: block;
            font-size: 12px;
            color: #000;
        }

        .small-card .news-date {
            display: block;
            font-size: 12px;
            color: #000;
        }

        .news-info {
            position: absolute;
            bottom: 5px;
            left: 5px;
            right: 5px;
        }

        @media (max-width: 768px) {
            .news-container {
                flex-direction: column;
            }

            .news .right {
                grid-template-columns: 1fr;
            }

            .news .left, .news .right {
                flex: none;
                width: 100%;
            }
        }
    </style>


@endsection
