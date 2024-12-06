<script lang="ts">
	import { Header } from '$lib/components/ui/alert-dialog';
	import Label from '$lib/components/ui/label/label.svelte';
	import * as Select from '$lib/components/ui/select/index.js';
	import { getLocalTimeZone, today } from '@internationalized/date';
	import { Calendar } from '$lib/components/ui/calendar/index.js';
	import { Button } from '$lib/components/ui/button/index.js';

	let value = today(getLocalTimeZone());
</script>

<div class="flex h-full w-full flex-col items-center justify-center gap-4">
	<Header><b>Generar Nota de remision</b></Header>
	<Label>Seleccione un cliente</Label>
	<Select.Root type="single">
		<Select.Trigger class="w-[250px]">Seleccione el cliente</Select.Trigger>
		<Select.Content>
			<Select.Item value="light">Cliente</Select.Item>
		</Select.Content>
	</Select.Root>

	<Label>Elija la fecha</Label>
	<Select.Root type="single">
		<Select.Trigger class="w-[250px]">Seleccione la fecha</Select.Trigger>
		<Select.Content>
			<Calendar type="single" bind:value class="rounded-md border" />
		</Select.Content>
	</Select.Root>

	<Label>Seleccione un Producto</Label>
	<Select.Root type="single">
		<Select.Trigger class="w-[250px]">Seleccione un Producto</Select.Trigger>
		<Select.Content>
			<Select.Item value="light">Producto</Select.Item>
		</Select.Content>
	</Select.Root>

	<Button><b>Generar</b></Button>
</div>
