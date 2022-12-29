@php($errorClass='')

@if($errors->has('solution.' . $entry->id))
	@php($errorClass='is-invalid')
@endif

<table class="automath arithmetics">
	{{--
		<tr>
			<th colspan="2">
				{{ $entry->problem->problemDefinition->solver }}
			</th>
		</tr>
	--}}
	<tr>
		<td></td>
		<td class="term">
			{{ $entry->vars['a'] }}
		</td>
	</tr>
	<tr>
		<td class="operand">
			{{ $operand }}
		</td>
		<td class="term">
			{{ $entry->vars['b'] }}
		</td>
	</tr>
	<tr class="solution-field">
		<td colspan="2">
			<input
				type="text"
				class="form-control {{ $errorClass }}"
				name="solution[{{ $entry->id }}]"
				value="{{ old('solution.' . $entry->id) }}"
			/>
		</td>
	</tr>
	@error('solution.' . $entry->id)
		<tr>
			<td colspan="2">
				<div class="text-danger p-3 bg-dark">{{ $errors->first('solution.' . $entry->id) }}</div>
			</td>
		</tr>
	@enderror
</table>