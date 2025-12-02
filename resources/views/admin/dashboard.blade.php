@extends('layouts.system')

@section('content')
<h1 class="text-2xl font-bold text-gray-800 mb-6">Welcome, Admin</h1>

<!-- 🧾 Orders & Sales -->
<div class="mb-10">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">Orders & Sales</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <x-summary-card title="Total Orders" icon="fa-box" />
    <x-summary-card title="Orders This Month" icon="fa-calendar" />
    <x-summary-card title="Pending Orders" icon="fa-hourglass-half" />
    <x-summary-card title="Cancelled Orders" icon="fa-ban" />
  </div>
</div>

<!-- 💳 Payments & Revenue -->
<div class="mb-10">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">Payments & Revenue</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <x-summary-card title="Total Revenue" icon="fa-money-bill-wave" />
    <x-summary-card title="Revenue This Month" icon="fa-calendar" />
    <x-summary-card title="Pending Payments" icon="fa-clock" />
    <x-summary-card title="Failed Payments" icon="fa-times-circle" />
  </div>
</div>

<!-- 👥 Users & Roles -->
<div class="mb-10">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">Users & Roles</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <x-summary-card title="Total Clients" icon="fa-user" />
    <x-summary-card title="Active Clients" icon="fa-user-check" />
    <x-summary-card title="Total Workers" icon="fa-user-cog" />
    <x-summary-card title="Admin Actions Logged" icon="fa-shield-alt" />
  </div>
</div>

<!-- 🚗 Inventory & Vehicles -->
<div class="mb-10">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">Inventory & Vehicles</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <x-summary-card title="Vehicles in Stock" icon="fa-car" />
    <x-summary-card title="Vehicles Sold" icon="fa-check-circle" />
    <x-summary-card title="Top-Selling Models" icon="fa-star" />
    <x-summary-card title="Low Stock Alerts" icon="fa-exclamation-triangle" />
  </div>
</div>

<!-- 🛠️ System Health & Logs -->
<div class="mb-10">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">System Health & Logs</h2>
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <x-summary-card title="SMS Sent" icon="fa-comment-dots" />
    <x-summary-card title="Cron Job Status" icon="fa-clock-rotate-left" />
    <x-summary-card title="Emails Sent" icon="fa-envelope" />
    <x-summary-card title="Webhook Events" icon="fa-network-wired" />
  </div>
</div>

<!-- 📈 Line Charts: Trends Over Time -->
<div class="mb-16">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">Trends Over Time</h2>
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <x-chart-card title="Revenue Over Time" canvasId="revenueChart" />
    <x-chart-card title="Orders Per Day" canvasId="ordersChart" />
    <x-chart-card title="New User Registrations" canvasId="usersChart" />
  </div>
</div>

<!-- 📊 Bar Charts: Comparative Totals -->
<div class="mb-16">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">Comparative Totals</h2>
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <x-chart-card title="Top Selling Vehicles" canvasId="topVehiclesChart" />
    <x-chart-card title="Orders by Payment Method" canvasId="paymentMethodChart" />
    <x-chart-card title="Orders by Vehicle Category" canvasId="vehicleCategoryChart" />
  </div>
</div>

<!-- 🥧 Pie Charts: Proportional Breakdown -->
<div class="mb-16">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">Proportional Breakdown</h2>
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <x-chart-card title="Payment Method Distribution" canvasId="paymentPieChart" />
    <x-chart-card title="User Roles Distribution" canvasId="rolesPieChart" />
    <x-chart-card title="Order Status Breakdown" canvasId="orderStatusPieChart" />
  </div>
</div>

<!-- 🍩 Donut Charts: Status Breakdown -->
<div class="mb-16">
  <h2 class="text-xl font-semibold text-gray-700 mb-4">Status Breakdown</h2>
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <x-chart-card title="Order Status Donut" canvasId="orderDonutChart" />
    <x-chart-card title="Vehicle Availability" canvasId="vehicleDonutChart" />
    <x-chart-card title="SMS/Email Dispatch" canvasId="dispatchDonutChart" />
  </div>
