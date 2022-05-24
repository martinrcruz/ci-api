//[Dashboard Javascript]

//Project:	CrmX Admin - Responsive Admin Template
//Primary use:   Used only for the main dashboard (index.html)


$(function () {

  'use strict';
	
	 window.Apex = {
      stroke: {
        width: 3
      },
      markers: {
        size: 0
      },
      tooltip: {
        fixed: {
          enabled: true,
        }
      }
    };
    
    var randomizeArray = function (arg) {
      var array = arg.slice();
      var currentIndex = array.length,
        temporaryValue, randomIndex;

      while (0 !== currentIndex) {

        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
      }

      return array;
    }

    // data for the sparklines that appear below header area
    var sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46];

    var spark1 = {
      chart: {
        type: 'area',
        height: 240,
        sparkline: {
          enabled: true
        },
      },
      stroke: {
        curve: 'smooth'
      },
      fill: {
        opacity: 1,
        type: 'gradient',
		gradient: {
		  gradientToColors: ['#689f38', '#689f38']
		},
      },
      series: [{
        data: randomizeArray(sparklineData)
      }],
		labels: [...Array(24).keys()].map(n => `2018-09-0${n+1}`),
      yaxis: {
        min: 0
      },
	  xaxis: {
		type: 'datetime',
	  },
      colors: ['#689f38'],
		tooltip: {
			theme: 'dark'
  		},
    }
	
	var spark1 = new ApexCharts(document.querySelector("#spark1"), spark1);
    spark1.render();
	
	var spark1 = {
	  chart: {
		id: 'sparkline1',
		type: 'line',
		height: 155,
		sparkline: {
		  enabled: true
		},
		group: 'sparklines'
	  },
	  series: [{
		name: 'Earnings',
		data: [25, 66, 41, 59, 25, 44, 12, 36, 9, 21]
	  }],
	  stroke: {
		curve: 'smooth'
	  },
	  markers: {
		size: 0
	  },
	  tooltip: {
		fixed: {
		  enabled: true,
		  position: 'right'
		},
		x: {
		  show: false
		}
	  },
	  colors: ['#ee1044']
	}

	new ApexCharts(document.querySelector("#spark4"), spark1).render();
	
	
	/*********** REAL TIME UPDATES **************/

    var data = [], totalPoints = 50;

    function getRandomData() {
      if (data.length > 0)
      data = data.slice(1);
      while (data.length < totalPoints) {
        var prev = data.length > 0 ? data[data.length - 1] : 50,
        y = prev + Math.random() * 10 - 5;
        if (y < 0) {
          y = 0;
        } else if (y > 100) {
          y = 100;
        }
        data.push(y);
      }
      var res = [];
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }
      return res;
    }


    // Set up the control widget
	 var updateInterval = 1000;

    var plot5 = $.plot('#flotRealtime2', [ getRandomData() ], {
      colors: ['#38649f'],
		  series: {
        lines: {
          show: true,
          lineWidth: 0,
          fill: 0.9
        },
        shadowSize: 0	// Drawing is faster without shadows
		  },
      grid: {
        borderColor: '#ddd',
        borderWidth: 1,
        labelMargin: 5
		  },
      xaxis: {
        color: '#eee',
        font: {
          size: 10,
          color: '#999'
        }
      },
		  yaxis: {
				min: 0,
				max: 100,
        color: '#eee',
        font: {
          size: 10,
          color: '#999'
        }
		  }
	 });
   function update_plot5() {
		  plot5.setData([getRandomData()]);
		  plot5.draw();
		  setTimeout(update_plot5, updateInterval);
	 }
   update_plot5();

	
	
	// Initialize module
// ------------------------------

// When content loaded
document.addEventListener('DOMContentLoaded', function() {
    Widgetschart.init();
});



