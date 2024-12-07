// Function Overlay Scrollbars
const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
const Default = {
    scrollbarTheme: "os-theme-light",
    scrollbarAutoHide: "leave",
    scrollbarClickScroll: true,
};
document.addEventListener("DOMContentLoaded", function () {
    const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
    if (
        sidebarWrapper &&
        typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
    ) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
                theme: Default.scrollbarTheme,
                autoHide: Default.scrollbarAutoHide,
                clickScroll: Default.scrollbarClickScroll,
            },
        });
    }
});

// Function ChartJS Statistic Users
const registrationData = {
    labels: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
    datasets: [{
        label: 'Enable / Disable',
        data: [5, 7, 3, 9, 2, 10, 15, 8, 4, 12, 7, 14, 3, 11, 8, 5, 13, 6, 9, 5, 12, 8, 7, 3, 4, 10, 9, 6, 8, 7, 4], // Data contoh
        backgroundColor: 'rgba(78, 115, 223, 0.05)',
        borderColor: '#3399FF',
        borderWidth: 2,
        pointBackgroundColor: '#3399FF',
        pointBorderColor: '#3399FF',
        pointHoverBackgroundColor: '#fff',
        pointHoverBordersColor: '#3399FF'
    }]
};

const chartOptions = {
    responsive: true,
    plugins: {
        legend: {
            display: true,
            position: 'top'
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Number of Registrations'
            }
        },
        x: {
            title: {
                display: true,
                text: 'Date'
            }
        }
    }
};

const ctx = document.getElementById('userRegistrationChart').getContext('2d');
const userRegistrationChart = new Chart(ctx, {
    type: 'line',
    data: registrationData,
    options: chartOptions
});