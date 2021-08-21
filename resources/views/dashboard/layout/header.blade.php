@php
    $count = 0;
    $id = Auth::user()->store_id;
    $conditons = ['store_id' => $id,'deleted' => '0'];
    $categories = \App\Category::where($conditons)->get();
    if (auth()->user()->level != 3){
        foreach ($categories as $value){
            $notify = $value->notify;
            $condition = ['category_id' => $value->id, 'deleted' => '0'];
            $item = \App\Transaction::where($condition)->get();
            $sum = $item->sum('quantity');
            if ($sum <= $notify){
                $count++;
            }
        else {$count = 0;}
        }
    }
    $store = \App\Store::findOrFail(auth()->user()->store_id);
    $days = $store->days;
    if($days <= 5){
        $count++;
    }
    $tasks = \App\Task::where('user_id', auth()->user()->id)->get();
foreach($tasks as $value){
    if($value->start == date('Y-m-d') || $value->end == date('Y-m-d')){
        $count++;
    }
}
function billsnum($condition){
        if (auth()->user()->level == 1 || auth()->user()->level == 2){
        $I = \App\EmportBill::where($condition)->get();
        $i = $I->count('id');
        $E = \App\ExportBill::where($condition)->get();
        $e = $E->count('id');
            return ($i + $e);
        }
}

@endphp
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<header class="topbar" data-navbarbg="skin6">

    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ==============================================================-->
            <div class="navbar-brand">

                <a href="{{route('dashhome')}}">
                    <b class="logo-icon">

                        <img style="width: 166%; margin-left: -70px; margin-top: 45px" src="{{asset('assets/images/favicon.png')}}"
                             alt="homepage" class="dark-logo"/>

                        {{--<img src="{{asset('assets/images/logo-icon.png')}}" alt="homepage" class="light-logo" />--}}
                    </b>

                   {{-- <span class="logo-text">

                                <img src="{{asset('assets/images/text.png')}}" alt="homepage" class="dark-logo"/>

                                --}}{{--<img src="{{asset('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" />--}}{{--
                            </span>--}}
                </a>
            </div>
