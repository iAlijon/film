@extends('layouts.app')

@section('content')
<div class="news container news-container tm-section-margin-t">
    <div class="left">
        <div class="card large-card">
            <img src="/mnt/data/image.png" alt="" style="width:100%; height:auto;">
            <span class="news-info">
                <span class="news-title">"Mahalla loyihasi" dasturiga 1 mlrd dollar yo'naltirildi</span>
                <span class="news-date">Kecha, 14:59</span>
            </span>
        </div>
    </div>
    <div class="right">
        <div class="card small-card">
            <img src="/mnt/data/image.png" alt="" style="width:100%; height:auto;">
            <span class="news-info">
                <span class="news-title">Olimpiadadagi rekord, jahon chempioni</span>
                <span class="news-date">Kecha, 12:26</span>
            </span>
        </div>
        <div class="card small-card">
            <img src="/mnt/data/image.png" alt="" style="width:100%; height:auto;">
            <span class="news-info">
                <span class="news-title">O'zbekistonning COMSTECH bilan hamkorligi</span>
                <span class="news-date">Kecha, 12:26</span>
            </span>
        </div>
        <div class="card small-card">
            <img src="/mnt/data/image.png" alt="" style="width:100%; height:auto;">
            <span class="news-info">
                <span class="news-title">G'arb Ukrainaga KK himoyasini buzishni istamaydi</span>
                <span class="news-date">Kecha, 13:56</span>
            </span>
        </div>
        <div class="card small-card">
            <img src="/mnt/data/image.png" alt="" style="width:100%; height:auto;">
            <span class="news-info">
                <span class="news-title">Tahliliy va tadqiqot tuzilmalar faoli</span>
                <span class="news-date">Kecha, 11:11</span>
            </span>
        </div>
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
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 5px;
        text-align: left;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .news .large-card {
        height: 420px;
        font-size: 24px;
        background-color: #f7f7f7;
    }

    .news .small-card {
        height: 200px;
        font-size: 18px;
        background-color: #e0f7fa;
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
        font-size: 22px;
        color: #000;
    }

    .small-card .news-date {
        display: block;
        font-size: 12px;
        color: #000;
    }
    .news-info{
        position:absolute;
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
    