        <div class="sidebar" data-image="{{asset('Dashboard/assets/img/sidebar-5.jpg')}}" style="float: right;
        text-align: right;
        right: 0;
        left: unset;">
            <div class="sidebar-wrapper">
                <div class="logo" style="font-weight: bold">
                    <a href="#" class="simple-text">
                        <img src="{{asset('img/images/icon_01.png')}}" alt="" width="100px"><br/> <span style="display:block;margin-top: 5px"> لوحة التحكم</span>
                    </a>
                </div>
                <ul class="nav">
                    <li class="{{ Request::segment(2) == 'categories' ? 'active' : null }}">
                        <a class="nav-link" href="{{route('admin.categories.index')}}">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>الاقسام</p>
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) == 'news' ? 'active' : null }}">
                        <a class="nav-link" href="{{route('admin.news.index')}}">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>محتوي الاقسام</p>
                        </a>
                    </li>
                    {{-- <li class="{{ Request::segment(2) == 'video' ? 'active' : null }}">
                        <a class="nav-link" href="{{route('admin.video.index')}}">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>الفيديوهات</p>
                        </a>
                    </li> --}}
                    {{-- <li class="{{ Request::segment(2) == 'users' ? 'active' : null }}">
                        <a class="nav-link" href="{{route('admin.users.index')}}">
                            <i class="nc-icon nc-single-02"></i>
                            <p>المستخدمين</p>
                        </a>
                    </li>
                    <li class="{{ Request::segment(2) == 'logger' ? 'active' : null }}">
                        <a class="nav-link" href="{{route('admin.logger')}}">
                            <i class="nc-icon nc-single-02"></i>
                            <p>احصاء الدخول</p>
                        </a>
                    </li> --}}
                 </ul>
              
            </div>
        </div>
