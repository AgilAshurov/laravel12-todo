<h1>Список задач</h1>
<a href="{{ route('tasks.create') }}">Создать задачу</a>

<form method="GET">
    <select name="filter" onchange="this.form.submit()">
        <option value="completed" {{ request('filter') === 'completed' ? 'selected' : '' }}>Выполненные</option>
        <option value="not_completed" {{ request('filter') === 'not_completed' ? 'selected' : '' }}>Невыполненные</option>
    </select>
</form>

<ul>
@foreach($tasks as $task)
    <li>
        {{ $task->title }} ({{ $task->category->title }}) - {{ $task->is_completed ? '✅' : '❌' }}
        @if(!$task->is_completed)
            <form method="POST" action="{{ route('tasks.complete',$task) }}">
                @csrf
                <button>Отметить как выполненную</button>
            </form>
        @endif
    </li>
    @endforeach
</ul>
