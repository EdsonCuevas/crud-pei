<script setup>
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';

</script>
<template>
  <AuthenticatedLayout>
    <div class="financial-dashboard bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Income vs Expense</h2>
          <apexchart
            type="bar"
            height="400"
            :options="chartOptions1"
            :series="chartOptions1.series"
          ></apexchart>
        </div>
        <div>
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Traffic Sources</h2>
          <apexchart
            type="bar"
            height="400"
            :options="chartOptions2"
            :series="chartOptions2.series"
          ></apexchart>
        </div>
      </div>
      <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Monthly Revenue</h2>
        <apexchart
          type="area"
          height="300"
          :options="chartOptions3"
          :series="chartOptions3.series"
        ></apexchart>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import VueApexCharts from 'vue3-apexcharts'

export default {
  components: {
    apexchart: VueApexCharts,
  },
  data() {
    return {
      chartOptions1: {
        series: [
          {
            name: "Income",
            color: "#22C55E",
            data: [1420, 1620, 1820, 1420, 1650, 2120],
          },
          {
            name: "Expense",
            data: [788, 810, 866, 788, 1100, 1200],
            color: "#EF4444",
          },
        ],
        chart: {
          type: "bar",
          height: 400,
          toolbar: {
            show: false,
          },
          background: '#F3F4F6',
        },
        fill: {
          opacity: 1,
        },
        plotOptions: {
          bar: {
            horizontal: true,
            columnWidth: "70%",
            borderRadius: 6,
            dataLabels: {
              position: "top",
            },
          },
        },
        legend: {
          show: true,
          position: "bottom",
        },
        xaxis: {
          categories: ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          labels: {
            formatter: (value) => {
              return "$" + value;
            },
            style: {
              colors: '#1F2937',
            },
          },
        },
        yaxis: {
          labels: {
            style: {
              colors: '#1F2937',
            },
          },
        },
        grid: {
          show: true,
          strokeDashArray: 4,
        },
        tooltip: {
          y: {
            formatter: (value) => {
              return "$" + value.toLocaleString();
            },
          },
        },
      },
      chartOptions2: {
        colors: ["#3B82F6", "#F59E0B"],
        series: [
          {
            name: "Organic",
            data: [231, 122, 63, 421, 122, 323, 111],
          },
          {
            name: "Social media",
            data: [232, 113, 341, 224, 522, 411, 243],
          },
        ],
        chart: {
          type: "bar",
          height: 400,
          stacked: true,
          background: '#F3F4F6',
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "70%",
            borderRadius: 8,
          },
        },
        xaxis: {
          categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
          labels: {
            style: {
              colors: '#1F2937',
              fontFamily: "Inter, sans-serif",
            },
          },
        },
        yaxis: {
          labels: {
            style: {
              colors: '#1F2937',
            },
          },
        },
        grid: {
          strokeDashArray: 4,
        },
        tooltip: {
          shared: true,
          intersect: false,
        },
        legend: {
          labels: {
            colors: '#1F2937',
          },
        },
      },
      chartOptions3: {
        series: [{
          name: 'Revenue',
          data: [31, 40, 28, 51, 42, 109, 100]
        }],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
          background: '#F3F4F6',
        },
        colors: ['#6366F1'],
        fill: {
          type: 'gradient',
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.3,
            stops: [0, 90, 100]
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
          labels: {
            style: {
              colors: '#1F2937',
            },
          },
        },
        yaxis: {
          labels: {
            style: {
              colors: '#1F2937',
            },
            formatter: (value) => {
              return "$" + value.toLocaleString();
            },
          },
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },
          y: {
            formatter: (value) => {
              return "$" + value.toLocaleString();
            },
          },
        },
      },
    };
  },
};
</script>

<style scoped>
.financial-dashboard {
  font-family: 'Inter', sans-serif;
}
</style>