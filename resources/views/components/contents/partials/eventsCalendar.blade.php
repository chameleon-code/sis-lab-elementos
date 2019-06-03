<div>
    <div class="col-md-8" id="calendar"></div>
    <br>
        <div class="col-md-4">
        <a href="#" data-target="#appModal" title="Añadir Evento" data-id="" id="addEvent" class="btn btn-primary">Añadir</a>
    </div>
</div>
{{-- Modal --}}
<div class="modal fade" id="appModal" tabindex="-1" role="dialog" aria-labelledby="appModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form action="" id="registerEvent">
                    <label for="start" class="control-label">Fecha:</label>
                    <input type="text" name="start" id="start" class="form-control" />
                    <label for="end" class="control-label">Hora:</label>
                    <input type="time" name="hour" id="hour" class="form-control"/>
                    <label for="description" class="control-label">Descripcion:</label>
                    <textarea class="form-control" name="description" id="description" ></textarea>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="modalAction"></button>
            </div>
        </div>
    </div>
</div>