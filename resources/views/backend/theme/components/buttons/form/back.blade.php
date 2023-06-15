<input type="hidden" name="back_to" value="{{ old('back_to') ?: url()->previous() }}">
<a class="btn btn-danger" href="{{ old('back_to') ?: url()->previous() }}"> <i class="fas fa-arrow-left"></i>&nbsp;Back</a>
