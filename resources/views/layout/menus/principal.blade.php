<li {!! Request::is('dashboard') ? 'class="active"' : '' !!}>
    <a href="{{ URL::to('dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
</li>
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
