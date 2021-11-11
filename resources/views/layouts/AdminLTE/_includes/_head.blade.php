<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>
        {!! \App\Models\Config::find(1)->app_name_abv !!} | @yield('title')
</title>
<link rel="shortcut icon" href="{{ asset(\App\Models\Config::find(1)->favicon) }}" type="image/x-icon"/>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/bower_components/select2/dist/css/select2.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/AdminLTE.min.css') }}">
<!-- adminlte Skins. -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/skins/_all-skins.min.css') }}">
<!-- Morris chart -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/bower_components/morris.js/morris.css') }}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
<!-- Date Picker -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<!-- Daterange picker -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/iCheck/square/blue.css') }}">
<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<!-- CSS Custom -->
<link rel="stylesheet" href="{{ asset('assets/custom/style.css') }}">
<!-- jQuery 3 -->
<script src="{{ asset('assets/adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- MAskMoney -->
<script src="{{ asset('assets/plugins/maskMoney/jquery.maskMoney.min.js') }}"></script>
<style>
        .link_menu_page{ color:#222d32; }
        .caixa-alta { text-transform:uppercase; }
        .caixa-baixa { text-transform:lowercase; }
        .input-text-center{ text-align:center; }

        .main-header .logo {
                height: max-content;
        }
        .form-group {
                margin-bottom: 15px;
                display: flex;
                align-items: baseline;
        }
        label {
                min-width: 20%;
                margin-right: 10px;
                font-weight: 400;
        }
        .edit-company-info {
                min-width: 5%;
                text-align: center;
                cursor: pointer;
                display: flex;
                justify-content: center;
        }
        .company-info-item, .company-info-item-edit {
                width: 75%;
        }
        .company-info-item-edit {
                display: none;
        }
        .company-info {
                border-bottom: 1px solid #3c8dbc;
                border-left: 1px solid #3c8dbc;
                border-right: 1px solid #3c8dbc;
        }
        .company-info .form-group {
                margin: 15px 0;
        }
        .box-body {
                padding: 20px;
        }
        .box {
                border: none;
                background: transparent;
        }
        .title-block {
                border-bottom: 1px solid #3c8dbc;
                padding: 10px;
        }
        .user-info-block {
                border: 1px solid #3c8dbc;
                margin-bottom: 30px;
        }
        .user-info-block form {
                padding: 10px;
        }
        .user-info-block  .role-block {
                padding: 10px;
                border: 1px solid #3c8dbc;
                max-height: 200px;
                height: 200px;
                overflow: auto;
                margin: 10px;
        }
        .users-block .table>thead:first-child>tr:first-child>th, 
        .roles-block .table>thead:first-child>tr:first-child>th {
                border-bottom: 1px solid #3c8dbc;
        }
        .users-block .table-bordered>thead>tr>th, .users-block .table-bordered>tbody>tr>th, 
        .users-block .table-bordered>tfoot>tr>th, .users-block .table-bordered>thead>tr>td, 
        .users-block .table-bordered>tbody>tr>td, .users-block .table-bordered>tfoot>tr>td,
        .users-block .table-bordered, 
        .roles-block .table-bordered>thead>tr>th, .roles-block .table-bordered>tbody>tr>th, 
        .roles-block .table-bordered>tfoot>tr>th, .roles-block .table-bordered>thead>tr>td, 
        .roles-block .table-bordered>tbody>tr>td, .roles-block .table-bordered>tfoot>tr>td,
        .roles-block .table-bordered {
                border: none;
        }
        .users-block .table-bordered>tbody>tr:first-child>td, 
        .roles-block .table-bordered>tbody>tr:first-child>td {
                padding-top: 10px;
        }
        .custom-fields-block, .default-fields-block {
                margin-top: 60px;
        }
        .custom-fields-block .main-content, .default-fields-block .main-content {
                display: flex;
                justify-content: center;
                flex-direction: column;
                text-align: center;
        }
        .custom-fields-block .customizing-block, .default-fields-block .default-block {
                border: 1px solid #3c8dbc;
                width: 400px;
                margin: 5px auto;
                padding: 20px;
                color: black;
        }
        .currency_input {
                background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='16px' width='85px'><text x='2' y='13' fill='gray' font-size='12' font-family='arial'>$</text></svg>");
                background-repeat: no-repeat;
                background-position-y: center;
                background-position-x: 8px;
                background-size: 110px;
                padding-left: 28px;
        }
</style>

<script>
        $(function(){
                $.fn.datepicker.dates['pt-br'] = {
                        days: ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"],
                        daysShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
                        daysMin: ["Do", "Se", "Te", "Qu", "Qu", "Se", "Sa"],
                        months: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"],
                        monthsShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
                        today: "Hoje",
                        monthsTitle: "Meses",
                        clear: "Limpar",
                        format: "dd/mm/yyyy"
                };
        });
</script>       

@yield('layout_css')