// Flot Charts sample data for SB Admin template

// Flot Line Chart with Tooltips
$(document).ready(function () {
    console.log("document ready");
    var offset = 0;
    plot();

    function plot() {
        var sin = [],
                cos = [];
        for (var i = 0; i < 12; i += 0.2) {
            sin.push([i, Math.sin(i + offset)]);
            cos.push([i, Math.cos(i + offset)]);
        }

        var options = {
            series: {
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            grid: {
                hoverable: true //IMPORTANT! this is needed for tooltip to work
            },
            yaxis: {
                min: -1.2,
                max: 1.2
            },
            tooltip: true,
            tooltipOpts: {
                content: "'%s' of %x.1 is %y.4",
                shifts: {
                    x: -60,
                    y: 25
                }
            }
        };

        var plotObj = $.plot($("#flot-line-chart"), [{
                data: sin,
                label: "sin(x)"
            }, {
                data: cos,
                label: "cos(x)"
            }],
                options);  
        plotObj.setupGrid();
        plotObj.draw();
    }
});

function plot2(){
        var sin = [],
                cos = [];
        for (var i = 0; i < 12; i += 0.5) {
            sin.push([i, i*10]);
            cos.push([i, i*5]);
        }

        var options = {
            series: {
                lines: {
                    show: true
                },
                points: {
                    show: true
                }
            },
            grid: {
                hoverable: true //IMPORTANT! this is needed for tooltip to work
            },
            yaxis: {

            },
            tooltip: true,
            tooltipOpts: {
                content: "'%s' of %x.1 is %y.4",
                shifts: {
                    x: -60,
                    y: 25
                }
            }
        };

        var plotObj = $.plot($("#flot-line-chart"), [{
                data: sin,
                label: "X"
            }, {
                data: cos,
                label: "Y"
            }],
                options);  
        plotObj.setupGrid();
        plotObj.draw();
}

