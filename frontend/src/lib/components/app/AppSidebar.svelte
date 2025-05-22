<script lang="ts">
	import Documentos from 'lucide-svelte/icons/scroll-text';
	import Avatar from 'lucide-svelte/icons/circle-user';
	import Clientes from 'lucide-svelte/icons/users';
	import Envios from 'lucide-svelte/icons/truck';
	import Tractor from 'lucide-svelte/icons/tractor';
	import Sparkles from 'lucide-svelte/icons/sparkles';
	import HomeIcon from 'lucide-svelte/icons/home';
	import CreditCard from 'lucide-svelte/icons/credit-card';
	import LogOut from 'lucide-svelte/icons/log-out';
	import BadgeCheck from 'lucide-svelte/icons/badge-check';
	import Bell from 'lucide-svelte/icons/bell';
	import ChevronsUpDown from 'lucide-svelte/icons/chevrons-up-down';
	import ChevronDown from 'lucide-svelte/icons/chevron-down';
	import { type Icon } from 'lucide-svelte';
	import * as Sidebar from '$lib/components/ui/sidebar/index.js';
	import * as DropdownMenu from '$lib/components/ui/dropdown-menu/index.js';
	import type { ComponentType } from 'svelte';
	import ModeToggle from './ModeToggle.svelte';

	type Item = {
		title: string;
		url: string;
		icon: ComponentType<Icon>;
		active: boolean;
	};

	// Menu items.
	const items: Item[] = $state([
		{
			title: 'Dashboard',
			url: '/dashboard',
			icon: HomeIcon,
			active: false
		},
		{
			title: 'Documentos',
			url: '/documento',
			icon: Documentos,
			active: false
		},
		{
			title: 'Clientes',
			url: '/cliente',
			icon: Clientes,
			active: false
		},
		{
			title: 'Productos',
			url: '/producto',
			icon: Tractor,
			active: false
		}
	]);

	function handleActive(item: Item) {
		items.map((el) => {
			if (el.title === item.title) {
				el.active = true;
			} else {
				el.active = false;
			}
		});
	}
</script>

{#snippet header()}
	<Sidebar.Header class="@container/logo ">
		<Sidebar.Menu>
			<Sidebar.MenuItem>
				<DropdownMenu.Root>
					<DropdownMenu.Trigger>
						{#snippet child({ props })}
							<Sidebar.MenuButton class="@[70px]/logo:flex hidden " {...props}>
								AGROMAQ<ChevronDown class="ml-auto" />
							</Sidebar.MenuButton>
						{/snippet}
					</DropdownMenu.Trigger>
					<DropdownMenu.Content class="w-[--bits-dropdown-menu-anchor-width]">
						<DropdownMenu.Item onclick={() => (window.location.href = '/login')}>
							<span>Iniciar Sesion</span>
						</DropdownMenu.Item>
					</DropdownMenu.Content>
				</DropdownMenu.Root>
			</Sidebar.MenuItem>
		</Sidebar.Menu>
	</Sidebar.Header>
{/snippet}

{#snippet content()}
	<Sidebar.Content>
		<Sidebar.Group>
			<Sidebar.GroupLabel class="">Administrar</Sidebar.GroupLabel>
			<Sidebar.GroupContent>
				<Sidebar.Menu>
					{#each items as item (item.title)}
						<Sidebar.MenuItem>
							<Sidebar.MenuButton isActive={item.active}>
								{#snippet child({ props })}
									<a onclick={() => handleActive(item)} href={item.url} {...props}>
										<item.icon />
										<span>{item.title}</span>
									</a>
								{/snippet}
							</Sidebar.MenuButton>
						</Sidebar.MenuItem>
					{/each}
				</Sidebar.Menu>
			</Sidebar.GroupContent>
		</Sidebar.Group>
	</Sidebar.Content>
{/snippet}

{#snippet footer()}
	<Sidebar.Menu class="@container/footer border">
		<Sidebar.MenuItem>
			<DropdownMenu.Root>
				<DropdownMenu.Trigger>
					{#snippet child({ props })}
						<Sidebar.MenuButton
							size="lg"
							class="data-[state=open]:bg-sidebar-accent data-[state=open]:text-sidebar-accent-foreground @[70px]/footer:flex hidden"
							{...props}
						>
							<div class="grid flex-1 text-left text-sm leading-tight">
								<span class="truncate font-semibold">User</span>
								<span class="truncate text-xs">email@example</span>
							</div>
							<ChevronsUpDown class="ml-auto size-4" />
						</Sidebar.MenuButton>
					{/snippet}
				</DropdownMenu.Trigger>
				<DropdownMenu.Content
					class="w-[--bits-dropdown-menu-anchor-width] min-w-56 rounded-lg"
					align="end"
					sideOffset={4}
				>
					<DropdownMenu.Label class="p-0 font-normal">
						<div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
							<div class="grid flex-1 text-left text-sm leading-tight">
								<span class="truncate font-semibold">User</span>
								<span class="truncate text-xs">email@example</span>
							</div>
						</div>
					</DropdownMenu.Label>
					<DropdownMenu.Item class="cursor-pointer">
						<ModeToggle />
					</DropdownMenu.Item>
					<DropdownMenu.Item class="cursor-pointer">
						<LogOut />
						Cerrar Sesion
					</DropdownMenu.Item>
				</DropdownMenu.Content>
			</DropdownMenu.Root>
		</Sidebar.MenuItem>
	</Sidebar.Menu>
{/snippet}

<Sidebar.Root collapsible="icon">
	{@render header()}
	{@render content()}
	{@render footer()}
</Sidebar.Root>
