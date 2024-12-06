<script lang="ts">
	import { invalidateAll } from '$app/navigation';
	import { services } from '$lib/api';
	import { Button, buttonVariants } from '$lib/components/ui/button/index.js';
	import * as Dialog from '$lib/components/ui/dialog/index.js';
	import { FormField } from '$lib/components/ui/form';
	import * as Form from '$lib/components/ui/form/index.js';
	import { Input } from '$lib/components/ui/input/index.js';
	import { Label } from '$lib/components/ui/label/index.js';
	import { onMount } from 'svelte';
	import { superForm, superValidate, type Infer, type SuperValidated } from 'sveltekit-superforms';
	import { zod, zodClient } from 'sveltekit-superforms/adapters';
	import { schemaCliente, type SchemaCliente } from './schema';

	type Props = { form: SuperValidated<Infer<SchemaCliente>> };
	let { form: preForm }: Props = $props();
	let open = $state(false);

	const form = superForm(preForm, {
		SPA: true,
		validators: zodClient(schemaCliente),
		onUpdate({ form }) {
			if (!form.valid) {
				return;
			}
			services.cliente.create({
				razonSocial: form.data.razonSocial,
				ci: form.data.ci
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
					<Form.Field {form} name="razonSocial">
						<Form.Control>
							{#snippet children({ props })}
								<Form.Label>Razon Social</Form.Label>
								<Input {...props} bind:value={$formData.razonSocial} />
							{/snippet}
						</Form.Control>
						<Form.FieldErrors />
					</Form.Field>

					<Form.Field {form} name="ci">
						<Form.Control>
							{#snippet children({ props })}
								<Form.Label>Numero de CI</Form.Label>
								<Input {...props} bind:value={$formData.ci} />
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
