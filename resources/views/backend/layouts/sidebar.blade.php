<div class="navigation">
    <ul>
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="w-100">
                    <img src="{{ asset('assets/KONI.png') }}" alt="{{ asset('assets/KONI.png') }}"
                        class="img-fluid mx-auto d-block p-2 border-bottom border-space" width="80" height="auto">
                </div>
            </a>
        </li>
    </ul>
    @can('dashboard')
        <ul class="d-none">
            <li class="{{ set_active('dashboard') }}">
                <a href="{{ route('dashboard') }}">
                    <span class="icon material-icons md-light">dashboard</span>
                    <span class="title-bar">Beranda</span>
                </a>
            </li>
        </ul>
    @endcan
    <!-- Start new menu -->
    @role('superadmin|adminutama|koni')
    @can('sportbranch-list')
    <ul>
        <li class="{{ set_active('sport-branch.index') }}">
            <a href="{{ route('sport-branch.index') }}">
                <span class="icon material-icons md-light">pix</span>
                <span class="title-bar">Cabang Olahraga</span>
            </a>
        </li>
    </ul>
    @endcan
    @endrole
    @if (Auth::user()->sports->id || Auth::user()->team_support->sports_id)
    @canany(['sportbranch-list', 'atlet-list', 'trainer-list', 'judge-list', 'club-list'])
    <ul>
        <li>
            <a href="#pageSubMenuAtlet" data-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
                <span class="icon material-icons md-light">api</span>
                <span class="title-bar">Cabor</span>
            </a>
            <ul class="collapse list-unstyled bg-dark pageSubmenu" id="pageSubMenuAtlet">
                @can('atlet-list')
                @if (Auth::user()->sports->id)    
                <li class="{{ set_active('sport-branch.atlet.*') }} pl-3">
                    <a href="{{ route('sport-branch.atlet.index', Auth::user()->sports->id) }}">
                        <span class="icon material-icons md-light">directions_run</span>
                        <span class="title-bar">Atlet</span>
                    </a>
                </li>
                @else
                <li class="{{ set_active('sport-branch.atlet.*') }} pl-3">
                    <a href="{{ route('sport-branch.atlet.index', Auth::user()->team_support->sports_id) }}">
                        <span class="icon material-icons md-light">directions_run</span>
                        <span class="title-bar">Atlet</span>
                    </a>
                </li>
                @endif
                @endcan

                @can('trainer-list')
                
                @if (Auth::user()->sports->id)    
                <li class="{{ set_active('sport-branch.trainer.*') }} pl-3">
                    <a href="{{ route('sport-branch.trainer.index', Auth::user()->sports->id) }}">
                        <span class="icon material-icons md-light">sports</span>
                        <span class="title-bar">Pelatih</span>
                    </a>
                </li>
                @else
                <li class="{{ set_active('sport-branch.trainer.*') }} pl-3">
                    <a href="{{ route('sport-branch.trainer.index', Auth::user()->team_support->sports_id) }}">
                        <span class="icon material-icons md-light">sports</span>
                        <span class="title-bar">Pelatih</span>
                    </a>
                </li>
                @endif
                @endcan

                @can('judge-list')
                @if (Auth::user()->sports->id)
                <li class="{{ set_active('sport-branch.judge.*') }} pl-3">
                    <a href="{{ route('sport-branch.judge.index', Auth::user()->sports->id) }}">
                        <span class="icon material-icons md-light">adjust</span>
                        <span class="title-bar">Wasit & Juri</span>
                    </a>
                </li>
                @else
                <li class="{{ set_active('sport-branch.judge.*') }} pl-3">
                    <a href="{{ route('sport-branch.judge.index', Auth::user()->team_support->sports_id) }}">
                        <span class="icon material-icons md-light">adjust</span>
                        <span class="title-bar">Wasit & Juri</span>
                    </a>
                </li>
                @endif
                @endcan

                @if (Auth::user()->sports->id)
                <li class="{{ set_active('sport-branch.nomor.*') }} pl-3">
                    <a href="{{ route('sport-branch.nomor.index', Auth::user()->sports->id) }}">
                        <span class="icon material-icons md-light">confirmation_number</span>
                        <span class="title-bar">Nomor Pertandingan</span>
                    </a>
                </li>
                @else
                <li class="{{ set_active('sport-branch.nomor.*') }} pl-3">
                    <a href="{{ route('sport-branch.nomor.index', Auth::user()->team_support->sports_id) }}">
                        <span class="icon material-icons md-light">confirmation_number</span>
                        <span class="title-bar">Nomor Pertandingan</span>
                    </a>
                </li>
                @endif

                @role('cabor')
                <li class="{{ set_active('sport-branch.show') }} pl-3">
                    <a href="{{ route('sport-branch.profile', Auth::user()->sports->id) }}">
                        <span class="icon material-icons md-light">person_pin</span>
                        <span class="title-bar">Profile</span>
                    </a>
                </li>
                @endrole

                @can('club-list')
                @if (Auth::user()->sports->id)
                <li class="{{ set_active('sport-branch.clubs.*') }} pl-3">
                    <a href="{{ route('sport-branch.clubs.index', Auth::user()->sports->id) }}">
                        <span class="icon material-icons md-light">corporate_fare</span>
                        <span class="title-bar">Klub</span>
                    </a>
                </li>
                @else
                <li class="{{ set_active('sport-branch.clubs.*') }} pl-3">
                    <a href="{{ route('sport-branch.clubs.index', Auth::user()->team_support->sports_id) }}">
                        <span class="icon material-icons md-light">corporate_fare</span>
                        <span class="title-bar">Klub</span>
                    </a>
                </li>
                @endif
                @endcan
            </ul>
        </li>
    </ul>
    @endcanany
    @endif

    @role('club')
    <ul>
        <li>
            <a href="#pageSubMenuClub" data-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
                <span class="icon material-icons md-light">corporate_fare</span>
                <span class="title-bar">Klub</span>
            </a>
            <ul class="collapse list-unstyled bg-dark pageSubmenu" id="pageSubMenuClub">
                @can('atlet-list')
                <li class="{{ set_active('club.atlet.*') }} pl-3">
                    <a href="{{ route('club.atlet.index', Auth::user()->clubs->id) }}">
                        <span class="icon material-icons md-light">groups</span>
                        <span class="title-bar">Anggota</span>
                    </a>
                </li>
                @endcan
                @can('trainer-list')
                <li class="{{ set_active('club.trainer.*') }} pl-3">
                    <a href="{{ route('club.trainer.index', Auth::user()->clubs->id) }}">
                        <span class="icon material-icons md-light">sports</span>
                        <span class="title-bar">Pelatih</span>
                    </a>
                </li>
                @endcan
                @can('judge-list')
                <li class="{{ set_active('club.judge.*') }} pl-3">
                    <a href="{{ route('club.judge.index', Auth::user()->clubs->id) }}">
                        <span class="icon material-icons md-light">adjust</span>
                        <span class="title-bar">Wasit & Juri</span>
                    </a>
                </li>
                @endcan
                <li class="{{ set_active('club.profile') }} pl-3">
                    <a href="{{ route('club.profile', Auth::user()->clubs->id) }}">
                        <span class="icon material-icons md-light">person_pin</span>
                        <span class="title-bar">Profile</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    @endrole

    @canany(['news-topnews-list','news-requestnews-list','category-news-list','news-newsscheduled-list','gallery-list'])
    <ul>
        <li>
            <a href="#pageSubMenuMedia" data-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
                <span class="icon material-icons md-light">movie</span>
                <span class="title-bar">Media</span>
            </a>
            <ul class="collapse list-unstyled bg-dark pageSubmenu" id="pageSubMenuMedia">
                @canany(['news-topnews-list','news-requestnews-list'])
                <li class="pl-3">
                    <a href="#pageSubMenuMediaToNews" data-toggle="collapse" class="dropdown-toggle"
                        aria-expanded="false">
                        <span class="icon material-icons md-light">feed</span>
                        <span class="title-bar">Berita</span>
                    </a>
                    <ul class="collapse list-unstyled bg-dark pageSubmenu" id="pageSubMenuMediaToNews">
                        @can('news-topnews-list')
                        <li class="pl-3 {{ set_active('tidings.*') }}">
                            <a href="{{ route('tidings.index') }}">
                                <span class="icon material-icons md-light">feed</span>
                                <span class="title-bar">Berita</span>
                            </a>
                        </li>
                        @endcan
                        @can('news-requestnews-list')
                        <li class="pl-3 {{ set_active('tidings-request.*') }}">
                            <a href="{{ route('tidings-request.index') }}">
                                <span class="icon material-icons md-light">request_quote</span>
                                <span class="title-bar">Request Berita</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
                <li class="pl-3 d-none">
                    <a href="#">
                        <span class="icon material-icons md-light">join_inner</span>
                        <span class="title-bar">Pertandigan</span>
                    </a>
                </li>
                @can('category-news-list')
                <li class="pl-3 {{ set_active('tidings-category.*') }}">
                    <a href="{{ route('tidings-category.index') }}">
                        <span class="icon material-icons md-light">category</span>
                        <span class="title-bar">Kategori Berita</span>
                    </a>
                </li>
                @endcan
                @can('gallery-list')
                @if (Auth::user()->sports->id)
                <li class="{{ set_active('sport-branch.photo-gallery.*') }}">
                    <a href="{{ route('sport-branch.photo-gallery.index', Auth::user()->sports->id) }}">
                        <span class="icon material-icons md-light">collections</span>
                        <span class="title-bar">Galeri</span>
                    </a>
                </li>   
                @elseif (Auth::user()->team_support->sports_id)
                <li class="{{ set_active('sport-branch.photo-gallery.*') }}">
                    <a href="{{ route('sport-branch.photo-gallery.index', Auth::user()->team_support->sports_id) }}">
                        <span class="icon material-icons md-light">collections</span>
                        <span class="title-bar">Galeri</span>
                    </a>
                </li>   
                @else
                <li class="{{ set_active('photo-gallery.index') }}">
                    <a href="{{ route('photo-gallery.index') }}">
                        <span class="icon material-icons md-light">collections</span>
                        <span class="title-bar">Galeri</span>
                    </a>
                </li>
                @endif
                @endcan
            </ul>
        </li>
    </ul>
    @endcanany

    @can('calendar-list')
    <ul>
        <li class="{{ set_active('calendar-activitie.index') }}">
            <a href="{{ route('calendar-activitie.index') }}">
                <span class="icon material-icons md-light">event</span>
                <span class="title-bar">Event</span>
            </a>
        </li>
    </ul>
    @endcan

    <ul class="d-none">
        <li class="">
            <a href="#">
                <span class="icon material-icons md-light">calendar_view_day</span>
                <span class="title-bar">Monev</span>
            </a>
        </li>
    </ul>
    @role('cabor')
    <ul>
        <li class="{{ set_active('sport-branch.team-support.*') }}">
            <a href="{{ route('sport-branch.team-support.index', Auth::user()->sports->id) }}">
                <span class="icon material-icons md-light">recent_actors</span>
                <span class="title-bar">Tim Support Cabor</span>
            </a>
        </li>
    </ul>
    <ul>
        <li class="{{ set_active('sport-branch.role-permission.*') }}">
            <a href="{{ route('sport-branch.role-permission.index', Auth::user()->sports->id) }}">
                <span class="icon material-icons md-light">perm_identity</span>
                <span class="title-bar">Peran</span>
            </a>
        </li>
    </ul>
    @endrole
    @role('superadmin|adminutama|koni')
    <ul>
        <li>
            <a href="#pageSubMenuSetting" data-toggle="collapse" class="dropdown-toggle" aria-expanded="false">
                <span class="icon material-icons md-light">settings_suggest</span>
                <span class="title-bar">Penggaturan</span>
            </a>
            <ul class="collapse list-unstyled bg-dark pageSubmenu" id="pageSubMenuSetting">
                @can('admin-list')
                <li class="{{ set_active('admin.index') }} pl-3">
                    <a href="{{ route('admin.index') }}">
                        <span class="icon material-icons md-light">recent_actors</span>
                        <span class="title-bar">Pengguna</span>
                    </a>
                </li>
                @endcan
                @can('rolepermisson-list')
                <li class="{{ set_active('rolepermission.index') }} pl-3">
                    <a href="{{ route('rolepermission.index') }}">
                        <span class="icon material-icons md-light">perm_identity</span>
                        <span class="title-bar">Peran</span>
                    </a>
                </li>
                @endcan
                @can('general-setting-list')
                <li class="{{ set_active('settings.*') }} pl-3">
                    <a href="{{ route('settings.index') }}">
                        <span class="icon material-icons md-light">emergency</span>
                        <span class="title-bar">Umum</span>
                    </a>
                </li>
                @endcan
                @can('landing-page-setting-list')
                <li class="{{ set_active('set-landing-page.*') }} pl-3">
                    <a href="{{ route('set-landing-page.index') }}">
                        <span class="icon material-icons md-light">desktop_windows</span>
                        <span class="title-bar">Website</span>
                    </a>
                </li>
                @endcan
                @can('privacy-policy-setting-list')
                <li class="{{ set_active('set-privacy-policy.*') }} pl-3">
                    <a href="{{ route('set-privacy-policy.index') }}">
                        <span class="icon material-icons md-light">policy</span>
                        <span class="title-bar">Privacy & policy</span>
                    </a>
                </li>
                @endcan
                <li class="pl-3 d-none">
                    <a href="#pageSubMenuSettingToDataCategory" data-toggle="collapse" class="dropdown-toggle"
                        aria-expanded="false">
                        <span class="icon material-icons md-light">category</span>
                        <span class="title-bar">Data Kategori</span>
                    </a>
                    <ul class="collapse list-unstyled bg-dark pageSubmenu" id="pageSubMenuSettingToDataCategory">
                        <li class="{{ set_active('employ.*') }} pl-3">
                            <a href="{{ route('employ.index') }}">
                                <span class="icon material-icons md-light">radar</span>
                                <span class="title-bar">Jabatan</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    @endrole

    <ul class="d-none">
        <li class="">
            <a href="#">
                <span class="icon material-icons md-light">person_pin</span>
                <span class="title-bar">Profil</span>
            </a>
        </li>
    </ul>
    <!-- end new menu -->
    <ul>
        <li>
            <a href="{{ route('logout') }}">
                <span class="icon material-icons md-light">logout</span>
                <span class="title-bar">Sign Out</span>
            </a>
        </li>
    </ul>
</div>
