@php($errorClass='')

@if($errors->has('solution.' . $entry->id))
	@php($errorClass='is-invalid')
@endif

<div class="col-lg-4">
	<div class="item">
		@error('solution.' . $entry->id)
			<div class="text-danger p-3 bg-dark">{{ $errors->first('solution.' . $entry->id) }}</div>
		@enderror
		<p>{{ $entry->vars['a'] }} {{ $operand }} {{ $entry->vars['b'] }} = <input
			type="text"
			class="form-control {{ $errorClass }}"
			name="solution[{{ $entry->id }}]"
			value="{{ old('solution.' . $entry->id) }}"
			style="width: 100%; display: inline"
		>
		</p>
	</div>
</div>