//[Dashboard Javascript]

//Project:	CrmX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
	
	
	var optionsProgress1 = {
  chart: {
    height: 70,
    type: 'bar',
    stacked: true,
    sparkline: {
      enabled: true
    }
  },
  plotOptions: {
    bar: {
      horizontal: true,
      barHeight: '20%',
      colors: {
        backgroundBarColors: ['#ffffff']
      }
    },
  },
  colors: ['#ff8f00'],
  stroke: {
    width: 0,
  },
  series: [{
    name: 'Process 1',
    data: [44]
  }],
  subtitle: {
    floating: true,
    align: 'right',
    offsetY: 0,
    text: '44%',
    style: {
      fontSize: '20px',
		color:'#ffffff'
    }
  },
  tooltip: {
    enabled: false
  },
  xaxis: {
    categories: ['Process 1'],
  },
  yaxis: {
    max: 100
  },
  fill: {
    opacity: 1
  }
}

var chartProgress1 = new ApexCharts(document.querySelector('#progress1'), optionsProgress1);
chartProgress1.render();


var optionsProgress2 = {
  chart: {
    height: 70,
    type: 'bar',
    stacked: true,
    sparkline: {
      enabled: true
    }
  },
  plotOptions: {
    bar: {
      horizontal: true,
      barHeight: '20%',
      colors: {
        backgroundBarColors: ['#ffffff']
      }
    },
  },
  colors: ['#689f38'],
  stroke: {
    width: 0,
  },
  series: [{
    name: 'Process 2',
    data: [80]
  }],
  subtitle: {
    floating: true,
    align: 'right',
    offsetY: 0,
    text: '80%',
    style: {
      fontSize: '20px',
		color:'#ffffff'
    }
  },
  tooltip: {
    enabled: false
  },
  xaxis: {
    categories: ['Process 2'],
  },
  yaxis: {
    max: 100
  },
}

var chartProgress2 = new ApexCharts(document.querySelector('#progress2'), optionsProgress2);
chartProgress2.render();


var optionsProgress3 = {
  chart: {
    height: 70,
    type: 'bar',
    stacked: true,
    sparkline: {
      enabled: true
    }
  },
  plotOptions: {
    bar: {
      horizontal: true,
      barHeight: '20%',
      colors: {
        backgroundBarColors: ['#ffffff']
      }
    },
  },
  colors: ['#ee1044'],
  stroke: {
    width: 0,
  },
  series: [{
    name: 'Process 3',
    data: [74]
  }],
  subtitle: {
    floating: true,
    align: 'right',
    offsetY: 0,
    text: '74%',
    style: {
      fontSize: '20px',
		color:'#ffffff'
    }
  },
  tooltip: {
    enabled: false
  },
  xaxis: {
    categories: ['Process 3'],
  },
  yaxis: {
    max: 100
  },
}

var chartProgress3 = new ApexCharts(document.querySelector('#progress3'), optionsProgress3);
chartProgress3.render();
	
	var optionsProgress4 = {
  chart: {
    height: 70,
    type: 'bar',
    stacked: true,
    sparkline: {
      enabled: true
    }
  },
  plotOptions: {
    bar: {
      horizontal: true,
      barHeight: '20%',
      colors: {
        backgroundBarColors: ['#ffffff']
      }
    },
  },
  colors: ['#38649f'],
  stroke: {
    width: 0,
  },
  series: [{
    name: 'Process 4',
    data: [74]
  }],
  subtitle: {
    floating: true,
    align: 'right',
    offsetY: 0,
    text: '74%',
    style: {
      fontSize: '20px',
		color:'#ffffff'
    }
  },
  tooltip: {
    enabled: false
  },
  xaxis: {
    categories: ['Process 4'],
  },
  yaxis: {
    max: 100
  },
}

var chartProgress4 = new ApexCharts(document.querySelector('#progress4'), optionsProgress4);
chartProgress4.render();
	
