<div>
    <flux:sidebar sticky stashable
        class="h-screen w-64 lg:w-58 flex flex-col bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-800">
        <flux:sidebar.toggle class="lg:hidden">
            <i class="fas fa-times"></i>
        </flux:sidebar.toggle>

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="LaraMon" class="px-4 py-3 dark:hidden" />
        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="LaraMon"
            class="px-4 py-3 hidden dark:flex" />

        <!-- Sidebar Navigation -->
        <flux:navlist variant="outline" class="flex-1">
            <flux:navlist.item wire:navigate href="{{ route('laramon.dashboard') }}"
                class="{{ request()->routeIs('laramon.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home mr-2"></i> Dashboard
            </flux:navlist.item>
            <flux:navlist.item wire:navigate href="{{ route('database-queries') }}"
                class="{{ request()->routeIs('database-queries') ? 'active' : '' }}">
                <i class="fas fa-database mr-2"></i> Database Queries
            </flux:navlist.item>
            <flux:navlist.item wire:navigate href="#" class="{{ request()->is('jobs-queues') ? 'active' : '' }}">
                <i class="fas fa-tasks mr-2"></i> Jobs & Queues
            </flux:navlist.item>
            <flux:navlist.item wire:navigate href="#" class="{{ request()->is('system-health') ? 'active' : '' }}">
                <i class="fas fa-heartbeat mr-2"></i> System Health
            </flux:navlist.item>
            <flux:navlist.item wire:navigate href="#" class="{{ request()->is('logs') ? 'active' : '' }}">
                <i class="fas fa-file-alt mr-2"></i> Logs
            </flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item as="button" onclick="document.documentElement.classList.toggle('dark')">
                <i class="fas fa-moon mr-2"></i> Dark Mode
            </flux:navlist.item>
            <flux:navlist.item href="#">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>
</div>