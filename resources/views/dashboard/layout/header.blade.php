@php
    $count = 0;
    $id = Auth::user()->id;
    $categories = \App\Category::all()->where('user_id',$id);
    foreach ($categories as $value){
    $notify = $value->notify;
    $item = \App\Item::where('category_id', $value->id);
    $sum = $item->sum('quantity');
    if ($sum < $notify){
    $count++;
    }else $count = null;
    }
    if(auth()->user()->days <= 5){
        $count++;
    }
@endphp
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script>
    var categories = [""];
</script>
<header class="topbar" data-navbarbg="skin6">

    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
        <!-- ==============================================================
            <div class="navbar-brand">

                <a href="">
                    <b class="logo-icon">

                        <img src="{{asset('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />

                        <img src="{{asset('assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" />
                    </b>

                    >
                    <span class="logo-text">

                                <img src="{{asset('assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />

                                <img src="{{asset('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" />
                            </span>
                </a>
            </div>
        -->
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
               data-toggle="collapse" data-target="#navbarSupportedContent"
               aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div style="background-color: #37517e" class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                <!-- Notification -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                       id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <span><i data-feather="bell" class="svg-icon"></i></span>

                        <span class="badge badge-primary notify-no rounded-circle">{{$count}}</span>


                    </a>
                    <div id="noti" class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                        <ul class="list-style-none">
                            <li>
                                <div class="message-center notifications position-relative">
                                    <!-- Message -->


                                    @foreach ($categories as $value)
                                        @php
                                            $notify = $value->notify;
                                            $item = \App\Item::where('category_id', $value->id);
                                            $sum = $item->sum('quantity');
                                            if ($sum <= $notify){

                                        @endphp

                                        <a href="{{route('items',['id' => $value->id])}}"
                                           class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                            <div class="btn btn-danger rounded-circle btn-circle"><i
                                                    data-feather="airplay" class="text-white"></i></div>

                                            <div class="w-75 d-inline-block v-middle pl-2">
                                                <h6 class="message-title mb-0 mt-1">{{Lang::get('site.Notification')}}</h6>
                                                <span class="font-12 text-nowrap d-block text-muted">{{Lang::get('site.You have')}} ( {{$value->name}} ) {{Lang::get('site.category less than')}} ( {{$value->notify}} )</span>

                                            </div>
                                        </a>
                                        <!-- Message -->
                                        @php  } @endphp
                                    @endforeach
                                    @if(auth()->user()->days <= 5)
                                        @php
                                        $count++
                                        @endphp
                                        <a href="{{route('items',['id' => $value->id])}}"
                                           class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                            <div class="btn btn-danger rounded-circle btn-circle"><i
                                                    data-feather="airplay" class="text-white"></i></div>

                                            <div class="w-75 d-inline-block v-middle pl-2">
                                                <h6 class="message-title mb-0 mt-1">{{Lang::get('site.Notification')}}</h6>
                                                <span class="font-12 text-nowrap d-block text-muted">{{Lang::get('site.daysnoti')}}</span>

                                            </div>
                                        </a>
                                    @endif
                                </div>
                            </li>
                            @if($count == 0)
                                <li>
                                    <h5 class="nav-link pt-3 text-center text-dark">You Have No Notifications</h5>

                                </li>
                            @endif
                        </ul>
                    </div>

                </li>
                <!-- End Notification -->
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="settings" class="svg-icon"></i>
                    </a>
                    <div id="noti2" class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           href="{{route('edituser',['id' => \Illuminate\Support\Facades\Auth::user()->id])}}">{{Lang::get('site.Edit My Info')}}</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">

                        <span class="ml-2 d-none d-lg-inline-block"><span>{{Lang::get('site.Language')}}</span> <span
                                class="text-dark"></span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                    </a>
                    <div id="top" style="margin-right: -80px;"
                         class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a style="padding: 0.65rem 4rem;" class="dropdown-item" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"><i
                                    class="svg-icon mr-2 ml-1">
                                    {{ $properties['native'] }}
                                </i>
                            </a>
                        @endforeach
                        <div class="dropdown-divider"></div>
                    </div>
                </li>

            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ==============================================================-->
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link" href="javascript:void(0)">
                        <form>
                            <div class="customize-input">
                                <input autocomplete="off" id="employee_search"
                                       class="form-control custom-shadow custom-radius border-0 bg-white"
                                       type="search" placeholder="{{Lang::get('site.search')}}" aria-label="Search">
                                <i class="form-control-icon" data-feather="search"></i>
                            </div>
                        </form>
                    </a>
                </li>

                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a id="user" class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">

                        <span
                            class="ml-2 d-none d-lg-inline-block"><span>{{Lang::get('site.Hello')}} {{Auth::user()->name}}</span> <span
                                class="text-dark"></span> <i data-feather="chevron-down"
                                                             class="svg-icon"></i></span>
                    </a>
                    <div id="top" class="dropdown-menu dropdown-menu-right user-dd animated flipInY">

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                           href="{{route('edituser',['id' => \Illuminate\Support\Facades\Auth::user()->id])}}"><i
                                data-feather="settings"
                                class="svg-icon mr-2 ml-1"></i>
                            {{Lang::get('site.Account Setting')}}</a>

                        <div class="dropdown-divider"></div>
                        <div class="pl-4 p-3">
                            <form id="logout-form" action="{{route('logout')}}">
                                <button class="btn btn-sm btn-info" type="submit"><i data-feather="power"
                                                                                     class="svg-icon mr-2 ml-1">

                                    </i>
                                    {{Lang::get('site.Logout')}}</button>

                            </form>
                        </div>


                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<aside id="side" class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{route('dashhome')}}"
                                            aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">{{Lang::get('site.Dashboard')}}</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">{{Lang::get('site.My Categories')}}</span></li>
                <br>
                <li class="sidebar-item"><a class="sidebar-link has-arrow" href="javascript:void(0)"
                                            aria-expanded="false"><i data-feather="file-text"
                                                                     class="feather-icon"></i><span
                            class="hide-menu">{{Lang::get('site.Categories')}} </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        @foreach($categories as $value)
                            <li class="sidebar-item"><a href="{{route('items',['id' => $value->id])}}"
                                                        class="sidebar-link"><span
                                        class="hide-menu"> {{$value->name}}
                                        </span></a>
                            </li>
                            <script>
                                categories.push("{{$value->name}}")
                            </script>
                        @endforeach


                    </ul>
                </li>
                <hr>
                <li class="nav-small-cap"><span class="hide-menu">{{Lang::get('site.Manage categories')}}</span></li>
                <br>

                <li class="sidebar-item"><a class="sidebar-link" href="{{route('categoriesinfo')}}"
                                            aria-expanded="false"><i data-feather="eye" class="feather-icon"></i><span
                            class="hide-menu">{{Lang::get('site.Categories Info')}}
                                </span></a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{route('addcategory')}}"
                                            aria-expanded="false"><i data-feather="plus" class="feather-icon"></i><span
                            class="hide-menu">{{Lang::get('site.Add New')}}</span></a></li>


            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>


