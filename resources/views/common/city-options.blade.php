<option value="" selected>Select</option>
@if (isset($cities) && count($cities) > 0)
    @foreach ($cities as $city)
        <option value="{{ $city->id }}">{{ $city->name }}</option>
    @endforeach
@endif
