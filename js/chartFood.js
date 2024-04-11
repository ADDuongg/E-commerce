var btnallfood = document.querySelector('.btn-all');
var btndetailfood = document.querySelector('.btn-detail');
var btndetailsale = document.querySelector('.btn-detailsale');

btnallfood.addEventListener('click', function () {
  window.location.href = "../component_old/datafood.php?type=all";
});

btndetailfood.addEventListener('click', function () {
  window.location.href = "../component_old/datafood.php?type=top5";
});

btndetailsale.addEventListener('click', function () {
  window.location.href = "../component_old/datafood.php?type=salesfigure";
});
var dataBE = {};
let chart;
// Sử dụng async/await để đảm bảo dữ liệu đã được tải hoàn toàn trước khi vẽ biểu đồ
async function fetchDataAndDrawChart() {
  try {
    const response = await fetch('../controller_old/food.php');
    const data = await response.json();
    dataBE = { ...data };
    console.log(dataBE);
    let type;
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('type')) {
      type = urlParams.get('type');
    } else {
      type = "all";
    }
    console.log(1);
    if (type === "all" || type === "top5") {
      let backgroundColorAll = [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)'
      ];
      let backgroundColorTop5 = [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(225, 250, 90)',
        'rgb(205, 200, 100)',
        'rgb(195, 210, 80)'
      ];
      const labels = type === 'all' ? dataBE.all.map((item) => item.type) : dataBE.top5.map((item) => item.nameFood);
      const data = {
        labels,
        datasets: [{
          label: 'Số lượng đã mua',
          data: type === 'all' ? dataBE.all.map((item) => item.number) : dataBE.top5.map((item) => item.number),
          backgroundColor: type === "all" ? backgroundColorAll : backgroundColorTop5,
          hoverOffset: 4
        }]
      };
      const config = {
        type: 'pie',
        data: data,
        options: {
          plugins: {
            zoom: {
              zoom: {
                wheel: {
                  enabled: true
                },
                pinch: {
                  enabled: true
                },
                mode: 'xy'
              }
            }
          }
        }
      };

      const ctx = document.getElementById('myChart');

      chart =  new Chart(ctx, config)
    }
  } catch (err) {
    console.log(err);
  }
}

fetchDataAndDrawChart();
