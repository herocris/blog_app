<!-- Modal -->
<div class="modal fade" id="editpost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{ route('admin.posts.store','#create') }}" method="POST">
         {{ csrf_field() }}
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Titulo de la publicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="form-group ">
                    <input type="text" name="title" id="post_title" class="form-control {{$errors->has('title')? ' is-invalid':''}}" placeholder="Ingrese el titulo de la publicacion (minimo 10 palabras)" autofocus required min="10">
                    {!! $errors->first('title','<span class="help-block">:message</span>')!!}
                </div>
            </div>
            <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
      </div>
    </div>
    </form>
</div>
  <!-- End Modal -->
@push('scripts')
<script>
    if(window.location.hash==='#create'){
    $('#editpost').modal('show');
    }

    $('#editpost').on('hide.bs.modal', function(){//evento de cierre del modal
        window.location.hash='#';
    });

    $('#editpost').on('shown.bs.modal', function(){ //evento de apertura del modal
        $('#post_title').focus();
        window.location.hash='#create';
    });
      </script>
@endpush
