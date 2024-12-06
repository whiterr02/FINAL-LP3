<script lang="ts">
	import { page } from '$app/stores';
	import * as Sidebar from '$lib/components/ui/sidebar/index.js';
	import AppSidebar from '$lib/components/app/AppSidebar.svelte';
	import '../app.css';
	import AppBreadcrumb from '$lib/components/app/AppBreadcrumb.svelte';
	import { ModeWatcher } from 'mode-watcher';

	let { children } = $props();
</script>

<ModeWatcher />
{#if $page.url.pathname !== '/login'}
	<Sidebar.Provider class="font-poppins">
		<AppSidebar />
		<main class="w-full">
			<div class="mt-[12px] flex items-center gap-3">
				<Sidebar.Trigger />
				<AppBreadcrumb />
			</div>
			<div class="h-full w-full">
				{@render children?.()}
			</div>
		</main>
	</Sidebar.Provider>
{:else}
	<main class="flex h-full w-full items-center justify-center">
		{@render children?.()}
	</main>
{/if}
