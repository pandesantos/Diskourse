<nav class="navbar navbar-inverse" role="navigation">
        
        <div class="container">
                <div class="navbar-header">
                        <!--
                        To import a logo
                         
                        <a class="navbar-brand" href="#">
                        <img alt="Brand" src="...">
                        </a> -->
                        <a href="{{ route('home') }}" class="navbar-brand">Diskourse</a>

                </div>
               
                <div class="collapse navbar-collapse">
                        @if (Auth::check())
                        <ul class="nav navbar-nav">
                                <li><a href="#">Help</a></li>

                                <li><a href="{{ route('friends.index') }}" data-toggle="tooltip" title="List"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span><span class="badge"> +1</span></a></li>

                        </ul>
                       
                        <form action="{{ route('search.results') }}" role="search" class="navbar-form navbar-left">
                                <div class="form-group">
                                        <input type="text" name="query" class="form-control"
                                        placeholder="Enter username or name"/>
                                </div>
                               
                                <button type="button" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search
                                </button>
                        </form>


                        @endif



                        <ul class="nav navbar-nav navbar-right">


                                @if(Auth::check())
                                
                            
                                <li><a href="{{ route('profile.index', ['username'=>Auth::user()->username]) }}" data-toggle="tooltip" title="Dashboard"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
                                <li><a href="#" data-toggle="tooltip" title="Your Stats"><span class="glyphicon glyphicon-stats" aria-hidden="true"></a></li>
                                <li><a href="{{ route('profile.edit') }}" data-toggle="tooltip" title="Update Profile"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></li>
                                <li><a href="{{ route('profile.videos') }}" data-toggle="tooltip" title="Videos"><span class="glyphicon glyphicon-film" aria-hidden="true"></span></a></li>
                                <li><a href="{{ route('profile.resources') }}" data-toggle="tooltip" title="Resources"><span class="glyphicon glyphicon-book" aria-hidden="true"></span></a></li>
                                <li><a href="#" data-toggle="tooltip" title="Notifications"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span><span class="badge">42</span></a></li>                                
                                <li><a href="{{ route('message.index') }}" data-toggle="tooltip" title="Messages"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><span class="badge">5</span></a></li>
                                <li><a href="{{ route('auth.signout') }}">Sign out <span class="glyphicon glyphicon-off" aria-hidden="true"></span></a></li>
                                @else
                                <li><a href="{{ route('auth.signup') }}">Sign up</a></li>
                                <li><a href="{{ route('auth.signin') }}">Sign in</a></li>
                                @endif
                        </ul>
                        <span class="glyphicon glyphicon-search" aria-hidden="true"></span>

                </div>
        </div>
</nav>