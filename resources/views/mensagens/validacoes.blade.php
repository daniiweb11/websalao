@if (session('success'))
    <div id="message" class="errmsg">
        <div class="alert alert-success alert-success"  class="errmsgdiv" >
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{ session('success') }}
      </div>
    </div>
@endif
@if (session('error'))
    <div id="message" class="errmsg">
        <div class="alert alert-danger alert-danger"  class="errmsgdiv" >
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        {{ session('error') }}
      </div>
    </div>
@endif
