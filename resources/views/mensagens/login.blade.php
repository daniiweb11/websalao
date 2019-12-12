
@if(isset($_GET['login']))
  <div id="message" class="errmsg">
        <div class="alert alert-success alert-success"  class="errmsgdiv" >
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            Login efetuado com sucesso!<b> Acesse seu <a href="{{ url('/painel/home') }}">painel</a>.</b>
        </div>
    </div>
@endif
@error('email')
    <div id="message"  class="errmsg">
        <div class="alert alert-danger alert-dismissable" class="errmsgdiv" >
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            Login ou senha incorreta!
        </div>
    </div>
@enderror
