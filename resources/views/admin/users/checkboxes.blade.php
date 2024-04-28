@foreach ($categories as $category)
<div class="checkbox">
    <label>
        <input type="checkbox" value="{{ $category->id }}" name="categories[]"
            {{ $user->categories->contains($category->id) ? 'checked' : '' }}>
        {{ $category->name }}
    </label>
</div>
@endforeach