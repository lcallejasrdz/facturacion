<li {!! Request::is('dashboard') ? 'class="active"' : '' !!}>
    <a href="{{ URL::to('dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
</li>

@if(Auth::user()->permission == 1 || Auth::user()->permission == 2)
    <li {!! Request::is('users') || Request::is('users/*') ? 'class="active"' : '' !!}>
        <a href="javascript:;" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-user"></i> Usuarios <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="users" class="collapse">
            <li>
                <a href="{{ URL::to('users') }}">Lista de Usuarios</a>
            </li>
            <li>
                <a href="{{ URL::to('users/create') }}">Agregar Usuario</a>
            </li>
            <li>
                <a href="{{ URL::to('users/deleted') }}">Usuarios Eliminados</a>
            </li>
        </ul>
    </li>

    <li {!! Request::is('companies') || Request::is('companies/*') ? 'class="active"' : '' !!}>
        <a href="javascript:;" data-toggle="collapse" data-target="#companies"><i class="fa fa-fw fa-building"></i> Empresas <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="companies" class="collapse">
            <li>
                <a href="{{ URL::to('companies') }}">Lista de Empresas</a>
            </li>
            <li>
                <a href="{{ URL::to('companies/create') }}">Agregar Empresa</a>
            </li>
            <li>
                <a href="{{ URL::to('companies/deleted') }}">Empresas Eliminados</a>
            </li>
        </ul>
    </li>
@endif

<li {!! Request::is('directs-movements') || Request::is('directs-movements/*') ? 'class="active"' : '' !!}>
    <a href="javascript:;" data-toggle="collapse" data-target="#directs-movements"><i class="fa fa-fw fa-file-text"></i> Movimientos Directos <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="directs-movements" class="collapse">
        <li>
            <a href="{{ URL::to('directs-movements') }}">Lista de Movimientos Directos</a>
        </li>
        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 3 || Auth::user()->permission == 5)
            <li>
                <a href="{{ URL::to('directs-movements/show-finished') }}">Lista de Movimientos Directos Finalizados</a>
            </li>
        @endif
        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 5)
            <li>
                <a href="{{ URL::to('directs-movements/create') }}">Agregar Movimiento Directo</a>
            </li>
        @endif
    </ul>
</li>

<li {!! Request::is('simples-movements') || Request::is('simples-movements/*') ? 'class="active"' : '' !!}>
    <a href="javascript:;" data-toggle="collapse" data-target="#simples-movements"><i class="fa fa-fw fa-file-text"></i> Movimientos Simples <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="simples-movements" class="collapse">
        <li>
            <a href="{{ URL::to('simples-movements') }}">Lista de Movimientos Simples</a>
        </li>
        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 3 || Auth::user()->permission == 5)
            <li>
                <a href="{{ URL::to('simples-movements/show-finished') }}">Lista de Movimientos Simples Finalizados</a>
            </li>
        @endif
        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 5)
            <li>
                <a href="{{ URL::to('simples-movements/create') }}">Agregar Movimiento Simple</a>
            </li>
        @endif
    </ul>
</li>

<li {!! Request::is('payrolls-movements') || Request::is('payrolls-movements/*') ? 'class="active"' : '' !!}>
    <a href="javascript:;" data-toggle="collapse" data-target="#payrolls-movements"><i class="fa fa-fw fa-file-text"></i> Movimientos Nóminas <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="payrolls-movements" class="collapse">
        <li>
            <a href="{{ URL::to('payrolls-movements') }}">Lista de Movimientos Nóminas</a>
        </li>
        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 3 || Auth::user()->permission == 5)
            <li>
                <a href="{{ URL::to('payrolls-movements/show-finished') }}">Lista de Movimientos Nóminas Finalizados</a>
            </li>
        @endif
        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 5)
            <li>
                <a href="{{ URL::to('payrolls-movements/create') }}">Agregar Movimiento Nómina</a>
            </li>
        @endif
    </ul>
</li>

<li {!! Request::is('lendings') || Request::is('lendings/*') ? 'class="active"' : '' !!}>
    <a href="javascript:;" data-toggle="collapse" data-target="#lendings"><i class="fa fa-fw fa-file-text"></i> Préstamos <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="lendings" class="collapse">
        <li>
            <a href="{{ URL::to('lendings') }}">Lista de Préstamos</a>
        </li>
        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 3 || Auth::user()->permission == 5)
            <li>
                <a href="{{ URL::to('lendings/show-finished') }}">Lista de Préstamos Finalizados</a>
            </li>
        @endif
        @if(Auth::user()->permission == 1 || Auth::user()->permission == 2 || Auth::user()->permission == 5)
            <li>
                <a href="{{ URL::to('lendings/create') }}">Agregar Préstamo</a>
            </li>
        @endif
    </ul>
</li>

{{-- <li>
    <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
</li>
<li>
    <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
</li>
<li>
    <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
</li>
<li>
    <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
</li>
<li>
    <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
</li>
<li>
    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
    <ul id="demo" class="collapse">
        <li>
            <a href="#">Dropdown Item</a>
        </li>
        <li>
            <a href="#">Dropdown Item</a>
        </li>
    </ul>
</li>
<li>
    <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
</li>
<li>
    <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
</li> --}}
