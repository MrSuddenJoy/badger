<div class="grid">

    @section('header')
        @if ($add_url):
            <div class="pull-left">
                <a class="btn btn-default btn-add" href="{{ $add_url }}">
                    <i class="fa fa-plus"></i>
                    {{ $add_label ?: 'Nowy' }}
                </a>
            </div>

            <div class="pull-right">{{ $pagination?: '' }}</div>
        @else
            {{ $pagination ?: '' }}
        @endif
    @endsection

    @section('table')
        <form method="get" id="filter-form">
            <table class="table table-striped">
                <thead>
                    <tr>
                        @foreach($columns as $column)
                            {{ grid_column($column) }}
                        @endforeach
                    </tr>
                    @if has_filters:
                        <tr>
                            @foreach($columns as $column)
                                {{ grid_filter($column) }}
                            @endforeach
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @if($rows)
                    @foreach($rows as $row)
                        {{ grid_row($row) }}
                    @endforeach
                    @else
                        <tr>
                            {{ grid_empty($grid) }}
                        </tr>
                    @endif
                </tbody>
            </table>

            <input type="submit" style="visibility: hidden; height: 1px" />
        </form>
    @endsection

    @section('footer')
        @if ($add_url):
            <div class="pull-right">{{ $pagination }}</div>
        @else
            {{ $pagination }}
        @endif
    @endsection
</div>
