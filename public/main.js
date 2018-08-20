
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    $("#formLogin").fadeIn();
});


var ctx = document.getElementById("myChart").getContext('2d');
var a = document.querySelector('meta[name="str"]').content;
var b = document.querySelector('meta[name="vote"]').content;

console.log(name);
var names = a.split(",")
b = b.replace(/(\'|,)/g, '').split('');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: names,
        datasets: [{
            label: '# Jumlah Survei',
            data: b,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
            display: false
        },
        tooltips: {
            callbacks: {
                label: function (tooltipItem) {
                    return tooltipItem.yLabel;
                }
            }
        }
    }
});

var elem = document.getElementById("progress-width");
var width = 1;
score = 50;
var id = setInterval(frame, 50);

function frame() {
    if (width >= score) {
        clearInterval(id);
    } else {
        width++;
        elem.style.width = width + '%';
        elem.innerHTML = width * 1 + '%';
    }
}

for (var i=1; i < array.length; index++) {
    function spinIcon_() {
        
    }
}
