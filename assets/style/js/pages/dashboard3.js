//[Dashboard Javascript]

//Project:	CrmX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
		// Themes begin
		am4core.useTheme(am4themes_kelly);
		// Themes end

		// create chart
		var chart = am4core.create("traffic", am4charts.GaugeChart);
		chart.innerRadius = am4core.percent(82);

		/**
		 * Normal axis
		 */

		var axis = chart.xAxes.push(new am4charts.ValueAxis());
		axis.min = 0;
		axis.max = 100;
		axis.strictMinMax = true;
		axis.fontSize = 10;
		axis.renderer.radius = am4core.percent(80);
		axis.renderer.inside = false;
		axis.renderer.line.strokeOpacity = 1;
		axis.renderer.ticks.template.strokeOpacity = 1;
		axis.renderer.ticks.template.length = 10;
		axis.renderer.grid.template.disabled = true;
		axis.renderer.labels.template.radius = 40;
		axis.renderer.labels.template.adapter.add("text", function(text) {
		  return text + "%";
		})

		/**
		 * Axis for ranges
		 */

		var colorSet = new am4core.ColorSet();

		var axis2 = chart.xAxes.push(new am4charts.ValueAxis());
		axis2.min = 0;
		axis2.max = 100;
		axis2.renderer.innerRadius = 10
		axis2.strictMinMax = true;
		axis2.renderer.labels.template.disabled = true;
		axis2.renderer.ticks.template.disabled = true;
		axis2.renderer.grid.template.disabled = true;

		var range0 = axis2.axisRanges.create();
		range0.value = 0;
		range0.endValue = 50;
		range0.axisFill.fillOpacity = 1;
		range0.axisFill.fill = colorSet.getIndex(0);

		var range1 = axis2.axisRanges.create();
		range1.value = 50;
		range1.endValue = 100;
		range1.axisFill.fillOpacity = 1;
		range1.axisFill.fill = colorSet.getIndex(2);

		/**
		 * Label
		 */

		var label = chart.radarContainer.createChild(am4core.Label);
		label.isMeasured = false;
		label.fontSize = 16;
		label.x = am4core.percent(50);
		label.y = am4core.percent(100);
		label.horizontalCenter = "middle";
		label.verticalCenter = "bottom";
		label.text = "50%";


		/**
		 * Hand
		 */

		var hand = chart.hands.push(new am4charts.ClockHand());
		hand.axis = axis2;
		hand.innerRadius = am4core.percent(20);
		hand.startWidth = 10;
		hand.pin.disabled = true;
		hand.value = 50;

		hand.events.on("propertychanged", function(ev) {
		  range0.endValue = ev.target.value;
		  range1.value = ev.target.value;
		  axis2.invalidate();
		});

		setInterval(() => {
		  var value = Math.round(Math.random() * 100);
		  label.text = value + "%";
		  var animation = new am4core.Animation(hand, {
			property: "value",
			to: value
		  }, 1000, am4core.ease.cubicOut).start();
		}, 2000);


		
		// Themes begin		
		am4core.useTheme(am4themes_dataviz);
		// Themes end

		// Create map instance
		var chart = am4core.create("visitorsmap", am4maps.MapChart);

		// Set map definition
		chart.geodata = am4geodata_worldLow;

		// Set projection
		chart.projection = new am4maps.projections.Miller();

		// Create map polygon series
		var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

		// Exclude Antartica
		polygonSeries.exclude = ["AQ"];

		// Make map load polygon (like country names) data from GeoJSON
		polygonSeries.useGeodata = true;

		// Configure series
		var polygonTemplate = polygonSeries.mapPolygons.template;
		polygonTemplate.tooltipText = "{name}";
		polygonTemplate.fill = chart.colors.getIndex(0);

		// Create hover state and set alternative fill color
		var hs = polygonTemplate.states.create("hover");
		hs.properties.fill = chart.colors.getIndex(0).brighten(-0.5);

		// Create active state
		var activeState = polygonTemplate.states.create("active");
		activeState.properties.fill = chart.colors.getIndex(3).brighten(-0.5);

		// Create an event to toggle "active" state
		polygonTemplate.events.on("hit", function(ev) {
		  ev.target.isActive = !ev.target.isActive;
		})
	
		
		
		// bar chart
		$(".bar").peity("bar");	
	
		var optionDonut = {
		  chart: {
			  type: 'donut',
			  width: '100%',
			  height: '180'
		  },
		  dataLabels: {
			enabled: false,
		  },
		  plotOptions: {
			pie: {
			  donut: {
				size: '70%',
			  },
			  offsetY: 0,
			},
			stroke: {
			  colors: undefined
			}
		  },
		  colors:['#689f38', '#389f99', '#38649f', '#ff8f00', '#ee1044'],

		  series: [21, 23, 19, 14, 6],
		  labels: ['Men', 'Mobile', 'Women', 'Gadget', 'Other'],
		  legend: {
			position: 'right'
		  }
		}

		var donut = new ApexCharts(
		  document.querySelector("#donut"),
		  optionDonut
		)
		donut.render();
	
	
		var options = {
		  chart: {
			height: 350,
			type: 'area',
			stacked: true,
			events: {
			  selection: function(chart, e) {
				console.log(new Date(e.xaxis.min) )
			  }
			},

		  },
		  colors: ['#38649f', '#ff8f00', '#ee1044'],
		  dataLabels: {
			  enabled: false
		  },
		  stroke: {
			curve: 'smooth'
		  },

		  series: [{
			  name: 'South',
			  data: generateDayWiseTimeSeries(new Date('11 Feb 2019 GMT').getTime(), 10, {
				min: 10,
				max: 30
			  })
			},
			{
			  name: 'North',
			  data: generateDayWiseTimeSeries(new Date('11 Feb 2019 GMT').getTime(), 10, {
				min: 6,
				max: 25
			  })
			},

			{
			  name: 'Central',
			  data: generateDayWiseTimeSeries(new Date('11 Feb 2019 GMT').getTime(), 10, {
				min: 11,
				max: 35
			  })
			}
		  ],
		  fill: {
			type: 'gradient',
			gradient: {
			  opacityFrom: 0.9,
			  opacityTo: 0.8,
			}
		  },
		  legend: {
			position: 'top',
			horizontalAlign: 'left'
		  },
		  xaxis: {
			type: 'datetime'
		  },
		}

		var chart = new ApexCharts(
		  document.querySelector("#earning"),
		  options
		);

		chart.render();

		/*
		  // this function will generate output in this format
		  // data = [
			  [timestamp, 23],
			  [timestamp, 33],
			  [timestamp, 12]
			  ...
		  ]
		  */
		function generateDayWiseTimeSeries(baseval, count, yrange) {
		  var i = 0;
		  var series = [];
		  while (i < count) {
			var x = baseval;
			var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

			series.push([x, y]);
			baseval += 86400000;
			i++;
		  }
		  return series;
		}
	
	
		var options = {
            chart: {
                height: 288,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            series: [{
                name: "Desktops",
                data: [10, 41, 35, 51, 49, 62, 69]
            }],
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#sales-statistics"),
            options
        );

        chart.render();
	
			
	   $('.bandwidth').sparkline(
		  [32,24,26,24,32,26,40,34,22,24,32,24,26,24,32,26,40,34,22,24],
		  {
			type: 'bar',
			width: '100%',
			height: '80',
			barWidth: '5',
			resize: true,
			barSpacing: '6',
			barColor: 'rgba(255, 255, 255, 0.8)'
		  }
		);
	
	
	// Callback that creates and populates a data table, instantiates the column chart, passes in the data and draws it.
    var columnChart = c3.generate({
        bindto: '#column-chart',
        size: { height: 300 },
        color: {
            pattern: ['#38649f', '#ff8f00', '#ee1044']
        },


        // Create the data table.
        data: {
            columns: [
                ['data1', 30, 200, 100, 400, 150, 250],
            	['data2', 130, 100, 140, 200, 150, 50]
            ],
            type: 'bar'
        },
        bar: {
            width: {
                ratio: 0.9 // this makes bar width 50% of length between ticks
            }
            // or
            //width: 100 // this makes bar width 100px
        },
        grid: {
            y: {
                show: true
            }
        }
    });

    // Instantiate and draw our chart, passing in some options.
    setTimeout(function() {
        columnChart.load({
            columns: [
                ['data3', 130, 150, 200, 300, 200, 100]
            ]
        });
    }, 1000);
	
		
	
	
//dashboard_daterangepicker
	
	if(0!==$("#dashboard_daterangepicker").length) {
		var n=$("#dashboard_daterangepicker"),
		e=moment(),
		t=moment();
		n.daterangepicker( {
			startDate:e, endDate:t, opens:"left", ranges: {
				Today: [moment(), moment()], Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")], "Last 7 Days": [moment().subtract(6, "days"), moment()], "Last 30 Days": [moment().subtract(29, "days"), moment()], "This Month": [moment().startOf("month"), moment().endOf("month")], "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
			}
		}
		, a),
		a(e, t, "")
	}
	function a(e, t, a) {
		var r="",
		o="";
		t-e<100||"Today"==a?(r="Today:", o=e.format("MMM D")): "Yesterday"==a?(r="Yesterday:", o=e.format("MMM D")): o=e.format("MMM D")+" - "+t.format("MMM D"), n.find(".subheader_daterange-date").html(o), n.find(".subheader_daterange-title").html(r)
	}
	
	
}); // End of use strict




                


