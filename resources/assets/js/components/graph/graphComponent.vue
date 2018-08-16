<template>
	<div id="app">
		<canvas id="planet-chart"></canvas>
	</div>
</template>
<script>
import Chart from 'chart.js';

export default{
	mounted() {
		this.createChart('planet-chart');
	},
	methods: {
		createChart(chartId, chartData) {
			const ctx = document.getElementById(chartId);
			const myChart = new Chart(ctx, {
				type: planetChartData.type,
				data: planetChartData.data,
				options: planetChartData.options,
			});
		}
	}

};
const planetChartData = {
	type: 'bar',
	data: {
		labels: ['A', 'B', 'C', 'D'],
		datasets: [
      { // one line graph
      	label: 'Respuestas',
      	data: [10, 20, 67, 62],
      	backgroundColor: [
      	'blue',
      	'rgba(150, 5, 13, .8)',
      	'rgba(180, 99, 132, .8)',
      	'rgba(210, 99, 132, .8)',
      	'rgba(240, 99, 132, .8)'
      	],
      },
      ]
  },
  options: {
  	responsive: true,
  	lineTension: 10,
  	scales: {
  		yAxes: [{
  			ticks: {
  				beginAtZero: true,
  				padding: 25,
  			}
  		}]
  	}
  }
};
</script>