// ------------------------------
    // Basic bar chart
    // ------------------------------
    // based on prepared DOM, initialize echarts instance
        var myChart = echarts.init(document.getElementById('basic-bar'));

        // specify chart configuration item and data
        var option = {
                // Setup grid
                grid: {
                    left: '1%',
                    right: '2%',
                    bottom: '3%',
                    containLabel: true
                },

                // Add Tooltip
                tooltip : {
                    trigger: 'axis'
                },

                legend: {
                    data:['Site A','Site B']
                },
                toolbox: {
                    show : true,
                    feature : {

                        magicType : {show: true, type: ['line', 'bar']},
                        restore : {show: true},
                        saveAsImage : {show: true}
                    }
                },
                color: ["#689f38", "#389f99"],
                calculable : true,
                xAxis : [
                    {
                        type : 'category',
                        data : ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec']
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Site A',
                        type:'bar',
                        data:[7.2, 5.3, 6.1, 32.1, 23.1, 89.2, 158.4, 178.1, 36.4, 22.7, 7.1, 9.4],
                        markPoint : {
                            data : [
                                {type : 'max', name: 'Max'},
                                {type : 'min', name: 'Min'}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name: 'Average'}
                            ]
                        }
                    },
                    {
                        name:'Site B',
                        type:'bar',
                        data:[19.4, 7.9, 8.9, 27.9, 24.8, 88.1, 167.8, 197.5, 47.1, 16.7, 7.1, 1.5],
                        markPoint : {
                            data : [
                                {name : 'The highest year', value : 182.2, xAxis: 7, yAxis: 183, symbolSize:18},
                                {name : 'Year minimum', value : 2.3, xAxis: 11, yAxis: 3}
                            ]
                        },
                        markLine : {
                            data : [
                                {type : 'average', name : 'Average'}
                            ]
                        }
                    }
                ]
            };
        // use configuration item and data specified to show chart
        myChart.setOption(option);
	
				
		// bar chart
		$(".bar").peity("bar");	
	
// Morris-chart
	
	Morris.Area({
        element: 'morris-area-chart2',
        data: [{
            period: '2012',
            SiteA: 485,
            SiteB: 358,
            
        }, {
            period: '2013',
            SiteA: 359,
            SiteB: 210,
            
        }, {
            period: '2014',
            SiteA: 589,
            SiteB: 410,
            
        }, {
            period: '2015',
            SiteA: 458,
            SiteB: 344,
            
        }, {
            period: '2016',
            SiteA: 254,
            SiteB: 200,
            
        }, {
            period: '2017',
            SiteA: 754,
            SiteB: 630,
            
        },
         {
            period: '2018',
            SiteA: 845,
            SiteB: 711,
           
        }],
        xkey: 'period',
        ykeys: ['SiteA', 'SiteB'],
        labels: ['Total Ticket', 'Close Ticket'],
        pointSize: 5,
        fillOpacity: 0.2,
        pointStrokeColors:['#ee1044', '#38649f'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 3,
        smooth: false,
        hideHover: 'auto',
        lineColors: ['#ee1044', '#38649f'],
        resize: true
        
    });
	// area chart
 Morris.Area({
        element: 'area-chart3',
        data: [{
                    period: '2013',
                    data1: 0,
                    data2: 0,
                    data3: 0
                }, {
                    period: '2014',
                    data1: 48,
                    data2: 24,
                    data3: 18
                }, {
                    period: '2015',
                    data1: 29,
                    data2: 50,
                    data3: 177
                }, {
                    period: '2016',
                    data1: 100,
                    data2: 192,
                    data3: 44
                }, {
                    period: '2017',
                    data1: 38,
                    data2: 26,
                    data3: 131
                }, {
                    period: '2018',
                    data1: 32,
                    data2: 87,
                    data3: 41
                }, {
                    period: '2019',
                    data1: 10,
                    data2: 10,
                    data3: 10
                }


                ],
                lineColors: ['#689f38', '#38649f', '#ee1044'],
                xkey: 'period',
                ykeys: ['data1', 'data2', 'data3'],
                labels: ['Data 1', 'Data 2', 'Data 3'],
                pointSize: 0,
                lineWidth: 0,
                resize:true,
                fillOpacity: 0.8,
                behaveLikeLine: true,
                gridLineColor: '#e0e0e0',
                hideHover: 'auto',
	 			smooth:'false'
        
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


                


