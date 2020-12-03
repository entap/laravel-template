@if (Admin::user()->id !== $user->id)
    <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
        @csrf
        @method("DELETE")
        <button class="btn btn-danger" onclick="return confirm('本当に削除してもよろしいですか？')">
            削除
        </button>
    </form>
@endif
