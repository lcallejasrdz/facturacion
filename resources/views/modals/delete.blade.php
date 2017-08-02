<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Eliminar <span id="modalTitle"></span></h4>
      </div>
      <div class="modal-body">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <input type="hidden" name="modalUrl" value="" id="modalUrl">
        <div class="form-group">
          {!!Form::label('name','Nombre')!!}
          <br>
          <span id="modalName"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button value="" id="modalDelete" OnClick='DeleteAction(this);' class='btn btn-danger'><i class="fa fa-btn fa-trash"></i> Eliminar</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->