@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="/css/lightbox/css/lightbox.css">
@endsection

@section('content')

<div class="content-wrapper" style="position: relative;">
        <p class="big-text">
            Alege-ti fotograful preferat si ajuta-l<br>
            sa castige echipamentul dorit
        </p>
    @foreach ($votes->slice(0,10) as $vote)

        <div class="container-dotted-border" style="border-radius: 5px; margin-top: 20px; margin-bottom: 0px; width: 650px;">
            <div style="position: relative; float: left; width: 110px; height: 110px; margin: 10px;">
                <div style="width: 110px;height: 110px;border-radius: 55px;display: block;background-color: #d00000"></div>
                <div style="width: 100px;height: 100px;border-radius: 50px; position: absolute; left: 5px; top: 5px; overflow: hidden;">
                    <img width="100" src="/images/profilePhotos/thumb_100_{{md5($vote->user->id)}}.jpg" >
                </div>

            </div>

            <div style="width: 270px; height: 35px; float: left; text-align: left; font-size: 35px; line-height: 30px; font-weight: bold; padding-top: 30px;">
                {{$vote->user->name}}
            </div>

            <div class="red-button" style="width: 120px; float: right; height: 120px; margin: 5px; padding: 0px; border-radius: 5px;">
                <div style="line-height: 50px; font-size: 48px; font-weight: bold; margin-top: 30px;">{{$vote->voteCount}}</div>
                <div style="line-height: 10px; font-size: 16px; margin-top: 15px;">donatii stranse </div>
            </div>

            <div style="width: 270px; height: 55px; margin-top: 10px; float: left; text-align: left;">
                @foreach ($vote->profile->votes as $userVote)
                    <img style="width: 26px; height: 26px; border-radius: 13px;" src="/images/profilePhotos/thumb_50_{{md5($userVote->user->id)}}.jpg" >
                @endforeach
            </div>

            <a class="vote-overlay" href="/profile/index/{{$vote->profile->id}}">
                <div class="red-button red-button-border" style="width: 50%; margin-left: auto; margin-right: auto; margin-top: 45px;">Doneaza-i o poza</div>
            </a>

            <div class="clearfix"></div>

        </div>
    @endforeach


</div>

@endsection

@section('javascript')
<script src="/js/vendor/lightbox.min.js"></script>

<script type="text/javascript">
    $(document).ready(function()
    {

    });
</script>
@endsection