<div class="form-group">
    <label for="select__{{ $name }}">{{ $label }}</label>
    <select class="form-control" id="select__{{ $name }}" name="{{ $name }}">
        @spaceless
        @foreach($relation_data as $item)
            <option
                    value="{{ $item->{$foreign_key} }}"
                    @if($item->{$foreign_key} == $value)
                        selected
                    @endif
            >
                {{ $item->{$foreign_field} }}
            </option>
        @endforeach
        @endspaceless
    </select>
</div>