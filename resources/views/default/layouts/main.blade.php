<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="keywords" content="OLAINDEX,OneDrive,Index,Microsoft OneDrive,Directory Index"/>
    <meta name="description" content="OLAINDEX,Another OneDrive Directory Index"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"
          href="https://cdn.staticfile.org/bootswatch/4.3.1/{{ setting('theme','materia') }}/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/github-markdown-css/3.0.1/github-markdown.min.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/fancybox/3.5.6/jquery.fancybox.min.css">
    @yield('css')
    <style>
        .item-list .list-group-item {
            border: 0;
        }
    </style>
    <script>
        Config = {
            'routes': {
                'upload_image': '{{ route('image.upload') }}'
            },
            '_token': '{{ csrf_token() }}',
        };
    </script>
</head>

<body>
<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home',['clientId' => setting('main_client_id')]) }}">{{ setting('name','OLAINDEX') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                @foreach (getOnedriveAccounts() as $drive)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home',['clientId' => $drive['id']]) }}"><i class="fa fa-hdd-o"></i> {{$drive['nick_name']}}</a>
                </li>
                @endforeach
                @if( (int)setting('image_hosting') === 1 || ((int)setting('image_hosting') === 2 && auth()->user()))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('image') }}"><i class="fa fa-cloud-upload"></i> 图床</a>
                    </li>
                @endif
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.basic') }}"><i class="fa fa-tachometer"></i> 管理</a>
                    </li>
                @endauth
            </ul>
            @if(setting('open_search',0))
                <form class="form-inline my-2 my-lg-0" action="{{ route('search') }}">
                    <input class="form-control mr-sm-2" type="text" name="keywords" placeholder="搜索">
                    <button class="btn btn-secondary my-2 my-sm-0" type="submit">搜索</button>
                </form>
            @endif
        </div>
    </div>
</nav>

<div class="container mt-3">
    @if (session()->has('alertMessage'))
        <div class="alert alert-dismissible alert-{{ session()->pull('alertType')}}">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p>{{ session()->pull('alertMessage') }}</p>
        </div>
    @endif
    @yield('content')
    <footer id="footer">
        <div class="row text-center">
            <div class="col-lg-12">
                <p class="text-muted"> 
                    本站资源仅为学习参考，不可用于商业目的，否则后果自负！版权归原作者所有，请在下载后于24小时内删除！<script type="text/javascript" src="https://js.users.51.la/20204597.js"></script>  <br />
                    <a href="http://piaoyun.cc/?online" title="飘云PiaoYun.CC" target="_blank">飘云</a>(<a href="http://piaoyun.cc/?online" title="飘云PiaoYun.CC" target="_blank">PiaoYun.CC</a>) OneDrive 网盘共享下载 <a href="http://piaoyun.cc/?online" title="飘云PiaoYun.CC" target="_blank">PiaoYun.CC</a> | Powered by <a href="https://github.com/WangNingkai/OLAINDEX" target="_blank" rel="nofollow">olaindex</a> | 
Modfied by <a href="https://yukino.co/" target="_blank" rel="nofollow">Yukino</a> | Powered by <a href="https://github.com/YukiCoco/OLAINDEX-Magic" target="_blank" rel="nofollow">OLAINDEX-Magic</a>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?ee388297fd19c6ef370d8dc3bdcebb59";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>

                  <br />
                  <script type="text/javascript" src="//quote.51.la/q?id=20204597&mb=1"></script>
                </p>
            </div>
        </div>
    </footer>
</div>
<script src="https://cdn.staticfile.org/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.staticfile.org/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdn.staticfile.org/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
<script src="https://cdn.staticfile.org/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
<script src="https://cdn.staticfile.org/fancybox/3.5.6/jquery.fancybox.min.js"></script>
<script src="https://cdn.staticfile.org/clipboard.js/2.0.4/clipboard.min.js"></script>
@yield('js')
{!! setting('statistics') !!}
<script>
    $(function () {
        $('[data-fancybox="image-list"]').fancybox({
            type: "image",
            thumbs: {
                autoStart: true,
                axis: 'x'
            },
            buttons: [
                "zoom",
                "slideShow",
                "fullScreen",
                "download",
                "thumbs",
                "close"
            ],
        });
        let clipboard = new ClipboardJS('.clipboard');
        clipboard.on('success', function (e) {
            console.info('Action:', e.action);
            console.info('Text:', e.text);
            console.info('Trigger:', e.trigger);
            e.clearSelection();
        });
        clipboard.on('error', function (e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
        });
        $('[data-toggle="tooltip"]').tooltip({
            title: '已复制',
            trigger: 'click'
        });
        $('img.lazy').lazyload();
    });
</script>
</body>

</html>
