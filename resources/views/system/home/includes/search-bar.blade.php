<form action="{{url($indexUrl)}}" method="get">
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <em class="fe fe-calendar  lh--9 op-6"></em>
            </div>
        </div>
        @php
            $from = request()->query('from');
            $dataFilter = request()->query('from'). ' - ' .request()->query('to');
        @endphp

        <input type="text" value="{{isset($from) ? $dataFilter : ''}}" id="daterange"
               class="form-control pull-right" placeholder="Search By Date...">
        <span class="input-group-append">
            <input type="hidden" name="from">
            <input type="hidden" name="to">
        <button class="btn ripple btn-primary" type="submit">Search</button>
    </span>

    </div>
</form>
<script async>
    $(function () {
        $('input[id="daterange"]').daterangepicker({
            autoUpdateInput: false,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            // "alwaysShowCalendars": true,
            // "showDropdowns": true,
        });

        $('input[id="daterange"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM-DD-YYYY') + ' - ' + picker.endDate.format('MM-DD-YYYY'));
            $('input[name="from"]').val(picker.startDate.format('MM-DD-YYYY'));
            $('input[name="to"]').val(picker.endDate.format('MM-DD-YYYY'));
        });

        $('input[id="daterange"]').on('cancel.daterangepicker', function (ev, picker) {
            $(this).val('');
        });
    });
</script>
