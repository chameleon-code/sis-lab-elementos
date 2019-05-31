@extends('components.sections.adminSection')
@section('userContent')
<div class="modal fade animated bounceInLeft" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close cancel-new" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
              <h4 class="modal-title" id="myModalLabel"><i class="fa fa-calendar"></i> Nuevo Horario</h4>
            </div>
            <div class="modal-body">
              
               <form id="horariofrm">
                  <label>Nombre:</label>
                  <input class="form-control" type="text" name="nombre" >
                  <label>Descripción:</label>
                  <textarea class="form-control" name="descripcion" rows="3"></textarea>
                  <label>Dias:</label>
                  <div id="days-list" class="col-sm-12">
                     <a data-day="1" class="day-option">Lunes</a>
                     <a data-day="2" class="day-option">Martes</a>
                     <a data-day="3" class="day-option">Miercoles</a>
                     <a data-day="4" class="day-option">Jueves</a>
                     <a data-day="5" class="day-option">Viernes</a>
                     <a data-day="6" class="day-option">Sabado</a>
                     <a data-day="7" class="day-option">Domingo</a>
                  </div>
                  <input id="days-chose" class="form-control" type="text" name="days" >
                  <label>Inicio:</label>
                  <input class="form-control" type="text" id="time1" name="tiempo1">
                  <label>Final:</label>
                  <input class="form-control" type="text" id="time2" name="tiempo2">
                  <label>Dividir Entre:</label>
                  <select class="form-control" name="minutos">
                      <option></option>
                      <option value="35">35 Minutos</option>
                      <option value="45">45 minutos</option>
                      <option value="60">1 Hora</option>
                  </select>
               </form>
        
            </div>
            <div class="modal-footer">
              <button type="button" class="create-horario btn btn-success"><i class="fa fa-calendar-check-o"></i> Crear</button>
              <button type="button" class="cancel-new btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
            </div>
          </div>
        </div>
        </div>
@endsection