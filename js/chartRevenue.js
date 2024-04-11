/* chart */
var btnday = document.querySelector('.btn-day')
var btnmonth = document.querySelector('.btn-month')
var btnyear = document.querySelector('.btn-year')
var btnreset = document.getElementById('resetButton')
var zoomin = document.querySelector('.fa-magnifying-glass-plus')
var zoomout = document.querySelector('.fa-magnifying-glass-minus')
let chart
btnday.addEventListener('click', function () {
    window.location.href = "../component_old/revenueadmin.php?type=day"
})
btnmonth.addEventListener('click', function () {
    window.location.href = "../component_old/revenueadmin.php?type=month"
})
btnyear.addEventListener('click', function () {
    window.location.href = "../component_old/revenueadmin.php?type=year"
})
fetch('../controller_old/revenue.php')
    .then(res => res.json())
    .then(dataBE => {
        const monthColors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)',
            'rgba(143, 105, 230, 0.2)',
            'rgba(163, 100, 245, 0.2)',
            'rgba(133, 102, 222, 0.2)',
            'rgba(193, 111, 200, 0.2)',
            'rgba(123, 101, 219, 0.2)',
        ];

        const dayColors = Array.from({ length: 31 }, (_, i) => monthColors[i % monthColors.length]);

        const yearColors = [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)'
            // Thêm màu sắc cho các năm khác ở đây
        ];
        const backgroundColor = type === "day" ? dayColors : (type === "month" ? monthColors : yearColors);

        var urlParams = new URLSearchParams(window.location.search);
        var type = "day"; // Giá trị mặc định cho biểu đồ theo ngày

        if (urlParams.has('type')) {
            type = urlParams.get('type');
        } else {
            console.log('Tham số "type" không tồn tại trong URL.');
        }

        console.log(dataBE);
        let dataMonth = {};
        let dataDay = {};
        let labelDay = [];
        let dataYear = {};
        let labelYear = [];

        /* day */
        if (type === "day") {
            dataDay = { ...dataBE['daySales'] };
            labelDay = Object.keys(dataDay);
            var dataDay_array = Object.values(dataDay);
        }

        /* month */
        if (type === "month") {
            dataMonth = { ...dataBE['monthlySales'] };
            var dataMonth_array = Object.values(dataMonth);
        }
        const labelMonth = [
            'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
        ];

        /* year */
        if (type === "year") {
            dataYear = { ...dataBE['yearSales'] };
            labelYear = Object.keys(dataYear);
            var dataYear_array = Object.values(dataYear);
        }

        const ctx = document.getElementById('myChart');
        const data = {
            labels: type === "day" ? labelDay : (type === "month" ? labelMonth : labelYear),
            datasets: [{
                label: type === "day" ? 'Danh thu theo ngày' : (type === "month" ? 'Danh thu theo tháng' : 'Danh thu theo năm'),
                data: type === "day" ? dataDay_array : (type === "month" ? dataMonth_array : dataYear_array),
                backgroundColor: backgroundColor,
                borderColor: backgroundColor.map(color => color.replace('0.2', '1')), // Để đảm bảo độ tương phản
                borderWidth: 1
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
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
            },
        };
        chart = new Chart(ctx, config);
    });
btnreset.addEventListener('click', function () {
    chart.resetZoom()
})
zoomin.addEventListener('click',function(){
    chart.zoom(1.1)
})
zoomout.addEventListener('click',function(){
    chart.zoom(0.6)
})


