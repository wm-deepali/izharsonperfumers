<option value="">Select</option>
@if (isset($attribute_childs) && count($attribute_childs) > 0)
    @foreach ($attribute_childs as $attribute_child)
        <option value="{{ $attribute_child->id }}">{{ $attribute_child->name }}</option>
    @endforeach
@endif
