<div class="x_panel">
    <div>
        <h2 class="collapse-link"><i class="fa fa-filter"></i> Filtro <i class="fa fa-chevron-up pull-right"></i></h2>
    </div>
    <div class="x_content" style="display:none">
        <!-- <form method="get"> -->
        <div class="col-sm-3 col-xs-12">
            <h4>Fecha</h4>
            <div class="checkbox">
                <label><input type="checkbox"
                              value="anytime" {{ ($request->get("date_add") == null) ? "checked" : ""  }}>Cualquier
                    Fecha</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="date_add[]"
                              value="1" {{ ($request->get("date_add") != null && in_array("1", $request->get("date_add"))) ? "checked" : ""  }}>Últimas
                    24 horas</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="date_add[]"
                              value="7" {{ ($request->get("date_add") != null && in_array("7", $request->get("date_add"))) ? "checked" : ""  }}>Últimos
                    7 días</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="date_add[]"
                              value="15" {{ ($request->get("date_add") != null && in_array("15", $request->get("date_add"))) ? "checked" : ""  }}>Últimos
                    15 días</label>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12">
            <h4>Tipo de Contrato</h4>
            <div class="checkbox">
                <label><input type="checkbox" name="contrato[]"
                              value="practice" {{ ($request->get("contrato") != null && in_array("practice", $request->get("contrato"))) ? "checked" : ""  }}>Prácticas</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="contrato[]"
                              value="temporay" {{ ($request->get("contrato") != null && in_array("temporay", $request->get("contrato"))) ? "checked" : ""  }}>Temporal</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="contrato[]"
                              value="indefinite" {{ ($request->get("contrato") != null && in_array("indefinite", $request->get("contrato"))) ? "checked" : ""  }}>Indefinido</label>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12">
            <h4>Jornada</h4>
            <div class="checkbox">
                <label><input type="checkbox" name="work_day[]"
                              value="full day" {{ ($request->get("work_day") != null && in_array("full day", $request->get("work_day"))) ? "checked" : ""  }}>Jornada
                    Completa</label>
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="work_day[]"
                              value="half day" {{ ($request->get("work_day") != null && in_array("half day", $request->get("work_day"))) ? "checked" : ""  }}>Media
                    Jornada</label>
            </div>
        </div>
        <div class="col-sm-3 col-xs-12">
            <h4>Salario</h4>
            <input id="range" name="salario" data-min="0" data-max="{{ $dataMaxSalary }}" data-from="{{ $dataFromSalary }}" data-to="{{ $dataToSalary }}"> 
        </div>
        <div class="col-xs-12">
            <button type="submit" class="form-control">Filtrar</button>
        </div>
        <!-- </form> -->
    </div>
</div>

</div>
<div class="col-xs-9">
    <div class="col-xs-6 text-left">
        <div class="btn-group">
            <a type="button" data-toggle="tab" href="#list" class="btn btn-link"><i
                        style="color: #828282"
                        class="fa fa-list"></i></a>
            <a type="button" data-toggle="tab" href="#menu2" class="btn btn-link"><i style="color: #a4a4a4"
                                                                                     class="fa fa-th-large"></i></a>
        </div>
    </div>
    <div class="col-xs-4 pull-right ">
        <select class="form-control" style="border: 1px solid #fff;" id="sel1">
            <option value="email">Ordenar</option>
            <option value="email">Relevancia</option>
            <option value="email">Nombre A-Z</option>
            <option value="telefono">Nombre Z-A</option>
            <option value="email">Salario más alto</option>
            <option value="telefono">Salario mas bajo</option>
        </select>
    </div>
    <hr>
</div>
