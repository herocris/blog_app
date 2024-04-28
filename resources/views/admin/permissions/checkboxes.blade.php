@foreach ($permissions as $id => $name)
    <div class="checkbox">
        <label>
            <input type="checkbox" value="{{ $id }}" name="permissions[]"
                {{ $model->permissions->contains($id) || collect(old('permissions'))->contains($id) ? 'checked' : '' }}>
            {{ $name }}
        </label>
    </div>
@endforeach
