<tr>
    @foreach($columns as $column)

        <td class="p-0 align-middle">
            {!!
               $fields[$column]
                    ->value($row[$column] ?? '')
                    ->prefix($name)
                    ->id("$column-$key-$column")
                    ->name($keyValue ? $column : "[$key][$column]")
            !!}
        </td>

        @if ($loop->last)
            <td class="no-border text-center align-middle">
                <a href="#"
                   data-action="fields--matrix#deleteRow"
                   class="text-xs text-muted"
                   title="Remove row">
                    <x-orchid-icon path="trash"/>
                </a>
            </td>
        @endif
    @endforeach
</tr>
