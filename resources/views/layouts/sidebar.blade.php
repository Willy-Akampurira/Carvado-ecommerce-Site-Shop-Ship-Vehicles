<aside class="w-64 bg-white shadow-md p-4 space-y-6">
  <!-- 🚗 Logo 
  <div class="flex items-center justify-center border-b pb-4">
    <img src="{{ asset('images/logo.png') }}" alt="Carvado Logo" class="h-10">
  </div>
    -->
  <!-- 🔐 Admin Menu -->
  @role('admin')
    <nav class="space-y-2 text-gray-700 font-medium">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 rounded hover:bg-red-50">
        <i class="fa-solid fa-gauge text-gray-400 mr-2"></i> Dashboard
      </a>
      <a href="{{ route('admin.orders') }}" class="flex items-center px-3 py-2 rounded hover:bg-red-50">
        <i class="fa-solid fa-box text-gray-400 mr-2"></i> Orders Management
      </a>
      <a href="{{ route('admin.payments') }}" class="flex items-center px-3 py-2 rounded hover:bg-red-50">
        <i class="fa-solid fa-credit-card text-gray-400 mr-2"></i> Payments Overview
      </a>
      <a href="{{ route('admin.users') }}" class="flex items-center px-3 py-2 rounded hover:bg-red-50">
        <i class="fa-solid fa-users text-gray-400 mr-2"></i> User Management
      </a>
      <a href="{{ route('admin.inventory') }}" class="flex items-center px-3 py-2 rounded hover:bg-red-50">
        <i class="fa-solid fa-car text-gray-400 mr-2"></i> Vehicle Inventory
      </a>
      <a href="{{ route('admin.analytics') }}" class="flex items-center px-3 py-2 rounded hover:bg-red-50">
        <i class="fa-solid fa-chart-line text-gray-400 mr-2"></i> Analytics & Reports
      </a>
      <a href="{{ route('admin.notifications') }}" class="flex items-center px-3 py-2 rounded hover:bg-red-50">
        <i class="fa-solid fa-bell text-gray-400 mr-2"></i> Notifications & Logs
      </a>
      <a href="{{ route('admin.logs') }}" class="flex items-center px-3 py-2 rounded hover:bg-red-50">
        <i class="fa-solid fa-file-lines text-gray-400 mr-2"></i> System Logs
      </a>
    </nav>
  @endrole

  <!-- 🧰 Worker Menu -->
  @role('worker')
    <h3 class="text-lg font-bold text-blue-600">Worker Menu</h3>
    <nav class="space-y-2 text-gray-700 font-medium">
      <a href="{{ route('worker.dashboard') }}" class="flex items-center px-3 py-2 rounded hover:bg-blue-50">
        <i class="fa-solid fa-gauge text-gray-400 mr-2"></i> Dashboard
      </a>
      <a href="{{ route('worker.inventory') }}" class="flex items-center px-3 py-2 rounded hover:bg-blue-50">
        <i class="fa-solid fa-car text-gray-400 mr-2"></i> Inventory
      </a>
      <a href="{{ route('worker.tasks') }}" class="flex items-center px-3 py-2 rounded hover:bg-blue-50">
        <i class="fa-solid fa-list-check text-gray-400 mr-2"></i> Tasks
      </a>
    </nav>
  @endrole

  <!-- 🛒 Client Menu -->
  @role('client')
    <h3 class="text-lg font-bold text-green-600">Client Menu</h3>
    <nav class="space-y-2 text-gray-700 font-medium">
      <a href="{{ route('client.dashboard') }}" class="flex items-center px-3 py-2 rounded hover:bg-green-50">
        <i class="fa-solid fa-gauge text-gray-400 mr-2"></i> Dashboard
      </a>
      <a href="{{ route('client.orders') }}" class="flex items-center px-3 py-2 rounded hover:bg-green-50">
        <i class="fa-solid fa-box text-gray-400 mr-2"></i> My Orders
      </a>
      <a href="{{ route('client.payments') }}" class="flex items-center px-3 py-2 rounded hover:bg-green-50">
        <i class="fa-solid fa-credit-card text-gray-400 mr-2"></i> My Payments
      </a>
    </nav>
  @endrole

  <!-- 🚪 Logout -->
  <form method="POST" action="{{ route('logout') }}" class="pt-4 border-t">
    @csrf
    <button type="submit" class="w-full flex items-center px-3 py-2 text-red-600 hover:bg-red-100 rounded">
      <i class="fa-solid fa-right-from-bracket text-red-600 mr-2"></i> Log Out
    </button>
  </form>
</aside>