window.Apex = {
	  chart: {
		foreColor: '#666666',
		toolbar: {
		  show: false
		},
	  },
	  colors: ['#689f38', '#ff8f00'],
	  stroke: {
		width: 3
	  },
	  dataLabels: {
		enabled: false
	  },
	  grid: {
		borderColor: "#f7f7f7",
	  },
	  xaxis: {
		axisTicks: {
		  color: '#cccccc'
		},
		axisBorder: {
		  color: "#cccccc"
		}
	  },
	  fill: {
		type: 'gradient',
		gradient: {
		  gradientToColors: ['#ff8f00', '#689f38']
		},
	  },
	  tooltip: {
		x: {
		  formatter: function (val) {
			return moment(new Date(val)).format("HH:mm:ss")
		  }
		}
	  },
	  yaxis: {
		opposite: true,
		labels: {
		  offsetX: -10
		}
	  }
	};

	var trigoStrength = 3
	var iteration = 11

	function getRandom() {
	  var i = iteration;
	  return (Math.sin(i / trigoStrength) * (i / trigoStrength) + i / trigoStrength + 1) * (trigoStrength * 2)
	}

	function getRangeRandom(yrange) {
	  return Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
	}

	function generateMinuteWiseTimeSeries(baseval, count, yrange) {
	  var i = 0;
	  var series = [];
	  while (i < count) {
		var x = baseval;
		var y = ((Math.sin(i / trigoStrength) * (i / trigoStrength) + i / trigoStrength + 1) * (trigoStrength * 2));

		series.push([x, y]);
		baseval += 300000;
		i++;
	  }
	  return series;
	}



	function getNewData(baseval, yrange) {
	  var newTime = baseval + 300000;
	  return {
		x: newTime,
		y: Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min
	  };
	}

	var optionsColumn = {
	  chart: {
		height: 350,
		type: 'bar',
		animations: {
		  enabled: true,
		  easing: 'linear',
		  dynamicAnimation: {
			speed: 1000
		  }
		},
		// dropShadow: {
		//   enabled: true,
		//   left: -14,
		//   top: -10,
		//   opacity: 0.05
		// },
		events: {
		  animationEnd: function (chartCtx) {
			const newData = chartCtx.w.config.series[0].data.slice()
			newData.shift();
			window.setTimeout(function () {
			  chartCtx.updateOptions({
				series: [{
				  data: newData
				}],
				xaxis: {
				  min: chartCtx.minX,
				  max: chartCtx.maxX
				},
				subtitle: {
				  text: parseInt(getRangeRandom({min: 1, max: 20})).toString() + '%',
				}
			  }, false, false);
			}, 300);
		  }
		},
		toolbar: {
		  show: false
		},
		zoom: {
		  enabled: false
		}
	  },
	  dataLabels: {
		enabled: false
	  },
	  stroke: {
		width: 0,
	  },
	  series: [{
		name: 'Load Average',
		data: generateMinuteWiseTimeSeries(new Date("12/12/2019 00:20:00").getTime(), 12, {
		  min: 10,
		  max: 110
		})
	  }],
	  subtitle: {
		text: '40%',
		floating: true,
		align: 'right',
		offsetY: 0,
		style: {
		  fontSize: '22px'
		}
	  },
	  fill: {
		type: 'gradient',
		gradient: {
		  shade: 'dark',
		  type: 'vertical',
		  shadeIntensity: 0.5,
		  inverseColors: false,
		  opacityFrom: 1,
		  opacityTo: 0.8,
		  stops: [0, 100]
		}
	  },
	  xaxis: {
		type: 'datetime',
		range: 2700000
	  },
	  legend: {
		show: true
	  },
	};



	var chartColumn = new ApexCharts(
	  document.querySelector("#columnchart1"),
	  optionsColumn
	);
	chartColumn.render();

	var optionsLine = {
	  chart: {
		height: 350,
		type: 'line',
		stacked: true,
		animations: {
		  enabled: true,
		  easing: 'linear',
		  dynamicAnimation: {
			speed: 1000
		  }
		},
		dropShadow: {
		  enabled: true,
		  opacity: 0.3,
		  blur: 5,
		  left: -7,
		  top: 22
		},
		events: {
		  animationEnd: function (chartCtx) {
			const newData1 = chartCtx.w.config.series[0].data.slice()
			newData1.shift()
			const newData2 = chartCtx.w.config.series[1].data.slice()
			newData2.shift()
			window.setTimeout(function () {
			  chartCtx.updateOptions({
				series: [{
				  data: newData1
				}, {
				  data: newData2
				}],
				subtitle: {
				  text: parseInt(getRandom() * Math.random()).toString(),
				}
			  }, false, false);
			}, 300);
		  }
		},
		toolbar: {
		  show: false
		},
		zoom: {
		  enabled: false
		}
	  },
	  dataLabels: {
		enabled: false
	  },
	  stroke: {
		curve: 'straight',
		width: 5,
	  },
	  grid: {
		padding: {
		  left: 0,
		  right: 0
		}
	  },
	  markers: {
		size: 0,
		hover: {
		  size: 0
		}
	  },
	  series: [{
		name: 'Running',
		data: generateMinuteWiseTimeSeries(new Date("12/12/2019 00:20:00").getTime(), 12, {
		  min: 30,
		  max: 110
		})
	  }, {
		name: 'Waiting',
		data: generateMinuteWiseTimeSeries(new Date("12/12/2019 00:20:00").getTime(), 12, {
		  min: 30,
		  max: 110
		})
	  }],
	  xaxis: {
		type: 'datetime',
		range: 2700000
	  },
	  subtitle: {
		text: '20',
		floating: true,
		align: 'right',
		offsetY: 0,
		style: {
		  fontSize: '22px'
		}
	  },
	  legend: {
		show: true,
		floating: true,
		horizontalAlign: 'left',
		onItemClick: {
		  toggleDataSeries: false
		},
		position: 'top',
		offsetY: -33,
		offsetX: 60
	  },
	};

	var chartLine = new ApexCharts(
	  document.querySelector("#linechart1"),
	  optionsLine
	);
	chartLine.render();
	
	window.setInterval(function () {

	  iteration++;

	  chartColumn.updateSeries([{
		data: [...chartColumn.w.config.series[0].data,
		  [
			chartColumn.w.globals.maxX + 210000,
			getRandom()
		  ]
		]
	  }])

	  chartLine.updateSeries([{
		data: [...chartLine.w.config.series[0].data,
		  [
			chartLine.w.globals.maxX + 300000,
			getRandom()
		  ]
		]
	  }, {
		data: [...chartLine.w.config.series[1].data,
		  [
			chartLine.w.globals.maxX + 300000,
			getRandom()
		  ]
		]
	  }])


	}, 3000)	
	
	
	
	
	
		
		$("#linearea").sparkline([32,24,26,24,32,26,40,34,22,24], {
			type: 'line',
			width: '100%',
			height: '100',
			lineColor: '#ee1044',
			fillColor: '#ee1044',
			lineWidth: 2,
		});
	
	

	
	
