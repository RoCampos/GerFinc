@extends('layout.index')

@section('css-link')

<!-- Custom styles for this page -->
<link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

@endsection

@section('conteudo')

		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Receitas</h1>
			<a href="{{route('receitas.create')}}" class="btn btn-primary btn-circle">
				<i data-feather="plus-circle"></i>
			</a>

        </div>

        <div class="row mb-3">
        	<div class="col-md-6 primary-left">
        		<div class="card border-left-primary shadow h-100 py-2">
        			<div class="card-body">
        				<div class="row no-glutters align-items-center">
        					<div class="col">
        						<div class="text-primary font-weight-bold">
        							Ano -- XX
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
                                	Valor
                                </div>
        					</div>

        					<div class="col mr-2">
								
								<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Recebido
                                </div>
                                <div class="text-dark">
                                	Valor
                                </div>
        					</div>

        					<div class="col-auto">
								<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Em Caixa
                                </div>
                                <div class="text-right text-dark"> 
                                	Valor
                                </div>
        					</div>
                        </div>


                        <div class="row no-glutters align-items-center">
        					<div class="col">
        						<div class="text-primary font-weight-bold">
        							Mes -- XX
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
                                	Valor
                                </div>
        					</div>

        					<div class="col mr-2">
								
								<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Recebido
                                </div>
                                <div class="text-dark">
                                	Valor
                                </div>
        					</div>

        					<div class="col-auto">
								<div class="text-xs font-weight-bold text-gray-900 text-uppercase mb-1">
                                	Em Caixa
                                </div>
                                <div class="text-right text-dark"> 
                                	Valor
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
								<form action="{{route('receitas.store')}}" method="POST">
									@csrf
									<div class="form-row align-items-center justify-content-between">
										<div class="form-group col-md-8">
											<label class="form-label">
												Descrição
											</label>
											<input type="text" name="descricao" placeholder="Descrição da Receita" class="form-control">	
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">
												Valor
											</label>
											<input type="text" id="valor" name="valor" placeholder="Insira o valor" class="form-control">	
										</div>
										
									</div>
									
									<div class="form-row align-items-center">
										<div class="form-group col-md-4">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="fixa" name="fixa">
							      				<label class="form-check-label" for="fixa">Fixo</label>	
											</div>
											<div class="form-check">
												<input class="form-check-input" type="checkbox" id="recebido" name="recebido">
							      				<label class="form-check-label" for="recebido">Recebido</label>	
											</div>
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">Data</label>	
											<input type="date" name="dtinicial" id="dtinicial" class="form-control" data-provide="datapicker">
										</div>
										<div class="form-group col-md-4">
											<label class="form-label">Data</label>	
											<input type="date" name="dtfinal" id="dtfinal" class="form-control" data-provide="datapicker">
										</div>
									</div>

									<div class="text-right">
										<button type="submit" class="btn btn-primary btn-user">
											Enviar
										</button>		
									</div>
									
								</form>

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



		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped" id="tabela">

						<thead>
							<tr>
								<th>Descrição</th>
								<th>Valor</th>
								<th>Renda Fixa</th>
								<th>Compensação</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>Descrição</th>
								<th>Valor</th>
								<th>Renda Fixa</th>
								<th>Compensação</th>
							</tr>
						</tfoot>
						<tbody>
							@for($i = 0; $i < count($receitas); $i++)
								<tr>
									<td>
										<a href="{{route( 'receitas.show',['receita'=> $receitas[$i]->id] )}}">
												{{$receitas[$i]->descricao}}
										</a>
									</td>
									<td>{{$receitas[$i]->valor}}</td>
									<td>@if($receitas[$i]->fixa) Sim @endif</td>
									<td>{{\Carbon\Carbon::parse($receitas[$i]->data)->format('d/m/Y')}}
									</td>
								</tr>
							@endfor

						</tbody>

					</table>
				</div>
			</div>
		</div>
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

  			$('#dtinicial').datepicker({

			});

			$('#dtfinal').datepicker({

			});
		})

    </script>

    <script type="text/javascript">
    	// Bar Chart Example
    	var ctx = document.getElementById("myBarChart");
    	var myBarChart = new Chart(ctx, {
    	  type: 'bar',
    	  data: {
    	    labels: ["January", "February", "March", "April", "May", "June", "July", "Aug", "Sep", "Oct"],
    	    datasets: [{
    	      label: "Renda",
    	      backgroundColor: "#4e73df",
    	      hoverBackgroundColor: "#2e59d9",
    	      borderColor: "#4e73df",
    	      data: {!! json_encode($renda)!!},
    	    }],
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
    	          max: 15000,
    	          maxTicksLimit: 5,
    	          padding: 10,
    	          // Include a dollar sign in the ticks
    	          callback: function(value, index, values) {
    	            return '$' + number_format(value);
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
    	          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
    	        }
    	      }
    	    },
    	  }
    	});
    </script>
@endsection