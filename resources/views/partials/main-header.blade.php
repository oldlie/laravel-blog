<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a href="{{action('BlogController@index')}}" class="navbar-brand"><b>Admin</b>LTE</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <i class="fa fa-bars"></i>
                </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active dropdown" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">资讯 <span class="fa fa-bars"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{action('BlogController@showMore', ['category' => 0])}}">
                                    最新</a>
                            </li>
                            @foreach($links as $link)
                                <li>
                                    <a href="{{action('BlogController@showMore', ['category' => $link->id])}}">
                                        {{$link->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @foreach($urls as $url)
                        <li><a href="{{url($url->url)}}" target="_blank">{{$url->title}}</a></li>
                    @endforeach
                </ul>
                
            </div>
            <!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">

            </div>
            <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
    </nav>
</header>