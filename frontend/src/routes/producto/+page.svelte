<script lang="ts">
	import * as Form from '$lib/components/ui/form/index.js';
	import * as Table from '$lib/components/ui/table/index.js';
	import { Input } from '$lib/components/ui/input/index.js';
	import { schemaProducto, type SchemaProducto } from '../../lib/schema';
	import { type SuperValidated, type Infer, superForm } from 'sveltekit-superforms';
	import { zodClient } from 'sveltekit-superforms/adapters';
	import Button, { buttonVariants } from '$lib/components/ui/button/button.svelte';
	import * as AlertDialog from '$lib/components/ui/alert-dialog/index.js';
	import { type Producto } from '$lib/api/models';
	import { api } from '$lib/api/api';
	import { invalidateAll } from '$app/navigation';
	import EditarDialog from './editar-dialog.svelte';
	import CrearDialog from './crear-dialog.svelte';

	let { data } = $props();
	let open = $state(false);
	console.log(data.payload.data);

	async function borrarProducto(id: number) {
		await api.delete('producto', { searchParams: { id: id } });
		open = false;
		invalidateAll();
	}
</script>

{#snippet tabla()}
	<Table.Root>
		<Table.Caption>Lista de Productos.</Table.Caption>
		<Table.Header>
			<Table.Row>
				<Table.Head class="w-[100px]">ID</Table.Head>
				<Table.Head>Marca</Table.Head>
				<Table.Head>Modelo</Table.Head>
				<Table.Head>Año</Table.Head>
				<Table.Head>Color</Table.Head>
				<Table.Head>Chasis</Table.Head>
				<Table.Head class="text-center">Acciones</Table.Head>
			</Table.Row>
		</Table.Header>

		<Table.Body>
			{#if data.payload.data}
				{#each data.payload.data as producto, i (i)}
					<Table.Row>
						<Table.Cell class="font-medium">{producto.id}</Table.Cell>
						<Table.Cell>{producto.marca}</Table.Cell>
						<Table.Cell>{producto.modelo}</Table.Cell>
						<Table.Cell>{producto.año}</Table.Cell>
						<Table.Cell>{producto.color}</Table.Cell>
						<Table.Cell>{producto.chasis}</Table.Cell>
						<Table.Cell class="flex items-center justify-center gap-2">
							<EditarDialog form={data.editarForm} {producto} />
							{@render borrarDialog(producto)}
						</Table.Cell>
					</Table.Row>
				{/each}
			{/if}
		</Table.Body>

		<Table.Footer>
			<Table.Row>
				<Table.Cell colspan={6}></Table.Cell>
				<Table.Cell class="text-right"></Table.Cell>
			</Table.Row>
		</Table.Footer>
	</Table.Root>
{/snippet}

{#snippet borrarDialog(producto: Producto)}
	<AlertDialog.Root bind:open>
		<AlertDialog.Trigger class={buttonVariants({ variant: 'destructive' })}
			>Borrar</AlertDialog.Trigger
		>
		<AlertDialog.Content>
			<AlertDialog.Header>
				<AlertDialog.Title
					>Esta seguro de borrar a {producto.marca} {producto.modelo}?</AlertDialog.Title
				>
				<AlertDialog.Description>Esta accion no es reversible.</AlertDialog.Description>
			</AlertDialog.Header>
			<AlertDialog.Footer>
				<AlertDialog.Cancel>Cancelar</AlertDialog.Cancel>
				<AlertDialog.Action
					onclick={() => borrarProducto(producto.id!)}
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
