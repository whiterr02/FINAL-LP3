import { services } from '$lib/api';
import { type Cliente, type ClienteErr, type Payload } from '$lib/api/models';
import { error } from '@sveltejs/kit';
import { HTTPError } from 'ky';
import { superValidate } from 'sveltekit-superforms';
import { schemaCliente } from './schema';
import { zod } from 'sveltekit-superforms/adapters';

export const load = async ({ fetch }) => {
	const crearForm = await superValidate(zod(schemaCliente));
	const editarForm = await superValidate(zod(schemaCliente));
	const form = await superValidate(zod(schemaCliente));
	let payload: Payload<Cliente[]> = { success: false, error: '' };

	try {
		const cliente = await services.cliente.all(fetch);
		payload = { success: true, data: cliente, error: '' };
	} catch (err) {
		if (err instanceof HTTPError) {
			const error = await err.response.json<ClienteErr>();

			payload = { success: false, error: error.mensaje };
		}
	}
	return { payload, form, editarForm, crearForm };
};
