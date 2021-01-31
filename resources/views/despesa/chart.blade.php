{{-- @section('css-link2')

@endsection --}}

{{-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Receita Anual</h6>
</div> --}}
<div class="card-body">
    <div class="chart-bar">
        <canvas id="myBarChart"></canvas>
    </div>
    <hr>
    
</div>

@section('script2')

 <!-- Page level plugins -->
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/renda.js')}}"></script>

<script type="text/javascript">
	// Bar Chart Example
	var ctx = document.getElementById("myBarChart");
	var myBarChart = new Chart(ctx, {
	  type: 'bar',
	  data: {
	    labels: {!! json_encode(array_keys($despesa_total['meses']))!!},
	    datasets: [
            {
    	      label: "Não Pago",
    	      backgroundColor: "#4e73df",
    	      hoverBackgroundColor: "#2e59d9",
    	      borderColor: "#4e73df",
    	      data: {!! json_encode(array_values($despesa_total['meses'])) !!},
    	    },
            {
              label: "Pago",
              backgroundColor: "#00cc00",
              hoverBackgroundColor: "#66cc00",
              borderColor: "#00cc00",
              data: {!! json_encode(array_values($despesa_paga['meses'])) !!},
            }
        ],
	  },
	  options: {
	    maintainAspectRatio: false,
	    layout: {
	      padding: {
	        left: 10,
	        right: 25,
	        top: 25,
	        bottom: 0
	      }
	    },
	    scales: {
	      xAxes: [{
	        time: {
	          unit: 'month'
	        },
	        gridLines: {
	          display: false,
	          drawBorder: false
	        },
	        ticks: {
	          maxTicksLimit: 6
	        },
	        maxBarThickness: 25,
	      }],
	      yAxes: [{
	        ticks: {
	          min: 0,
	          max: {!! max(array_values($despesa_total['meses'])) !!},
	          maxTicksLimit: 5,
	          padding: 10,    	        
              callback: function (value, index, values) {
                return 'R$ ' + my_number_format (value);
              }
	        },
	        gridLines: {
	          color: "rgb(234, 236, 244)",
	          zeroLineColor: "rgb(234, 236, 244)",
	          drawBorder: false,
	          borderDash: [2],
	          zeroLineBorderDash: [2]
	        }
	      }],
	    },
	    legend: {
	      display: false
	    },
	    tooltips: {
	      titleMarginBottom: 10,
	      titleFontColor: '#6e707e',
	      titleFontSize: 14,
	      backgroundColor: "rgb(255,255,255)",
	      bodyFontColor: "#858796",
	      borderColor: '#dddfeb',
	      borderWidth: 1,
	      xPadding: 15,
	      yPadding: 15,
	      displayColors: false,
	      caretPadding: 10,
	      callbacks: {
	        label: function(tooltipItem, chart) {
	          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
	          return datasetLabel + ': R$' + my_number_format(tooltipItem.yLabel);
	        }
	      }
	    },
	  }
	});
</script>
@endsection