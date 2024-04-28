@extends('admin.layout')


@section('content')
    <div class="row">
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="/img/{{$user->photo}}" alt="Foto de {{$user->name}}">
              </div>

              <h3 class="profile-username text-center">{{ $user->name }}</h3>

              <p class="text-muted text-center">{{ $user->getRolenames()->implode(', ') }}</p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Correo</b> <a class="float-right">{{ $user->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Publicaciones</b> <a class="float-right">{{ $user->posts->count() }}</a>
                </li>
                @if($user->roles->count())
                <li class="list-group-item">
                    <b>Privilegios</b> <a class="float-right">{{ $user->getRoleNames()->implode(', ') }}</a>
                  </li>
                @endif
              </ul>

              <a href="{{route('admin.users.edit',$user)}}" class="btn btn-primary btn-block"><b>Modificar</b></a>
            </div>
            <!-- /.card-body -->
          </div>
    </div>
    <!--<div class="col-md-3">
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Publicaciones</h3>
            </div>
            <div class="card-body">
                @forelse ($user->posts as $post)
                     <a href="{{ route('posts.show',$post)}}" target="_blank">
                        <strong>{{$post->title}}</strong>
                    </a><br>
                    <small class="text muted">Publicado el {{$post->published_at->format('d/m/Y')}}</small>
                 @unless ($loop->last)
                    <hr>
                 @endunless
                 @empty
                 <small class="text muted">No tiene publicaciones creadas.</small>
                @endforelse
            </div>
        </div>

    </div>-->
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Roles</h3>
            </div>
            <div class="card-body">
                @forelse($user->roles as $role)
                        <strong>{{$role->name}}</strong>
                        @if($role->permissions->count())
                        <br>
                    <small class="text muted">Permisos: {{$role->permissions->pluck('name')->implode(', ')}}</small>
                        @endif

                 @unless ($loop->last)
                    <hr>
                 @endunless
                 @empty
                 <small class="text muted">No tiene ningun rol asociado.</small>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-header with-border">
                <h3 class="card-title">Permisos adicionales</h3>
            </div>
            <div class="card-body">
                @forelse($user->permissions as $permission)
                        <strong>{{$permission->name}}</strong>
                        <br>
                 @unless ($loop->last)
                    <hr>
                 @endunless
                 @empty
                 <small class="text muted">No tiene permisos adicionales.</small>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
