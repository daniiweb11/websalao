@extends('layouts.app')

@section('content')
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">{{Auth::user()->name}} </div>
      <div class="list-group list-group-flush">
              <!-- <a href="/painel/home"          class="list-group-item list-group-item-action">Home</a> -->
              @if(Auth::user()->acesso == 1)
              <a href="/painel/admin/barbearias"    class="list-group-item list-group-item-action">Barbearias</a>
              <a href="/painel/admin/planos"    class="list-group-item list-group-item-action">Planos</a>
              @endif

              @if(Auth::user()->tipo == 'barbearia')
              <a href="/painel/barbearia/loja"          class="list-group-item list-group-item-action {{request()->routeIs('loja.*') ? 'active' : ''}}">Minha Barbearia</a>
              @if(Auth::user()->barbearia and Auth::user()->barbearia->ativacao == 1)
              <a href="/painel/barbearia/dashboard"  class="list-group-item list-group-item-action {{request()->routeIs('dashboard.*') ? 'active' : ''}}">Dashboard</a>
              <a href="/painel/barbearia/cortes"        class="list-group-item list-group-item-action {{request()->routeIs('cortes.*') ? 'active' : ''}}">Serviços</a>
              <a href="/painel/barbearia/barbeiros"     class="list-group-item list-group-item-action {{request()->routeIs('barbeiros.*') ? 'active' : ''}} ">Profissional</a>
              <a href="/painel/barbearia/agendamentos"  class="list-group-item list-group-item-action {{request()->routeIs('agendamentos.*') ? 'active' : ''}} ">Agendamentos</a>
              <a href="/painel/barbearia/produtos"  class="list-group-item list-group-item-action {{request()->routeIs('produtos.*') ? 'active' : ''}} ">Produtos</a>
              <a href="/painel/barbearia/alerta"  class="list-group-item list-group-item-action {{request()->routeIs('alerta.*') ? 'active' : ''}} ">Alertar</a>
              <!-- <a href="/painel/barbearia/visitantes"    class="list-group-item list-group-item-action">Visitantes</a> -->
              @endif
              @endif

              @if(Auth::user()->tipo == 'cliente')
              <a href="/painel/cliente/perfil"  class="list-group-item list-group-item-action {{request()->routeIs('perfil.*') ? 'active' : ''}}">Perfil</a>
              <a href="/painel/cliente/agendamentos"  class="list-group-item list-group-item-action {{request()->routeIs('agendamentos.*') ? 'active' : ''}}">Agendamentos</a>
              <a href="/painel/cliente/fidelizacao"   class="list-group-item list-group-item-action">Fidelização</a>
              @endif


              @if(Auth::user()->tipo == 'barbeiro')
                @if(Auth::user()->barbeiro)
                <a href="/painel/barbeiro/dashboard"  class="list-group-item list-group-item-action {{request()->routeIs('dashboard.*') ? 'active' : ''}}">Dashboard</a>
                <a href="/painel/barbeiro/hoje"  class="list-group-item list-group-item-action">Agenda Hoje</a>
                <a href="/painel/barbeiro/agendamentos"  class="list-group-item list-group-item-action">Agendamentos</a>
                @endif
              @endif


      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
          <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                  <button class="btn btn-outline-secondary" id="menu-toggle">Menu</button>
                  <a class="btn btn-outline-success" id="menu-toggle" href="/" target="_BLANK">Web Salão</a>



                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
                  </button>

                 <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  <ul class="navbar-nav mr-auto">

                  </ul>

                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ml-auto">
                      <!-- Authentication Links -->
                      @guest
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                          @if (Route::has('register'))
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                              </li>
                          @endif
                      @else
                          <li class="nav-item dropdown">
                              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                  {{ Auth::user()->name }} <span class="caret"></span>
                              </a>

                              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                  <a class="dropdown-item" href="/">
                                    {{ __('Principal') }}
                                  </a>
                                  <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                      {{ __('Logout') }}
                                  </a>

                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                              </div>
                          </li>
                      @endguest
                  </ul>
              </div>
        </nav>

      <div class="container-fluid" style="margin: 10px">
        @include('mensagens.validacoes')
        @include('mensagens.login')

            @yield('categoria')

      </div>
    </div>
    <!-- /#page-content-wrapper -->

@endsection
