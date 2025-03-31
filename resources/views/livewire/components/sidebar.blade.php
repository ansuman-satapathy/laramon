<div>
    <flux:sidebar sticky stashable
        class="h-screen w-64 lg:w-58 flex flex-col bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-800">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="LaraMon"
            class="px-4 py-3 dark:hidden" />
        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="LaraMon"
            class="px-4 py-3 hidden dark:flex" />

        <flux:navlist variant="outline" class="flex-1">
            <flux:navlist.item icon="home" href="#" current>Dashboard</flux:navlist.item>
            <flux:navlist.item icon="inbox" href="#">Monitor Logs</flux:navlist.item>
            <flux:navlist.item icon="document-text" href="#">Reports</flux:navlist.item>
            <flux:navlist.item icon="calendar" href="#">Schedules</flux:navlist.item>
        </flux:navlist>

        <flux:spacer />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="moon" as="button"
                onclick="document.documentElement.classList.toggle('dark')">
                Dark Mode
            </flux:navlist.item>
            <flux:navlist.item icon="arrow-right-start-on-rectangle" href="#">Logout</flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>
</div>
