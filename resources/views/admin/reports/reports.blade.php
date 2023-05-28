{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script> --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Reporte Entradas</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('admin.exports.inputs') }}" method="GET">
                        <ul class="products-list product-list-in-box">
                            <li class="item">
                                <div class="form-group  ">
                                    <label for="factory" class="col-sm-2 control-label">Empresa</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" id="factory" name="factory" value=""
                                                class="form-control factory" placeholder="Entrada Empresa">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="form-group">
                                    <label for="provider_id" class="col-sm-2  control-label">Producto</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="product_id">
                                            <option value="" selected></option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>
                            {{-- <li class="item">
                                <div class="form-group">
                                    <label for="provider_id" class="col-sm-2  control-label">Usuario</label>
                                    <div class="col-sm-8">
                                        <select class="form-control provider_id select2" style="width: 100%;"
                                            name="user_id">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="form-group">
                                    <label for="provider_id" class="col-sm-2  control-label">Local</label>
                                    <div class="col-sm-8">
                                        <select class="form-control provider_id select2" style="width: 100%;"
                                            name="local_id">
                                            @foreach ($locals as $local)
                                                <option value="{{ $local->id }}">{{ $local->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li> --}}
                            <li class="item">
                                <div class="form-group ">
                                    <label for="date_input" class="col-sm-2  control-label">Fecha Inicio</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                            <input style="width: 110px" type="text" id="date_input" name="date_start"
                                                value="" class="form-control date_input"
                                                placeholder="Entrada Date">
                                        </div>
                                    </div>
                                    <label for="date_input" class="col-sm-2  control-label">Fecha Fin</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-calendar fa-fw"></i></span>
                                            <input style="width: 110px" type="text" id="date_input2" name="date_end"
                                                value="" class="form-control date_input"
                                                placeholder="Entrada Date">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <button class="btn btn-primary" id="report_input">Generar reporte</button>
                            </li>
                            <!-- /.item -->
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Reporte Salidas</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{ route('admin.exports.outputs') }}" method="GET">
                        <ul class="products-list product-list-in-box">
                            {{-- <li class="item">
                                <div class="form-group  ">
                                    <label for="factory" class="col-sm-2 control-label">Empresa</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" id="factory" name="factory" value=""
                                                class="form-control factory" placeholder="Entrada Empresa">
                                        </div>
                                    </div>
                                </div>
                            </li> --}}
                            <li class="item">
                                <div class="form-group">
                                    <label for="provider_id" class="col-sm-2  control-label">Producto</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select2" style="width: 100%;" name="product_id">
                                            <option value="" selected></option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="form-group">
                                    <label for="provider_id" class="col-sm-2  control-label">Usuario</label>
                                    <div class="col-sm-8">
                                        <select class="form-control provider_id select2" style="width: 100%;"
                                            name="user_id">
                                            <option value="" selected></option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="form-group">
                                    <label for="provider_id" class="col-sm-2  control-label">Local</label>
                                    <div class="col-sm-8">
                                        <select class="form-control provider_id select2" style="width: 100%;"
                                            name="local_id">
                                            <option value="" selected></option>
                                            @foreach ($locals as $local)
                                                <option value="{{ $local->id }}">{{ $local->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="form-group ">
                                    <label for="date_input" class="col-sm-2  control-label">Fecha Inicio</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-calendar fa-fw"></i></span>
                                            <input style="width: 110px" type="text" id="date_input"
                                                name="date_start" value="" class="form-control date_input"
                                                placeholder="Entrada Date">
                                        </div>
                                    </div>
                                    <label for="date_input" class="col-sm-2  control-label">Fecha Fin</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-calendar fa-fw"></i></span>
                                            <input style="width: 110px" type="text" id="date_input2"
                                                name="date_end" value="" class="form-control date_input"
                                                placeholder="Entrada Date">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <button class="btn btn-primary" id="report_input">Generar reporte</button>
                            </li>
                            <!-- /.item -->
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {

        $('.select2').select2({
            "allowClear": true,
            "placeholder": {
                "id": "",
                "text": "--Seleccione--"
            }
        });
        $('.date_input').parent().datetimepicker({
            "format": "YYYY-MM-DD",
            "locale": "es",
            "allowInputToggle": true
        });

        // $('#report_input').click(function(e) {
        //     e.preventDefault();
        //     $.ajax({
        //         url: '{{ route('admin.exports.inputs') }}',
        //         method: "GET",
        //         data: { id : 'menuId' },
        //     });
        // })  

    });
</script>
