import Highcharts from 'highcharts';
import HighchartsSankey from "highcharts/modules/sankey";
import HighchartsOrganization from "highcharts/modules/organization";

HighchartsSankey(Highcharts);
HighchartsOrganization(Highcharts);

var wrapper = document.getElementById('chart_responsive');

var chartHeight = wrapper.getAttribute('data-height');
var chartWidth = wrapper.getAttribute('data-width');
var isHorizontal = wrapper.getAttribute('data-orientation');
var linestyle = wrapper.getAttribute('data-linestyle');
var node_width = wrapper.getAttribute('data-node-width');

if(isHorizontal == '1') {
    isHorizontal = true;
} else {
    isHorizontal = false;
}

Highcharts.chart('container', {
    chart: {
        height: chartHeight, 
        inverted: isHorizontal,
        events: {
            click: function() {
            },
            load: function() {
                this.reflow();
            },
            render: function() {
            },
            redraw: function() {
            },
            selection: function() {
            },
        },
    },

    tooltip: { enabled: false },

    title: {
        text: null //Customizable
    },

    accessibility: {
        point: {
            descriptionFormatter: function (point) {
                var nodeName = point.toNode.name,
                    nodeId = point.toNode.id,
                    nodeDesc = nodeName === nodeId ? nodeName : nodeName + ', ' + nodeId,
                    parentDesc = point.fromNode.id;
                return point.index + '. ' + nodeDesc + ', reports to ' + parentDesc + '.';
            }
        }
    },

    series: [{
        type: 'organization',
        name: 'Processer2',
        color: '#ffffff',
        clip: false,
        borderColor: '#ffffff',
        colorByPoint: false,
        nodeWidth: node_width,
        borderRadius: 0,
        //enableMouseTracking: false,
        link: {
            type: linestyle,
            lineWidth: 2,
            radius: 30,

        }
        ,
        keys: ['from', 'to'],
        data: connections,
        nodes: nodes,
        states: {
            hover: {
                //enabled: false
            },
            inactive: {
                opacity: .3
            }
        },
    }],
});

setInterval(function () {
    Highcharts.charts[0].reflow();
}, 2000);
