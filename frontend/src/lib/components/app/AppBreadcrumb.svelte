<script lang="ts">
	import * as Breadcrumb from '$lib/components/ui/breadcrumb/index.js';
	import Tractor from 'lucide-svelte/icons/tractor';
</script>

<Breadcrumb.Root class="text-lg">
	<Breadcrumb.List>
		<Breadcrumb.Item>
			<Breadcrumb.Link href="/">Inicio</Breadcrumb.Link>
		</Breadcrumb.Item>
		<Tractor />
		<Breadcrumb.Item>
			<Breadcrumb.Link href="/cliente">Cliente</Breadcrumb.Link>
		</Breadcrumb.Item>
		<Tractor />
		<Breadcrumb.Item>
			<Breadcrumb.Link href="/producto">Productos</Breadcrumb.Link>
		</Breadcrumb.Item>
	</Breadcrumb.List>
</Breadcrumb.Root>
