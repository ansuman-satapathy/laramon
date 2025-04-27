<div>
    <flux:header
        class="w-full bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800 px-4 py-2 flex items-center">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" />

        <flux:spacer />

        <flux:dropdown position="top" align="start">
            <flux:profile avatar="https://fluxui.dev/img/demo/user.png" name="Admin" />

            <flux:menu>
                <flux:menu.item icon="cog-6-tooth" href="#">Profile Settings</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:header>
</div>