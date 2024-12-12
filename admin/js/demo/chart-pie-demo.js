// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var complT = parseInt(document.getElementById("complT").getAttribute('value'));
var pendingT = parseInt(document.getElementById("pendingT").getAttribute('value'));
var totalT = parseInt(document.getElementById("totalT").getAttribute('value'));
// complT=(complT*100)/totalT;
// pendingT=(pendingT*100)/totalT;
// totalT=((totalT-complT-pendingT)*100)/totalT;
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: ["Completed", "Pending","Failed"],
    datasets: [{
      data: [complT,pendingT,(totalT-complT-pendingT)],
      backgroundColor: ['#1cc88a', '#36b9cc','#fc9630'],
      hoverBackgroundColor: ['#17a673', '#2c9faf','#e38424'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
