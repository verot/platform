<div class="dropdown d-inline-block">
    <button class="btn btn-sm btn-link dropdown-toggle"
            type="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            data-boundary="viewport"
            aria-expanded="false">
        <x-orchid-icon path="filter"/>
    </button>
    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
        <div class="py-2 px-3">

            <input class="d-none" name="filter[{{$column}}]"
                   data-controller="datetime"
                   data-datetime-inline="true"
                   value="{{get_filter_string($column)}}"
                   form="filters"
                   placeholder="{{ __('Filter') }}"
            >

            <div class="line line-dashed border-bottom my-3"></div>
            <button type="submit" form="filters" class="btn btn-default btn-sm w-100">{{__('Apply')}}</button>
        </div>
    </div>
</div>
