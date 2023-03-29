<script>
    var nodes = {!! json_encode($nodes) !!};
    var connections = {!! json_encode($connections) !!};
</script>

<div id="chart_responsive" data-orientation="{!! $horizontal !!}" data-node-width="{!! $nodeWidth !!}" data-height="{!! $chartHeight !!}"  data-linestyle="{!! $linestyle !!}">
    <div id="container" style="min-width: {!! $chartWidth !!}px;"></div>
</div>
