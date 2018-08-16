import { Bar } from 'vue-chartjs'

export default ({
	extends: Bar,
	mounted () {
		this.renderChart({
			labels: ['A', 'B', 'C', 'D'],
			datasets: [
				{
					label: 'Respuestas', 
					backgroundColor: [
					    'blue',
					    'rgba(150, 5, 13, 1)',
					    'rgba(180, 99, 132, 1)',
					    'rgba(210, 99, 132, 1)',
					    'rgba(240, 99, 132, 1)'
					  ], 
					data: [10, 20, 30, 20, 0]
				}
			]
		}, {responsive: true, maintainaspectRadio: false})
	}
});