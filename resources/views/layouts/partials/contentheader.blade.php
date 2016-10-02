<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        @yield('contentheader_title', 'Page Header here')
        <small>@yield('contentheader_description')</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('adminlte_lang::message.level') }}</a></li>
        <li class="active">{{ trans('adminlte_lang::message.here') }}</li>
    </ol>
</section>

@if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class', 'alert-info') }} fade in notification-app">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>Flash message</h4>
        <p>{{ Session::get('message') }}</p>
    </div>
@endif


<section id="notification" class="center-block"></section>