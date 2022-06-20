<?php session_start(); ?>

<?php include('templates/header.php'); ?>

<head>
</head>

<body>
    <!-- Sidebar  -->
    <div class="wrapper">
        <?php include('templates/sidebar.php'); ?>


        <!-- Page Content  -->
        <div id="content">
          <div id="">
            <!-- Navbar  -->
            <?php include('templates/navbar.php'); ?>
            <div class="quiz-list col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="panel-title">Analytics</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="analyticsTable" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Question Title</th>
                                        <th>Number Of People With Correct Answer</th>
                                        <th>Number Of People With Wrong Answer</th>
                                        <th>Correct Answer Percentage</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

						<div class="col-md-6">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title">Line Chart</h5>
									<h6 class="card-subtitle text-muted">Comparison</h6>
								</div>
								<div class="card-body">
									<div class="chart">
										<canvas id="chartjs-line"></canvas>
									</div>
								</div>
							</div>
						</div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Bar Chart</h5>
                  <h6 class="card-subtitle text-muted">Number of students by Answer.</h6>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="chartjs-bar"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Doughnut Chart</h5>
                  <h6 class="card-subtitle text-muted">Percentage of Answer by Category</h6>
                </div>
                <div class="card-body">
                  <div class="chart chart-sm">
                    <canvas id="chartjs-doughnut"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title">Pie Chart</h5>
									<h6 class="card-subtitle text-muted"></h6>
								</div>
								<div class="card-body">
									<div class="chart chart-sm">
										<canvas id="chartjs-pie"></canvas>
									</div>
								</div>
							</div>
						</div>
            </div>
        </div>
        </div>
    </div>


    <script>

    		document.addEventListener("DOMContentLoaded", function() {
          // Line chart
    			new Chart(document.getElementById("chartjs-line"), {
    				type: "line",
    				data: {
    					labels:  ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    					datasets: [{
    						label: "Sales ($)",
    						fill: true,
    						backgroundColor: "transparent",
    						borderColor: 'rgb(255, 99, 132)',
    						data: [2115, 1562, 1584, 1892, 1487, 2223, 2966, 2448, 2905, 3838, 2917, 3327]
    					}, {
    						label: "Orders",
    						fill: true,
    						backgroundColor: "transparent",
    						borderColor: "#adb5bd",
    						borderDash: [4, 4],
    						data: [958, 724, 629, 883, 915, 1214, 1476, 1212, 1554, 2128, 1466, 1827]
    					}]
    				},
    				options: {
    					maintainAspectRatio: false,
    					legend: {
    						display: false
    					},
    					tooltips: {
    						intersect: false
    					},
    					hover: {
    						intersect: true
    					},
    					plugins: {
    						filler: {
    							propagate: false
    						}
    					},
    					scales: {
    						xAxes: [{
    							reverse: true,
    							gridLines: {
    								color: "rgba(0,0,0,0.05)"
    							}
    						}],
    						yAxes: [{
    							ticks: {
    								stepSize: 500
    							},
    							display: true,
    							borderDash: [5, 5],
    							gridLines: {
    								color: "rgba(0,0,0,0)",
    								fontColor: "#fff"
    							}
    						}]
    					}
    				}
    			});
    		});
    	</script>

    <script>
    		document.addEventListener("DOMContentLoaded", function() {
    			// Bar chart
    			new Chart(document.getElementById("chartjs-bar"), {
    				type: "bar",
    				data: {
    					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    					datasets: [{
    						label: "Last year",
    						backgroundColor: 'rgba(255, 99, 132, 0.5)',
    						borderColor: 'rgb(255, 99, 132)',
    						hoverBackgroundColor: 'rgba(255, 99, 132, 0.5)',
    						hoverBorderColor: 'rgba(255, 99, 132, 0.5)',
    						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
    						barPercentage: .75,
    						categoryPercentage: .5
    					}, {
    						label: "This year",
    						backgroundColor: "#dee2e6",
    						borderColor: "#dee2e6",
    						hoverBackgroundColor: "#dee2e6",
    						hoverBorderColor: "#dee2e6",
    						data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
    						barPercentage: .75,
    						categoryPercentage: .5
    					}]
    				},
    				options: {
    					maintainAspectRatio: false,
    					legend: {
    						display: false
    					},
    					scales: {
    						yAxes: [{
    							gridLines: {
    								display: false
    							},
    							stacked: false,
    							ticks: {
    								stepSize: 20
    							}
    						}],
    						xAxes: [{
    							stacked: false,
    							gridLines: {
    								color: "transparent"
    							}
    						}]
    					}
    				}
    			});
    		});
    	</script>
    	<script>
    		document.addEventListener("DOMContentLoaded", function() {
    			// Doughnut chart
    			new Chart(document.getElementById("chartjs-doughnut"), {
    				type: "doughnut",
    				data: {
    					labels: ["Social", "Search Engines", "Direct", "Other"],
    					datasets: [{
    						data: [260, 125, 54, 146],
    						backgroundColor: [
    							'rgb(75, 192, 192)',
    							'rgba(75, 192, 192, 0.5)',
    							'rgb(255, 99, 132)',
    							"#dee2e6"
    						],
    						borderColor: "transparent"
    					}]
    				},
    				options: {
    					maintainAspectRatio: false,
    					cutoutPercentage: 65,
    					legend: {
    						display: false
    					}
    				}
    			});
    		});
    	</script>
    	<script>
    		document.addEventListener("DOMContentLoaded", function() {
    			// Pie chart
    			new Chart(document.getElementById("chartjs-pie"), {
    				type: "pie",
    				data: {
    					labels: ["Social", "Search Engines", "Direct", "Other"],
    					datasets: [{
    						data: [260, 125, 54, 146],
    						backgroundColor: [
    							'rgb(75, 192, 192)',
    							'rgb(255, 205, 86)',
    							'rgb(255, 99, 132)',
    							"#dee2e6"
    						],
    						borderColor: "transparent"
    					}]
    				},
    				options: {
    					maintainAspectRatio: false,
    					legend: {
    						display: false
    					}
    				}
    			});
    		});
    	</script>

    <?php include('templates/footer.php'); ?>
