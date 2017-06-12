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
    <header>
        <div class="container-fluid">
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
                    Value:
                </div>
                <div class="col-xs-4 col-sm-3 hero-sub hero-sub-1">
                    0 BTC
                </div>
                <div class="col-xs-4 col-sm-3 hero-sub hero-sub-1">
                    0 USD
                </div>
                <div class="col-xs-12 col-sm-4 hero-sub hero-sub-2">
                    <a href="#">Suggest Feature</a>
                </div>
            </div>
        </div>
    </header>

    <script src="/js/app.js" rel="script"></script>
</body>
</html>