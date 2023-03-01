import Highcharts from 'highcharts';
import HighchartsSankey from "highcharts/modules/sankey";
import HighchartsOrganization from "highcharts/modules/organization";

HighchartsSankey(Highcharts);
HighchartsOrganization(Highcharts);



Highcharts.chart('container', {
    chart: {
        height: 600, //Make customizable
        inverted: true //Make customizable
    },

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
        height: 110,
        color: '#ffffff',
        clip: false,
        borderColor: '#ffffff',
        colorByPoint: false,
        nodeWidth: 110,
        borderRadius: 0,
        enableMouseTracking: false,
        link: {
            type: 'curved',
            lineWidth: 2
        }
        ,
        keys: ['from', 'to'],
        data: connections,
        nodes: nodes,
        states: {
            hover: {
                enabled: false
            },
            inactive: {
                opacity: 1
            }
        },
    }],
    tooltip: {
        outside: true
    },

});


console.log('Processboard'); 