<hr>
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
                                            $condition = ['category_id' => $value->id, 'deleted' => '0'];
                                            $item = \App\Transaction::where($condition)->get();
                                            $sum = $item->sum('quantity');
                                            if ($sum <= $notify){

                                        @endphp
                                        @if(auth()->user()->level == 1 || auth()->user()->level == 2 || auth()->user()->level == 4)
                                            <a href="{{route('items',['id' => $value->id])}}"
                                               class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-danger rounded-circle btn-circle"><i
                                                        data-feather="airplay" class="text-white"></i></div>

                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">{{Lang::get('site.Notification')}}</h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">{{Lang::get('site.You have')}} ( {{$value->name}} ) {{Lang::get('site.category less than')}} ( {{$value->notify}} )</span>

                                                </div>
                                            </a>
                                        @endif
                                    <!-- Message -->
                                        @php  } @endphp
                                    @endforeach
                                    @if($days <= 5)
                                        <a href=""
                                           class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                            <div class="btn btn-info rounded-circle btn-circle"><i
                                                    data-feather="settings" class="text-white"></i></div>

                                            <div class="w-75 d-inline-block v-middle pl-2">
                                                <h6 class="message-title mb-0 mt-1">{{Lang::get('site.Notification')}}</h6>
                                                <span
                                                    class="font-12 text-nowrap d-block text-muted">{{Lang::get('site.daysnoti')}}</span>

                                            </div>
                                        </a>
                                    @endif
                                    @foreach($tasks as $value)
                                        @if($value->start == date('Y-m-d') || $value->end == date('Y-m-d'))
                                            <a href=""
                                               class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-success text-white rounded-circle btn-circle"><i
                                                        data-feather="calendar" class="text-white"></i></div>

                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">{{Lang::get('site.event today')}}</h6>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted">{{Lang::get('site.you have')}} {{$value->name}} {{Lang::get('site.event today')}}</span>

                                                </div>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                            @if($count == 0)
                                <li>
                                    <h5 class="nav-link pt-3 text-center text-dark">{{Lang::get('site.You Have No Notifications')}}</h5>

                                </li>
                            @endif
                        </ul>
                    </div>

                </li>
                <!-- End Notification -->
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->
                @if(auth()->user()->level == 1)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="plus" class="svg-icon"></i>
                        </a>
                        <div id="noti2" class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                               href="{{route('adduser')}}">{{Lang::get('site.Add User')}}</a>
                            <div class="dropdown-divider"></div>
                        </div>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="settings" class="svg-icon"></i>
                    </a>
                    <div id="noti2" class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"
                           href="{{route('edituser')}}">{{Lang::get('site.Edit My Info')}}</a>
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
                <li id="search" class="nav-item d-none d-md-block">
                    <a class="nav-link" href="javascript:void(0)">
                        <form action="{{route('searchCategory')}}" method="post">
                            @csrf
                            <div class="customize-input">
                                <input autocomplete="off" id="employee_search"
                                       class="form-control custom-shadow custom-radius border-0 bg-white"
                                       type="search" placeholder="{{Lang::get('site.search')}}" aria-label="Search"
                                       name="search">
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
                            class="ml-2 d-none d-lg-inline-block"><span>{{Lang::get('site.Hello')}} {{ucfirst(auth()->user()->name)}}</span> <span
                                class="text-dark"></span> <i data-feather="chevron-down"
                                                             class="svg-icon"></i></span>
                    </a>
                    <div id="top" class="dropdown-menu dropdown-menu-right user-dd animated flipInY">

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"
                           href="{{route('edituser')}}"><i
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
                @if(auth()->user()->level == 1)
                    <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{route('employees')}}"
                                                aria-expanded="false"><i data-feather="users"
                                                                         class="feather-icon"></i><span
                                class="hide-menu">{{Lang::get('site.users')}}</span></a></li>
                @endif
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">{{Lang::get('site.My Categories')}}</span></li>
                <br>
                <li class="sidebar-item"><a class="sidebar-link has-arrow" href="javascript:void(0)"
                                            aria-expanded="false"><i data-feather="file-text"
                                                                     class="feather-icon"></i><span
                            class="hide-menu">{{Lang::get('site.Categories')}} <span
                                class="badge badge-pill badge-primary">@php $cond = ['processing' => '0', 'store_id' => auth()->user()->store_id]; echo(billsnum($cond)); @endphp</span> </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        @foreach($categories as $value)
                            <li class="sidebar-item"><a href="{{route('items',['id' => $value->id])}}"
                                                        class="sidebar-link"><span
                                        class="hide-menu"> {{$value->name}} @php
                                            $condition = ['category_id' => $value->id, 'processing' => '0', 'store_id' => auth()->user()->store_id];
                                            if(billsnum($condition) != 0){
                                        @endphp <span
                                            class="badge badge-pill badge-primary">@php echo(billsnum($condition));} @endphp</span>
                                        </span></a>
                            </li>
                        @endforeach


                    </ul>
                </li>
                @if(auth()->user()->level != 2)
                    <li class="sidebar-item"><a class="sidebar-link has-arrow" href="javascript:void(0)"
                                                aria-expanded="false"><i data-feather="file-text"
                                                                         class="feather-icon"></i><span
                                class="hide-menu">{{Lang::get('site.Bills')}} </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            @if(auth()->user()->level == 1 || auth()->user()->level == 4)
                                <li class="sidebar-item"><a href="javascript:void(0)"
                                                            class="sidebar-link has-arrow"><i data-feather="arrow-down"
                                                                                              class="feather-icon"></i><span
                                            class="hide-menu">{{Lang::get('site.Import')}}
                                        </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                        <li class="sidebar-item"><a href="{{route('addimport')}}"
                                                                    class="sidebar-link"><i data-feather="plus"
                                                                                            class="feather-icon"></i><span
                                                    class="hide-menu">{{Lang::get('site.Add New')}}
                                        </span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="{{route('importinfo')}}"
                                                                    class="sidebar-link"><i data-feather="eye"
                                                                                            class="feather-icon"></i><span
                                                    class="hide-menu">{{Lang::get('site.Show All')}}
                                        </span></a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if(auth()->user()->level == 1 || auth()->user()->level == 3)
                                <li class="sidebar-item"><a href="javascript:void(0)"
                                                            class="sidebar-link has-arrow"><i data-feather="arrow-up"
                                                                                              class="feather-icon"></i><span
                                            class="hide-menu">{{Lang::get('site.Export')}}
                                        </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                        <li class="sidebar-item"><a href="{{route('addexport')}}"
                                                                    class="sidebar-link"><i data-feather="plus"
                                                                                            class="feather-icon"></i><span
                                                    class="hide-menu">{{Lang::get('site.Add New')}}
                                        </span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="{{route('exportinfo')}}"
                                                                    class="sidebar-link"><i data-feather="eye"
                                                                                            class="feather-icon"></i><span
                                                    class="hide-menu">{{Lang::get('site.Show All')}}
                                        </span></a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                <hr>
                <li class="nav-small-cap"><span class="hide-menu">{{Lang::get('site.Manage categories')}}</span></li>
                <br>
                @if(auth()->user()->level == 1 || auth()->user()->level == 2 || auth()->user()->level == 4)
                    <li class="sidebar-item"><a href="javascript:void(0)"
                                                class="sidebar-link has-arrow"><i data-feather="settings"
                                                                                  class="feather-icon"></i><span
                                class="hide-menu"> {{Lang::get('site.Manage categories')}}
                                        </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a class="sidebar-link" href="{{route('categoriesinfo')}}"
                                                        aria-expanded="false"><i data-feather="eye"
                                                                                 class="feather-icon"></i><span
                                        class="hide-menu">{{Lang::get('site.Categories Info')}}
                                </span></a>
                            </li>
                            <li class="sidebar-item"><a class="sidebar-link sidebar-link"
                                                        href="{{route('addcategory')}}"
                                                        aria-expanded="false"><i data-feather="plus"
                                                                                 class="feather-icon"></i><span
                                        class="hide-menu">{{Lang::get('site.Add New')}}</span></a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->level == 1 || auth()->user()->level == 2)
                    <li class="sidebar-item"><a href="javascript:void(0)"
                                                class="sidebar-link has-arrow"><i data-feather="repeat"
                                                                                  class="feather-icon"></i> <span
                                class="hide-menu">{{Lang::get('site.Operations')}}
                                        </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a class="sidebar-link" href="{{route('imports')}}"
                                                        aria-expanded="false"><i data-feather="arrow-down"
                                                                                 class="feather-icon"></i><span
                                        class="hide-menu">{{Lang::get('site.imports')}}
                                </span></a>
                            </li>
                            <li class="sidebar-item"><a class="sidebar-link" href="{{route('exports')}}"
                                                        aria-expanded="false"><i data-feather="arrow-up"
                                                                                 class="feather-icon"></i><span
                                        class="hide-menu">{{Lang::get('site.exports')}}
                                </span></a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->level != 2)
                    <li class="sidebar-item"><a href="javascript:void(0)"
                                                class="sidebar-link has-arrow"><i data-feather="users"
                                                                                  class="feather-icon"></i><span
                                class="hide-menu">{{Lang::get('site.Suppliers & Customers')}}
                                        </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            @if(auth()->user()->level == 1 || auth()->user()->level == 4)
                                <li class="sidebar-item"><a class="sidebar-link has-arrow" href="javascript:void(0)"
                                                            aria-expanded="false"><i data-feather="user"
                                                                                     class="feather-icon"></i><span
                                            class="hide-menu">{{Lang::get('site.Suppliers')}}
                                </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                        <li class="sidebar-item"><a href="{{route('addsupplier')}}"
                                                                    class="sidebar-link"><i data-feather="plus"
                                                                                            class="feather-icon"></i><span
                                                    class="hide-menu">{{Lang::get('site.Add New')}}
                                        </span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="{{route('suppliersinfo')}}"
                                                                    class="sidebar-link"><i data-feather="eye"
                                                                                            class="feather-icon"></i><span
                                                    class="hide-menu">{{Lang::get('site.Show All')}}
                                        </span></a>
                                        </li>
                                    </ul>

                                </li>
                            @endif
                            @if(auth()->user()->level == 1 || auth()->user()->level == 3)
                                <li class="sidebar-item"><a class="sidebar-link has-arrow" href="javascript:void(0)"
                                                            aria-expanded="false"><i data-feather="user"
                                                                                     class="feather-icon"></i><span
                                            class="hide-menu">{{Lang::get('site.Customers')}}
                                </span></a>
                                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                                        <li class="sidebar-item"><a href="{{route('addcustomer')}}"
                                                                    class="sidebar-link"><i data-feather="plus"
                                                                                            class="feather-icon"></i><span
                                                    class="hide-menu">{{Lang::get('site.Add New')}}
                                        </span></a>
                                        </li>
                                        <li class="sidebar-item"><a href="{{route('customersinfo')}}"
                                                                    class="sidebar-link"><i data-feather="eye"
                                                                                            class="feather-icon"></i><span
                                                    class="hide-menu">{{Lang::get('site.Show All')}}
                                        </span></a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->level == 1 || auth()->user()->level == 2)
                    <li class="sidebar-item"><a class="sidebar-link" href="{{route('trash')}}"
                                                aria-expanded="false"><i data-feather="trash"
                                                                         class="feather-icon"></i><span
                                class="hide-menu">{{Lang::get('site.Trash')}}
                                </span></a>
                    </li>
                @endif

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>


