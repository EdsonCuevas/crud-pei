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
  usersPerMonth: {
    type: Array,
    default: () => [],
  },
});

// Extraer meses y valores de donaciones y gastos
const months = props.donations.map(d => d.month);
const donationsValues = props.donations.map(d => d.total);
const expensesValues = props.expenses.map(e => e.total);

const userMonths = props.usersPerMonth.map(u => u.month);
const usersCount = props.usersPerMonth.map(u => u.total);


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
      formatter: (value) => '$' + value.toLocaleString(),
      style: {
        colors: '#1F2937',
      },
    },
  },
  tooltip: {
    y: {
      formatter: (value) => '$' + value.toLocaleString(),
    },
  },
});

// Configuración para la segunda gráfica (Stacked Bar)
const chartOptions2 = ref({
  colors: ['#3B82F6', '#F59E0B'],
  series: [
    {
      name: 'Donations',
      data: donationsValues,
    },
    {
      name: 'Expenses',
      data: expensesValues,
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
    categories: months,
    labels: {
      style: {
        colors: '#1F2937',
        fontFamily: 'Inter, sans-serif',
      },
    },
  },
  yaxis: {
    labels: {
      formatter: (value) => '$' + value.toLocaleString(),
      style: {
        colors: '#1F2937',
      },
    },
  },
  tooltip: {
    shared: true,
    intersect: false,
    y: {
      formatter: (value) => '$' + value.toLocaleString(),
    },
  },
});

// Configuración para la tercera gráfica (Area Chart - Monthly Revenue)
const chartOptions3 = ref({
  series: [
    {
      name: 'Users Registered',
      data: usersCount,
    },
  ],
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
      stops: [0, 90, 100],
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'smooth',
  },
  xaxis: {
    categories: userMonths,
    labels: {
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
  tooltip: {
    y: {
      formatter: (value) => value.toLocaleString() + ' users',
    },
  },
});

</script>

<template>
  <AuthenticatedLayout>
    <div class="financial-dashboard bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Primera gráfica: Donations vs Expenses (Horizontal Bar) -->
        <div>
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Donation vs Expense</h2>
          <apexchart
            type="bar"
            height="400"
            :options="chartOptions1"
            :series="chartOptions1.series"
          ></apexchart>
        </div>

        <!-- Segunda gráfica: Donations vs Expenses (Stacked Bar) -->
        <div>
          <h2 class="text-xl font-semibold mb-4 text-gray-800">Donation vs Expense (Stacked)</h2>
          <apexchart
            type="bar"
            height="400"
            :options="chartOptions2"
            :series="chartOptions2.series"
          ></apexchart>
        </div>
      </div>

      <!-- Tercera gráfica: Monthly Revenue (Area Chart) -->
      <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Users Registered per Month</h2>
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
export default {
  components: {
    apexchart: VueApexCharts,
  },
};
</script>