/*****E-Charts function start*****/
		
	if( $('#e_chart_3').length > 0 ){
		var eChart_3 = echarts.init(document.getElementById('e_chart_3'));
		var data = [{
			value: 5713,
			name: ''
		}, {
			value: 8458,
			name: ''
		}, {
			value: 1254,
			name: ''
		}, {
			value: 2589,
			name: ''
		}, {
			value: 8546,
			name: ''
		}];
		var option3 = {
			tooltip: {
				show: true,
				trigger: 'item',
				backgroundColor: 'rgba(33,33,33,1)',
				borderRadius:0,
				padding:10,
				formatter: "{b}: {c} ({d}%)",
				textStyle: {
					color: '#fff',
					fontStyle: 'normal',
					fontWeight: 'normal',
					fontFamily: "'Open Sans', sans-serif",
					fontSize: 12
				}	
			},
			series: [{
				type: 'pie',
				selectedMode: 'single',
				radius: ['100%', '30%'],
				color: ['#689f38', '#38649f', '#389f99', '#ee1044', '#ff8f00'],
				labelLine: {
					normal: {
						show: false
					}
				},
				data: data
			}]
		};
		eChart_3.setOption(option3);
		eChart_3.resize();
	}

/*****E-Charts function end*****/	
// table
	$('#invoice-list').DataTable({
	  'paging'      : true,
	  'lengthChange': false,
	  'searching'   : false,
	  'ordering'    : true,
	  'info'        : true,
	  'autoWidth'   : true,
	});	
	

	
	
	
	
