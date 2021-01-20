@extends('layout.index')

@section('css-link')

<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

@endsection

@section('conteudo')

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Receitas</h1>
        </div>

        <div class="row mb-3">
        	<div class="col-md-6 primary-left">
        		<div class="card border-left-primary shadow h-100 py-2">
        			<div class="card-body">
        				<div class="row no-glutters align-items-center">
        					<div class="col">
        						<div class="text-primary font-weight-bold">
        							{{$data['ano']}}
        						</div>
        					</div>
        				</div>
        				<hr class="m-0 mb-1">
        				<div class="row no-gutters align-items-center mb-3">
        					<div class="col mr-1">
        						<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Previsão
                                </div>
                                <div class="text-dark">
                                	{{Formatter::realmonetary(
                                        $renda['total'])
                                    }}
                                </div>
        					</div>

        					<div class="col mr-2">
								
								<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Recebido
                                </div>
                                <div class="text-dark">
                                	{{Formatter::realmonetary(
                                        $recebido['total'])
                                    }}
                                </div>
        					</div>

        					<div class="col-auto">
								<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Restante
                                </div>
                                <div class="text-right text-dark"> 
                                	XXX
                                </div>
        					</div>
                        </div>


                        <div class="row no-glutters align-items-center">
        					<div class="col">
        						<div class="text-primary font-weight-bold">
        							{{$data['mes']}}
        						</div>
        					</div>
        				</div>
        				<hr class="m-0 mb-1">
                        <div class="row no-gutters align-items-center">                        	
                        	<div class="col mr-1">
        						<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Previsão
                                </div>
                                <div class="text-dark">
                                	{{Formatter::realmonetary(
                                        $renda['meses'][$data['mes']])
                                    }}
                                </div>
        					</div>

        					<div class="col mr-2">
								
								<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Recebido
                                </div>
                                <div class="text-dark">
                                	{{Formatter::realmonetary(
                                        $recebido['meses'][$data['mes']])
                                    }}
                                </div>
        					</div>

        					<div class="col-auto">
								<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Restante
                                </div>
                                <div class="text-right text-dark"> 
                                	XXX
                                </div>
        					</div>
                        </div>

        			</div>
        		</div>
        	</div>

        	<div class="col-md-6 primary-left">
        		<div class="card border-left-primary shadow h-100 py-2">
        			<div class="card-body">
        				<div class="row no-gutters align-items-center">
        					<div class="col">
        						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                	Cadastrar Receita
                                </div>
								
                                @include ('receita.create')

        					</div>
                        </div> 

        			</div>
        		</div>
        	</div>
        </div>

        <div class="row mr-3">

        	<div class="col">
        		
	        		<div class="card shadow mb-4">
	        		    <div class="card-header py-3">
	        		        <h6 class="m-0 font-weight-bold text-primary">Receita Anual</h6>
	        		    </div>
	        		    <div class="card-body">
	        		        <div class="chart-bar">
	        		            <canvas id="myBarChart"></canvas>
	        		        </div>
	        		        <hr>
	        		        
	        		    </div>
	        		</div>
        		
        	</div>
        </div>


        @include ('receita.table', ['receitas'=>$receitas]);

		
@endsection


@section('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/renda.js')}}"></script>


    <!-- Page level custom scripts -->
    <script type="text/javascript">
    	$(document).ready(function() {
  			$('#tabela').DataTable();

  			$("#dtfinal").attr('disabled', true);

  			console.log();
  			$("#fixa").change(function() {
  				if ($(this).is(':checked')) {
  					document.getElementById("dtfinal").disabled = false;
  				} else {
  					document.getElementById("dtfinal").disabled = true;
  				}
  			});

  			//configuando máscara de valor
  			$("#valor").focusout (function(e){
				if ($(this).val() == "") return;
				var val = $(this).val().replace(',','.');
				var valor = parseFloat(val);
				var res = valor.toLocaleString('pt-BR',{
					minimumFractionDigits: 2,
					maximumFractionDigits: 2,
				});
				$(this).val(res);
			});

            //configuando máscara de valor no form edit.blade.php
            $("#editvalor").focusout (function(e){
                if ($(this).val() == "") return;
                var val = $(this).val().replace(',','.');
                var val = $(this).val().replace('R$ ','');
                var valor = parseFloat(val);
                var res = valor.toLocaleString('pt-BR',{
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
                $(this).val(res);
            });

            //filds for create.blade.php
  			$('#dtinicial').datepicker({

			});

			$('#dtfinal').datepicker({

			});

            //for edit.blade.php
            $('#editdata').datepicker({

            });
		});
       
        var editmodal = document.querySelector ("#editmodal");
        $(editmodal).on('show.bs.modal', function(e){
            var row = $(e.relatedTarget.parentElement.parentElement);
            var tds = row.children();

            var id = e.relatedTarget.getAttribute('id').replace('upd', '');
            
            var descricao = tds[0].innerText;
            var valor = tds[1].innerText;
            var data = tds[3].innerText;

            var form = document.getElementById("editform");
            elements = form.getElementsByTagName('input');

            elements[2].setAttribute('value', descricao);
            elements[3].setAttribute('value', valor);


            var dt = data.split('/');
            elements[4].setAttribute('value', dt[1]+'/'+dt[0]+'/'+dt[2]);

            var link = document.getElementById("edit-submit");
            link.onclick = function () {
                form.setAttribute ('action', window.location.href + '/' + id);
                form.submit();
                return false;
            }
        });

        var destroymodal = document.querySelector ("#deletemodal");
        $(destroymodal).on('show.bs.modal', function(e){
            var id = e.relatedTarget.getAttribute('id').replace('del', '');
            var form = document.getElementById("destroy-form");
            var link = document.getElementById("destroy-submit");
            link.onclick = function() {
                form.setAttribute ('action', 
                    window.location.href + '/' + id
                );
                form.submit();
                return false;
            }

        });

    </script>

    <script type="text/javascript">
    	// Bar Chart Example
    	var ctx = document.getElementById("myBarChart");
    	var myBarChart = new Chart(ctx, {
    	  type: 'bar',
    	  data: {
    	    labels: {!! json_encode(array_keys($renda['meses']))!!},
    	    datasets: [
                {
        	      label: "Previsão",
        	      backgroundColor: "#4e73df",
        	      hoverBackgroundColor: "#2e59d9",
        	      borderColor: "#4e73df",
        	      data: {!! json_encode(array_values($renda['meses'])) !!},
        	    },
                {
                  label: "Recebido",
                  backgroundColor: "#00cc00",
                  hoverBackgroundColor: "#66cc00",
                  borderColor: "#00cc00",
                  data: {!! json_encode(array_values($recebido['meses'])) !!},
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
    	          max: {!! max(array_values($renda['meses'])) !!},
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