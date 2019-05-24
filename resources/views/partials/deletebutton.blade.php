
    <form method="POST" action="{{ route('articles.delete', ['id' => $article->id]) }}">
        @csrf
        @method('DELETE')
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Delete') }}
                </button>
            </div>
        </div>
    </form>