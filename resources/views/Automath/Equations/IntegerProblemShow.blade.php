@php($errorClass='')

@if($errors->has('solution.' . $entry->id))
	@php($errorClass='is-invalid')
@endif

<div class="col-lg-4">
	<div class="item">
		@error('solution.' . $entry->id)
			<div class="text-danger p-3 bg-dark">{{ $errors->first('solution.' . $entry->id) }}</div>
		@enderror
		<p>{{ $entry->vars['a'] }} {{ $operand }} {{ $entry->vars['b'] }} = 
		<span class="solution {{ $entry->score === 0 ? 'strike' : '' }}">{{ $entry->solution['x'] }}</span>
		@if($entry->score === 0)
			<span>{{ $entry->getSolver()->getSolution()->get('x') }}</span>
		@endif
		</p>
	</div>
</div>