//-----demo-6	
	var chart = new Chartist.Line('.ct-chart-6', {
	  labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
	  series: [
		[12, 9, 7, 8, 5, 4, 6, 2, 3, 3, 4, 6],
		[4,  5, 3, 7, 3, 5, 5, 3, 4, 4, 5, 5],
		[5,  3, 4, 5, 6, 3, 3, 4, 5, 6, 3, 4],
		[3,  4, 5, 6, 7, 6, 4, 5, 6, 7, 6, 3]
	  ]
	}, {
	  low: 0
	});

	// Let's put a sequence number aside so we can use it in the event callbacks
	var seq = 0,
	  delays = 80,
	  durations = 500;

	// Once the chart is fully created we reset the sequence
	chart.on('created', function() {
	  seq = 0;
	});

	// On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
	chart.on('draw', function(data) {
	  seq++;

	  if(data.type === 'line') {
		// If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
		data.element.animate({
		  opacity: {
			// The delay when we like to start the animation
			begin: seq * delays + 1000,
			// Duration of the animation
			dur: durations,
			// The value where the animation should start
			from: 0,
			// The value where it should end
			to: 1
		  }
		});
	  } else if(data.type === 'label' && data.axis === 'x') {
		data.element.animate({
		  y: {
			begin: seq * delays,
			dur: durations,
			from: data.y + 100,
			to: data.y,
			// We can specify an easing function from Chartist.Svg.Easing
			easing: 'easeOutQuart'
		  }
		});
	  } else if(data.type === 'label' && data.axis === 'y') {
		data.element.animate({
		  x: {
			begin: seq * delays,
			dur: durations,
			from: data.x - 100,
			to: data.x,
			easing: 'easeOutQuart'
		  }
		});
	  } else if(data.type === 'point') {
		data.element.animate({
		  x1: {
			begin: seq * delays,
			dur: durations,
			from: data.x - 10,
			to: data.x,
			easing: 'easeOutQuart'
		  },
		  x2: {
			begin: seq * delays,
			dur: durations,
			from: data.x - 10,
			to: data.x,
			easing: 'easeOutQuart'
		  },
		  opacity: {
			begin: seq * delays,
			dur: durations,
			from: 0,
			to: 1,
			easing: 'easeOutQuart'
		  }
		});
	  } else if(data.type === 'grid') {
		// Using data.axis we get x or y which we can use to construct our animation definition objects
		var pos1Animation = {
		  begin: seq * delays,
		  dur: durations,
		  from: data[data.axis.units.pos + '1'] - 30,
		  to: data[data.axis.units.pos + '1'],
		  easing: 'easeOutQuart'
		};

		var pos2Animation = {
		  begin: seq * delays,
		  dur: durations,
		  from: data[data.axis.units.pos + '2'] - 100,
		  to: data[data.axis.units.pos + '2'],
		  easing: 'easeOutQuart'
		};

		var animations = {};
		animations[data.axis.units.pos + '1'] = pos1Animation;
		animations[data.axis.units.pos + '2'] = pos2Animation;
		animations['opacity'] = {
		  begin: seq * delays,
		  dur: durations,
		  from: 0,
		  to: 1,
		  easing: 'easeOutQuart'
		};

		data.element.animate(animations);
	  }
	});

	// For the sake of the example we update the chart every time it's created with a delay of 10 seconds
	chart.on('created', function() {
	  if(window.__exampleAnimateTimeout) {
		clearTimeout(window.__exampleAnimateTimeout);
		window.__exampleAnimateTimeout = null;
	  }
	  window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 12000);
	});
	


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



                