</div>

<!-- 📊 AI Insights Box -->
<x-insight-box :insights="$insights" />
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Line Charts
  new Chart(revenueChart, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
      datasets: [{
        label: 'Revenue',
        data: [1200, 1900, 3000, 2500, 3200],
        borderColor: '#f87171',
        backgroundColor: 'rgba(248,113,113,0.2)',
        fill: true,
        tension: 0.4
      }]
    }
  });

  new Chart(ordersChart, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
      datasets: [{
        label: 'Orders',
        data: [12, 19, 14, 17, 22],
        borderColor: '#60a5fa',
        backgroundColor: 'rgba(96,165,250,0.2)',
        fill: true,
        tension: 0.4
      }]
    }
  });

  new Chart(usersChart, {
    type: 'line',
    data: {
      labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
      datasets: [{
        label: 'New Users',
        data: [5, 8, 12, 10],
        borderColor: '#34d399',
        backgroundColor: 'rgba(52,211,153,0.2)',
        fill: true,
        tension: 0.4
      }]
    }
  });

  // Bar Charts
  new Chart(topVehiclesChart, {
    type: 'bar',
    data: {
      labels: ['Hilux', 'Patrol', 'Ranger', 'D-Max'],
      datasets: [{
        label: 'Units Sold',
        data: [120, 95, 80, 60],
        backgroundColor: '#fbbf24'
      }]
    }
  });

  new Chart(paymentMethodChart, {
    type: 'bar',
    data: {
      labels: ['Mobile Money', 'Visa', 'Airtel Money', 'Mastercard'],
      datasets: [{
        label: 'Orders',
        data: [150, 90, 70, 40],
        backgroundColor: '#34d399'
      }]
    }
  });

  new Chart(vehicleCategoryChart, {
    type: 'bar',
    data: {
      labels: ['SUV', 'Pickup', 'Sedan', 'Van'],
      datasets: [{
        label: 'Orders',
        data: [110, 130, 85, 50],
        backgroundColor: '#60a5fa'
      }]
    }
  });

  // Pie Charts
  new Chart(paymentPieChart, {
    type: 'pie',
    data: {
      labels: ['Mobile Money', 'Visa', 'Airtel Money', 'Mastercard'],
      datasets: [{
        data: [40, 25, 20, 15],
        backgroundColor: ['#f87171', '#60a5fa', '#34d399', '#fbbf24']
      }]
    }
  });

  new Chart(rolesPieChart, {
    type: 'pie',
    data: {
      labels: ['Admin', 'Client', 'Worker'],
      datasets: [{
        data: [10, 70, 20],
        backgroundColor: ['#6366f1', '#10b981', '#f59e0b']
      }]
    }
  });

  new Chart(orderStatusPieChart, {
    type: 'pie',
    data: {
      labels: ['Paid', 'Pending', 'Failed'],
      datasets: [{
        data: [60, 30, 10],
        backgroundColor: ['#22c55e', '#facc15', '#ef4444']
      }]
    }
  });

  // Donut Charts
  new Chart(orderDonutChart, {
    type: 'doughnut',
    data: {
      labels: ['Paid', 'Pending', 'Failed'],
      datasets: [{
        data: [60, 30, 10],
        backgroundColor: ['#22c55e', '#facc15', '#ef4444']
      }]
    }
  });

  new Chart(vehicleDonutChart, {
    type: 'doughnut',
    data: {
      labels: ['In Stock', 'Sold', 'Low Stock'],
      datasets: [{
        data: [80, 50, 10],
        backgroundColor: ['#3b82f6', '#10b981', '#f97316']
      }]
    }
  });

  new Chart(dispatchDonutChart, {
    type: 'doughnut',
    data: {
      labels: ['Success', 'Failure'],
      datasets: [{
        data: [85, 15],
        backgroundColor: ['#16a34a', '#dc2626']
      }]
    }
  });
</script>
@endpush


