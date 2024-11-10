<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
import VueApexCharts from 'vue3-apexcharts';

// Definir props para recibir las donaciones y gastos desde Inertia
const props = defineProps({
  donations: {
    type: Array,
    default: () => [],
  },
  expenses: {
    type: Array,
    default: () => [],
  },
});

// Extraer meses y valores de donaciones
const months = props.donations.map(d => d.month);
const donationsValues = props.donations.map(d => d.total);
const expensesValues = props.expenses.map(e => e.total);

// Configuración para la primera gráfica (Donations vs Expenses)
const chartOptions1 = ref({
  series: [
    {
      name: 'Donations',
      color: '#22C55E',
      data: donationsValues,
    },
    {
      name: 'Expenses',
      color: '#EF4444',
      data: expensesValues,
    },
  ],
  chart: {
    type: 'bar',
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
      columnWidth: '70%',
      borderRadius: 6,
      dataLabels: {
        position: 'top',
      },
    },
  },
  dataLabels: {
    enabled: true,
    formatter: (value) => '$' + value.toLocaleString(),
    style: {
      colors: ['#29292A'],
      fontSize: '14px',
      fontWeight: 'bold',
    },
  },
  legend: {
    show: true,
    position: 'bottom',
  },
  xaxis: {
    categories: months,
    labels: {
      formatter: (value) => '$' + value,
      style: {
        colors: '#1F2937',
      },
    },
  },
  yaxis: {
    labels: {
      formatter: (value) => value.toLocaleString(),
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
      formatter: (value) => '$' + value.toLocaleString(),
    },
  },
});

// Configuración para la segunda gráfica (Organic vs Social Media)
const chartOptions2 = ref({
  colors: ['#3B82F6', '#F59E0B'],
  series: [
    {
      name: 'Organic',
      data: [231, 122, 63, 421, 122, 323, 111],
    },
    {
      name: 'Social media',
      data: [232, 113, 341, 224, 522, 411, 243],
    },
  ],
  chart: {
    type: 'bar',
    height: 400,
    stacked: true,
    background: '#F3F4F6',
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '70%',
      borderRadius: 8,
    },
  },
  xaxis: {
    categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    labels: {
      style: {
        colors: '#1F2937',
        fontFamily: 'Inter, sans-serif',
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
});
</script>

<template>
  <AuthenticatedLayout>
    <div class="financial-dashboard bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Primera gráfica: Donations vs Expenses -->
        <div>
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Donation vs Expense</h2>
          <apexchart
            type="bar"
            height="400"
            :options="chartOptions1"
            :series="chartOptions1.series"
          ></apexchart>
        </div>

        <!-- Segunda gráfica: Organic vs Social Media -->
        <div>
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Organic vs Social Media</h2>
          <apexchart
            type="bar"
            height="400"
            :options="chartOptions2"
            :series="chartOptions2.series"
          ></apexchart>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
export default {
  components: {
    apexchart: VueApexCharts,
  },
};
</script>
