<style>
    #table-perPage {
        padding: 11px;
    }

    input[placeholder="Search"] {
        padding-left: 5px;
    }
</style>
<div class="p-6 space-y-6">
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Dashboard</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($stats as $stat)
            <livewire:laramon.card :title="$stat['title']" :value="$stat['value']" :icon="$stat['icon']"
                :bgColor="$stat['bgColor']" :subtitle="$stat['subtitle'] ?? null" :trend="$stat['trend'] ?? null"
                :url="$stat['url'] ?? null" />
        @endforeach
    </div>

    <!-- Recent Requests Table -->
    <div class="p-6 space-y-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Requests</h2>

        <livewire:laramon.recent-requests-table />
    </div>
</div>

@script
<script>
    document.addEventListener("DOMContentLoaded", function () {
        setInterval(() => {
            Livewire.dispatch('refreshTable');
        }, 5000);
    });
</script>
@endscript