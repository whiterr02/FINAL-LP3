<script lang="ts">
	import * as Form from '$lib/components/ui/form/index.js';
	import * as Table from '$lib/components/ui/table/index.js';
	import { Input } from '$lib/components/ui/input/index.js';
	import { zodClient } from 'sveltekit-superforms/adapters';
	import Button, { buttonVariants } from '$lib/components/ui/button/button.svelte';
	import * as AlertDialog from '$lib/components/ui/alert-dialog/index.js';
	import { type Cliente } from '$lib/api/models';
	import { api } from '$lib/api/api';
	import { invalidateAll } from '$app/navigation';
	import EditarDialog from './editar-dialog.svelte';
	import CrearDialog from './crear-dialog.svelte';

	let { data } = $props();
	let open = $state(false);
	console.log(data.payload.data);

	async function borrarCliente(id: number) {
		await api.delete('cliente', { searchParams: { id: id } });
		open = false;
		invalidateAll();
	}
</script>

{#snippet tabla()}
	<Table.Root>
		<Table.Caption>Lista de Clientes.</Table.Caption>
		<Table.Header>
			<Table.Row>
				<Table.Head class="w-[100px]">ID</Table.Head>
				<Table.Head>Razon Social</Table.Head>
				<Table.Head>Ci</Table.Head>
				<Table.Head class="text-center">Acciones</Table.Head>
			</Table.Row>
		</Table.Header>
		<Table.Body>
			{#if data.payload.data}
				{#each data.payload.data as cliente, i (i)}
					<Table.Row>
						<Table.Cell class="font-medium">{cliente.id}</Table.Cell>
						<Table.Cell>{cliente.razonSocial}</Table.Cell>
						<Table.Cell>{cliente.ci}</Table.Cell>
						<Table.Cell class="flex items-center justify-center gap-2">
							<EditarDialog form={data.editarForm} {cliente} />
							{@render borrarDialog(cliente)}
						</Table.Cell>
					</Table.Row>
				{/each}
			{/if}
		</Table.Body>
		<Table.Footer>
			<Table.Row>
				<Table.Cell colspan={3}></Table.Cell>
				<Table.Cell class="text-right"></Table.Cell>
			</Table.Row>
		</Table.Footer>
	</Table.Root>
{/snippet}

{#snippet borrarDialog(cliente: Cliente)}
	<AlertDialog.Root bind:open>
		<AlertDialog.Trigger class={buttonVariants({ variant: 'destructive' })}>
			Borrar
		</AlertDialog.Trigger>
		<AlertDialog.Content>
			<AlertDialog.Header>
				<AlertDialog.Title>Esta seguro de borrar a {cliente.razonSocial}?</AlertDialog.Title>
				<AlertDialog.Description>Esta accion no es reversible.</AlertDialog.Description>
			</AlertDialog.Header>
			<AlertDialog.Footer>
				<AlertDialog.Cancel>Cancelar</AlertDialog.Cancel>
				<AlertDialog.Action
					onclick={() => borrarCliente(cliente.id!)}
					class={buttonVariants({ variant: 'destructive' })}>Borrar</AlertDialog.Action
				>
			</AlertDialog.Footer>
		</AlertDialog.Content>
	</AlertDialog.Root>
{/snippet}

<div class="flex h-full w-full flex-col items-center justify-center">
	<div class="w-full max-w-[1000px]">
		<CrearDialog form={data.crearForm} />
		{@render tabla()}
	</div>
	<!-- {@render formulario()} -->
</div>
