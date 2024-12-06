<script lang="ts">
	import { invalidateAll } from '$app/navigation';
	import { services } from '$lib/api';
	import type { Producto } from '$lib/api/models';
	import { Button, buttonVariants } from '$lib/components/ui/button/index.js';
	import * as Dialog from '$lib/components/ui/dialog/index.js';
	import { FormField } from '$lib/components/ui/form';
	import * as Form from '$lib/components/ui/form/index.js';
	import { Input } from '$lib/components/ui/input/index.js';
	import { Label } from '$lib/components/ui/label/index.js';
	import { schemaProducto, type SchemaProducto } from '$lib/schema';
	import { onMount } from 'svelte';
	import { superForm, superValidate, type Infer, type SuperValidated } from 'sveltekit-superforms';
	import { zod, zodClient } from 'sveltekit-superforms/adapters';

	type Props = { form: SuperValidated<Infer<SchemaProducto>> };
	let { form: preForm }: Props = $props();
	let open = $state(false);

	const form = superForm(preForm, {
		SPA: true,
		validators: zodClient(schemaProducto),
		onUpdate({ form }) {
			if (!form.valid) {
				return;
			}
			services.producto.create({
				marca: form.data.marca,
				modelo: form.data.modelo,
				año: form.data.año,
				color: form.data.color,
				chasis: form.data.chasis
			});
			open = false;
			invalidateAll();
		}
	});

	const { form: formData, enhance } = form;
</script>

<Dialog.Root bind:open>
	<Dialog.Trigger class={buttonVariants({ variant: 'default' })}>Nuevo</Dialog.Trigger>
	<Dialog.Content class="sm:max-w-[425px]">
		<Dialog.Header>
			<Dialog.Title>Nuevo Producto</Dialog.Title>
			<Dialog.Description>
				Agregar Nuevo Producto, haz click en aceptar cuando termines.
			</Dialog.Description>
		</Dialog.Header>
		<div class="grid gap-4 py-4">
			<div class="grid items-center gap-4">
				<form method="POST" use:enhance>
					<Form.Field {form} name="marca">
						<Form.Control>
							{#snippet children({ props })}
								<Form.Label>Marca</Form.Label>
								<Input {...props} bind:value={$formData.marca} />
							{/snippet}
						</Form.Control>
						<Form.FieldErrors />
					</Form.Field>

					<Form.Field {form} name="modelo">
						<Form.Control>
							{#snippet children({ props })}
								<Form.Label>Modelo</Form.Label>
								<Input {...props} bind:value={$formData.modelo} />
							{/snippet}
						</Form.Control>
						<Form.FieldErrors />
					</Form.Field>

					<Form.Field {form} name="año">
						<Form.Control>
							{#snippet children({ props })}
								<Form.Label>Año</Form.Label>
								<Input {...props} bind:value={$formData.año} />
							{/snippet}
						</Form.Control>
						<Form.FieldErrors />
					</Form.Field>

					<Form.Field {form} name="color">
						<Form.Control>
							{#snippet children({ props })}
								<Form.Label>Color</Form.Label>
								<Input {...props} bind:value={$formData.color} />
							{/snippet}
						</Form.Control>
						<Form.FieldErrors />
					</Form.Field>

					<Form.Field {form} name="chasis">
						<Form.Control>
							{#snippet children({ props })}
								<Form.Label>Chasis Nro</Form.Label>
								<Input {...props} bind:value={$formData.chasis} />
							{/snippet}
						</Form.Control>
						<Form.FieldErrors />
					</Form.Field>

					<Form.Button class="float-right">Aceptar</Form.Button>
				</form>
			</div>
		</div>
	</Dialog.Content>
</Dialog.Root>
