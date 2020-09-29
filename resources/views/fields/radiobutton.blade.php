@component($typeForm, get_defined_vars())
    <div data-controller="fields--radiobutton">
        <div class="btn-group btn-group-toggle p-0" data-toggle="buttons">

            @foreach($options as $key => $option)
                @php
                    $iteration = $loop->iteration;
                @endphp
                <input
                       @foreach($attributes as $a_key => $attribute)
                            @if($a_key=='id')
                                id="{{$attribute.'-'.$iteration}}"
                            @else
                                {{is_null($attribute)?$a_key:$a_key.'='.$attribute }}
                            @endif
                        @endforeach
                       @if($active($key, $value)) checked @endif
                       value="{{ $key }}"
                >
                <label class="btn btn-default @if($active($key, $value)) active @endif"
                       data-action="click->fields--radiobutton#checked"
                       for="{{ $attributes['id'].'-'.$iteration }}"
                >
                    {{ $option }}</label>
            @endforeach
        </div>
    </div>
@endcomponent
