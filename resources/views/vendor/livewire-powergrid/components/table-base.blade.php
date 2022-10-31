@props([
'theme' => null
])
<div data-theme="cupcake">
    <table class="table table-compact table-zebra power-grid-table {{ $theme->tableClass }}"
        style="{{$theme->tableStyle}}">
        <thead class="{{$theme->theadClass}}" style="{{$theme->theadStyle}}">
            {{ $header }}
        </thead>
        <tbody class="{{$theme->tbodyClass}}" style="{{$theme->tbodyStyle}}">
            {{ $rows }}
        </tbody>
    </table>
</div>