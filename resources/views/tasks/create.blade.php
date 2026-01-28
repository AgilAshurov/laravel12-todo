<h1>Создать задачу</h1>
<form method="POST" action="{{ route('tasks.store') }}">
@csrf
<input type="text" name="title" placeholder="Название" value="{{ old('title') }}">
@error('title') <p style="color:red">{{ $message }}</p> @enderror

<textarea name="description" placeholder="Описание">{{ old('description') }}</textarea>

<select name="category_id">
    @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->title }}</option>
    @endforeach
</select>

<button type="submit">Создать</button>
</form>
