<div class="row">
    {{ csrf_field() }}
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Datos de Rol</h3>
            </div>
            <div class="card-body">
                @include('admin.partials.error-messages')
                <div class="form-group">
                    <label>Identificador: </label>
                    @if($role->exists)
                    <input type="text" value="{{ $role->name }}" class="form-control" disabled>
                    @else
                    <input type="text" name="name" value="{{ old('name',$role->name) }}" class="form-control">
                    @endif
                </div>
                <div class="form-group">
                    <label>Titulo: </label>
                    <input type="text" name="display_name" value="{{ old('display_name',$role->display_name) }}" class="form-control">
                </div>
               {{--
                <div class="form-group">
                    <label>Guardian: </label>
                  <select class="form-control" name="guard_name">
                      @foreach (config('auth.guards') as $key => $guard )
                          <option {{old('guard_name',$role->guard_name)===$key?'selected':''}}>{{$key}}</option>
                      @endforeach
                  </select>
                </div>
                --}}
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Permisos</h3>
            </div>
            <div class="card-body">
                @include('admin.permissions.checkboxes',['model' => $role])
            </div>
        </div>
    </div>
</div>
