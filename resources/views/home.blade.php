<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cryptocurrency Dashboard : {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div id="app">
    <header id="app-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 brand">
                    @if (env('APP_NAME_SEG1') !== null && env('APP_NAME_SEG2') !== null)
                        <h1>{{ env('APP_NAME_SEG1') }}<span class="brand-secondary">{{ env('APP_NAME_SEG2') }}</span> <small>Cryptocurrency&nbsp;Dashboard</small></h1>
                    @else
                        <h1>{{ env('APP_NAME') }} <small>Cryptocurrency Dashboard</small></h1>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-2 hero-sub hero-sub-1">
                    <span class="hidden-sm hidden-xs">Approximate </span>Value:
                </div>
                <div class="col-xs-4 col-sm-3 hero-sub hero-sub-1 hero-sub-1-center">
                    <div class="hero-sub-1-inner">
                        <transition name="fade">
                            <span v-cloak v-show="mounted">0 BTC</span>
                        </transition>
                    </div>
                </div>
                <div class="col-xs-4 col-sm-3 hero-sub hero-sub-1">
                    <div class="hero-sub-1-inner">
                        <transition name="fade">
                            <span v-cloak v-show="mounted">@{{ value }} USD</span>
                        </transition>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 hero-sub hero-sub-2">
                    <button class="btn btn-primary btn-hero-sub">Suggest Feature</button>
                </div>
            </div>
        </div>
    </header>

    <section id="app-canvas">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Portfolio Trackers</h1>
                </div>
            </div>
            <div class="row">
                <app-tracker-box :coin-data="coinData" v-on:value-update="updateValues"></app-tracker-box>
            </div>
        </div>
    </section>
</div>

    <script src="/js/app.js" rel="script"></script>
</body>
</html>