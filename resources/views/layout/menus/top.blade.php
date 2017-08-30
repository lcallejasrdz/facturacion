<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }} <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li>
            <a href="{!! URL::to('users/'.Auth::user()->id) !!}"><i class="fa fa-fw fa-user"></i> Perfil</a>
        </li>
        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2)
            <li>
                <a href="{!! URL::to('users/'.Auth::user()->id.'/edit') !!}"><i class="fa fa-fw fa-gear"></i> Editar Perfil</a>
            </li>
        @endif
        <li class="divider"></li>
        <li>
            <a href="{{ URL::to('logout') }}"><i class="fa fa-fw fa-power-off"></i> Logout</a>
        </li>
    </ul>
</li>
