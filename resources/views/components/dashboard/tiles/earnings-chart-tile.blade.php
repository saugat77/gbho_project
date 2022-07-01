<div class="card z-depth-0">
    <div class="card-header">
        <div class="d-flex align-items-center">
            <div class="card-title">Earnings</div>
            <div class="ml-auto">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool z-depth-0" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool z-depth-0" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
        </div>
        <form id="earnings-query-form" action="#" class="form-inline">
            <input type="date" name="from" class="form-control form-control-sm mr-1 bg-transparent" value="{{ $from }}">
            <input type="date" name="to" class="form-control form-control-sm mr-1 bg-transparent" value="{{ $to }}">
            <select name="report_type" class="custom-select custom-select-sm mr-1 bg-transparent">
                <option value="date">Daily</option>
                <option value="month">Monthly</option>
                <option value="year">Yearly</option>
            </select>
            <button type="submit" class="btn btn-outline-primary btn-sm z-depth-0">Go</button>
        </form>
    </div>
    <div class="card-body">
        <div id="earnings-chart" style="height: 300px;"></div>
    </div>
</div>

@push('scripts')
<script>
    var earningsChartUrl = "@chart('earnings_chart')";

    const earningsChart = new Chartisan({
        el: '#earnings-chart'
        , url: "@chart('earnings_chart', ['from' => $from, 'to' => $to])"
        , hooks: new ChartisanHooks()
            .beginAtZero(false)
            .colors(['#ff6384'])
            .borderColors(['#ff6384'])
            .responsive()
            .legend({
                position: 'bottom'
            })
            .datasets([{
                type: 'line'
                , fill: false
            }])
    , });

    // Refetch data on form submit
    document.getElementById('earnings-query-form').addEventListener('submit', function(event) {
        event.preventDefault();
        let params = new URLSearchParams(Array.from(new FormData(event.srcElement))).toString();
        earningsChart.update({
            url: earningsChartUrl + '?' + params
        });
        return false;
    });

</script>
@endpush
