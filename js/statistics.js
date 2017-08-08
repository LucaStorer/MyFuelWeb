$(document).ready(function(){
	$.ajax({
		url : "../Database/statisticsDB.php",
		type : "GET",
		success : function(data){
			//	console.log(data);

			var date = [];
			var avgarr = [];
			var euro_litro=[];

			var sum = 0;
			var avg = 0;
			var index= 0;

			for(var i in data) {

				var num = parseFloat(data[i].EURO_LITRO).toFixed(3);

				index+=1;

				if (i == 0) {
					avg = parseFloat(num);
					sum = (parseFloat(sum) + parseFloat(num));
				}else{

					sum = (parseFloat(sum) + parseFloat(num));
					avg = (sum / index);

				};

				date.push(data[i].DATA);
				euro_litro.push(data[i].EURO_LITRO);
				avgarr.push(avg.toFixed(3));

			}

			var chartdata = {
				labels: date,
				datasets: [
					{
						label: "€/l",
						fill: false,
						lineTension: 0.2,
						// borderColor: "lightblue",
						pointStyle: "circle",
						backgroundColor: "rgba(59, 89, 152, 1)",
						borderColor: "rgba(59, 89, 152, 1)",
						pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
						pointHoverBorderColor: "rgba(59, 89, 152, 1)",
						data: euro_litro
					},
					{
						label: "costo medio - " + avg.toFixed(3) + " €",
						fill: false,
						lineTension: 0.4,
						borderColor: "yellow",
									pointStyle: "cross",
									backgroundColor: "rgba(255, 176, 0, 1)",
									borderColor: "rgba(255, 176, 0, 1)",
									pointHoverBackgroundColor: "rgba(255, 176, 0, 1)",
									pointHoverBorderColor: "rgba(255, 176, 0, 1)",
						data: avgarr
					}
				]
			};

			var ctx = $("#myChart");

			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
				options: {
        legend: {
					position: 'bottom',
            display: true,
						scales: {
					yAxes: [{
						ticks: {
							suggestedMin: 0.1,
								suggestedMax: 3.0
					 }
					}]
			},
            labels: {
                // fontColor: 'rgb(255, 99, 132)'
            }
        }
}

			});
		},
		error : function(data) {

		}
	});
});
